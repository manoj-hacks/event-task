
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Sticky Footer Navbar Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
@include('header')

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <br><br><br>
    <div class="container">
        <form method="post" action="{{ route('event-edit-data') }}" method="Post">
            @csrf
            <input type="hidden" value="{{$eventData->id }}" name="id">
            <div class="form-group">
                <label for="exampleInputEmail1">Event Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" value="{{$eventData->title }}">
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="exampleInputPassword1" placeholder="Start Date" value="{{$eventData->start_date }}">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">End Date</label>
                <input type="date" name="end_date" class="form-control" id="exampleInputPassword1" placeholder="End Date" value="{{$eventData->end_date }}">
            </div>
            <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="repeat" id="flexRadioDefault1" value="1" {{ ($eventData->repeat == 1) ? "Checked":"" }}>
                        <label class="form-check-label" for="flexRadioDefault1" value=''>
                        Repeat
                        </label>
                        <select name="repeat_type" id="">
                            <option value="1" {{ ($eventData->repeat_type == 1) ? "selected":"" }}>Every</option>
                            {{-- <option  value="Every other">Every Other</option> --}}
                            <option  value="3"  {{ ($eventData->repeat_type == 3) ? "selected":"" }}>Every Third</option>
                            <option value="4"  {{ ($eventData->repeat_type == 4) ? "selected":"" }}>Every Fourth</option>
                        </select>
                        <select name="repeat_day" id="">
                            <option value="Days" {{ ($eventData->repeat_day == 'Days') ? "selected":"" }}>Day</option>
                            <option  value="Weeks" {{ ($eventData->repeat_day == 'Weeks') ? "selected":"" }}>Week</option>
                            <option  value="Months" {{ ($eventData->repeat_day == 'Months') ? "selected":"" }}>Month</option>
                            <option  value="Year" {{ ($eventData->repeat_day == 'Year') ? "selected":"" }}>Year</option>
                        </select>
                    </div>

            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="repeat" id="flexRadioDefault2" value="2">
                    <label class="form-check-label" for="flexRadioDefault2">
                    Repeat on the
                    </label>
                    <select name="repeat_day_type" id="">
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Third">Third</option>
                        <option value="Fourth">Fourth</option>
                    </select>
                    <select name="repeat_type_days" id="">
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    of the
                    <select name="repeat_type_monthly" id="">
                        <option value="Month">Month</option>
                        <option value="3 Month">3 Months</option>
                        <option value="4 Month">4 Months</option>
                        <option value="6 Month">6 Months</option>
                        <option value="Year">Year</option>

                    </select>
                </div>


            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@include('alert')
</html>
