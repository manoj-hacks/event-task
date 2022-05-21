<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($errors->any())
    <script>

        var error = "{{ $errors->first() }}"
        swal({
            title: "Error!",
            text: error,
            icon: "error",
        })
    </script>

@endif

@if (session()->has('error'))
    <script>

        var error = "{{ session()->get('error') }}"
        swal({
            title: "Error!",
            text: error,
            icon: "error",
        })
    </script>

@endif

@if (session()->has('success'))
    <script>

        var message = "{{ session()->get('success') }}"
        swal({
            title: "Success!",
            text: message,
            icon: "success",
        })
    </script>

@endif
