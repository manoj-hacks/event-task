<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDay;
use App\Http\Requests\AddEvent;
use App\Http\Requests\EditEvent;
use Yajra\DataTables\DataTables;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class EventController extends Controller
{

    public function __construct()
    {

    }

    public function index(Request $request) {
        $start = new Carbon('first sunday of this year');
        dd($start);
        if($request->ajax()) {
            $data = Event::select('*')->with('occurance');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('dates',function($row){
                        return $row->start_date." to ".$row->end_date;
                    })
                    ->addColumn('occurance',function($row){
                        $value = "--";
                        if($row->repeat == 1){
                            $type = "Every";
                            if($row->repeat_type == 3) {
                                $type = $type ." Third";
                            }
                            if($row->repeat_type == 4) {
                                $type = $type ." Fourth";
                            }
                            $value =  $type." ".$row->repeat_day;
                        } else {
                            $value = $row->repeat_day_type." ".$row->repeat_type_days." of the ".$row->repeat_type_monthly;
                        }
                        return $value;


                    })
                    ->addColumn('action', function($row){


                           $btn = '
                           <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="'.route('event-view',$row->id).'">View</a>
                                    <a class="dropdown-item" href="'.route('event-edit',$row->id).'">Edit</a>
                                    <a class="dropdown-item delete-link"  href="javascript:void(0)"  data-link="'.route('event-delete',$row->id).'">Delete</a>
                                </div>
                            </div>
                           ';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('list');
    }

    public function add() {
        return view('add');
    }

    public function addData(AddEvent $request) {



        $input = array(
            "title" => $request->title,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "repeat" => $request->repeat,
        );
        if($request->repeat == 1) {
            $input['repeat_type'] = $request->repeat_type;
            $input['repeat_day'] = $request->repeat_day;
        }

        if($request->repeat == 2) {
            $input['repeat_day_type'] = $request->repeat_day_type;
            $input['repeat_type_days'] = $request->repeat_type_days;
            $input['repeat_type_monthly'] = $request->repeat_type_monthly;
        }
        $event = Event::create($input);
        $params = $request->all();
        $params['event_id'] = $event->id;
        $date = $this->takeoutevent($params);
        if(count($date) > 0) {
           EventDay::insert($date);
        }

        return redirect()->route('event-list')->with("success","Event added successfully");
    }

    public function delete($id) {
        $eventExist = Event::where('id',$id)->first();
        if(empty( $eventExist)) {
            return redirect()->back()->with("error","Invalid data");
        }
        $eventExist->delete();
        return redirect()->back()->with("success","Event deleted successfully");
    }

    public function takeoutevent($request) {
        //dd($request);
        $start = new Carbon($request['start_date']);
        $end = new Carbon($request['end_date']);

        $array = array();
        if($request['repeat'] == 1) {
            $string = $request['repeat_type'].' '.$request['repeat_day'];
            $v = CarbonPeriod::create($start, $string,$end);
            foreach($v as $value) {

                array_push($array,  array("event_id" =>$request['event_id'],"created_at" => date('Y-m-d h:i:s') ,"date" => $value->format('Y-m-d')));
            }

        }

        if($request['repeat'] == 2) {
            $start = new Carbon('second sunday of 6 months');
           // $string = $request['repeat_type'].' '.$request['repeat_day'];
            $string = '1 Sunday Months';
            $v = CarbonPeriod::create($start, $string,$end);
            dd( $v );
            foreach($v as $value) {

                array_push($array,  array("event_id" =>$request['event_id'],"created_at" => date('Y-m-d h:i:s') ,"date" => $value->format('Y-m-d')));
            }

        }
        return $array;

    }


    public function view($id) {
        $eventData = Event::with('occurance')->where('id',$id)->first();
        if(empty( $eventData)) {
            return redirect()->back()->with("error","Invalid data");
        }
        return view('views',compact('eventData'));
    }

    public function edit($id) {
        $eventData = Event::where('id',$id)->first();
        if(empty( $eventData)) {
            return redirect()->back()->with("error","Invalid data");
        }
        return view('edit',compact('eventData'));
    }


    public function editData(EditEvent $request) {

        $eventData = Event::where('id',$request->id)->first();

        $input = array(
            "title" => $request->title,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "repeat" => $request->repeat,
        );
        if($request->repeat == 1) {
            $input['repeat_type'] = $request->repeat_type;
            $input['repeat_day'] = $request->repeat_day;
        }

        if($request->repeat == 2) {
            $input['repeat_day_type'] = $request->repeat_day_type;
            $input['repeat_type_days'] = $request->repeat_type_days;
            $input['repeat_type_monthly'] = $request->repeat_type_monthly;
        }
        Event::where('id',$request->id)->update($input);
        $params = $request->all();
        $params['event_id'] = $eventData->id;
        $date = $this->takeoutevent($params);
        if(count($date) > 0) {
            EventDay::where('event_id', $eventData->id)->delete();
            EventDay::insert($date);
        }

        return redirect()->route('event-list')->with("success","Event edited successfully");
    }

}
