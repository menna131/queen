<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>log</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="mt-5 w-50 m-auto">
        <form class="form-inline mb-2" id="viewForm" data-action="{{ route('readLogFile') }}">
            @csrf
            <p id="error"></p>
            <input style="" type="text" name="file_name" placeholder="/path/to/file" class="w-75" required>
            <button type="submit" class="btn p-1" style="background-color: lightgrey;">View</button>
        </form>
        <div>
            <table id="table" class="table table-bordered">
            </table>
    
            <nav class="w-100">
                <ul class="pagination justify-content-center">
                    <li class="page-item flex-fill" id="fli">
                    <a class="page-link" href="#" id="first">|<i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item flex-fill" id="pli">
                    <a class="page-link" href="#" id="previous"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li style="text-align: right;" class="page-item flex-fill" id="nli">
                        <a class="page-link" href="#" id="next"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                    <li style="text-align: right;" class="page-item flex-fill" id="lli">
                        <a class="page-link" href="#" id="last"><i class="fa-solid fa-chevron-right"></i>|</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        /**
         * Documentation
         * setUp()
         * this function is called in the beginning of every click function and form submission
         * no inputs
         * no outputs
         * it is a setup for the page
         * 1) error msg is deleted
         * 2) disabled classes are deleted from all buttons 
         */
        function setUp(){
            $('#error').html('');
            $('#fli').removeClass('disabled');
            $('#pli').removeClass('disabled');
            $('#nli').removeClass('disabled');
            $('#lli').removeClass('disabled');
        }
        function begining(){
            $('#error').html('');
            $('#fli').addClass('disabled');
            $('#pli').addClass('disabled');
            $('#nli').addClass('disabled');
            $('#lli').addClass('disabled');
        }
        $(document).ready(function(){
            begining();
            var form = '#viewForm';
            /**
             * Documentation
             * when form is submitted
             * data is sent to http://127.0.0.1:8000/readLogFile
             * then the table is populated with the data
            */
            $(form).on('submit', function(event){
                setUp();
                event.preventDefault();
                var url = $(this).attr('data-action');
                var sending_data = {
                        _token:"{{ csrf_token() }}",
                        file_name:$("input[name=file_name]").val(),
                        view:"view"
                    };
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: sending_data,
                    dataType: 'json',
                    success:function(response)
                    {
                        if(response['error'] !== undefined && response['error'] == 'enter file name'){
                            var error_msg = '';
                            error_msg = `
                                <small style="color: red;">Enter File name</small>
                            `;
                            $('#error').html(error_msg);
                        }else{
                            // if the response is empty
                            // the file is empty
                            // disable all buttons
                            if(response.length == 0){
                                $('#fli').addClass('disabled');
                                $('#pli').addClass('disabled');
                                $('#nli').addClass('disabled');
                                $('#lli').addClass('disabled');
                                return 1;
                            }
                            var table_rows = '';
                            var key = response[1];
                            for (let index = 0; index < response[0].length; index++) {
                                if(key == 0){
                                    key ++;
                                }
                                table_rows += `
                                    <tr>
                                        <td style="width: 2px;">${key}</td>
                                        <td>${response[0][index]}</td>
                                    </tr>
                                `;
                                key ++;
                            }
                            table_rows = `<tbody>${table_rows}</tbody>`;
                            $('#table').html(table_rows);
                        }
                    },
                    error: function(req, err){ console.log('my message' + err); }
                });
            });

            // if first button is hit
            var first = '#first';
            /**
             * Documentation
             * when the first button is hit
             * data is sent to http://127.0.0.1:8000/readLogFile
             * then the table is populated with the data
            */
            $(first).on('click', function(event_1){
                setUp();
                event_1.preventDefault();
                var url = "{{ route('readLogFile') }}";
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token:'{{ csrf_token() }}',
                        first: 'first'
                    },
                    dataType: 'json',
                    success:function(response)
                    {
                        if(response.length == 0){
                            $('#fli').addClass('disabled');
                            $('#pli').addClass('disabled');
                            return 1;
                        }
                        var table_rows = '';
                        var key = response[1];
                        for (let index = 0; index < response[0].length; index++) {
                            if(key == 0){
                                key ++;
                            }
                            table_rows += `
                                <tr>
                                    <td style="width: 2px;">${key}</td>
                                    <td>${response[0][index]}</td>
                                </tr>
                            `;
                            key ++;
                        }
                        table_rows = `<tbody>${table_rows}</tbody>`;
                        $('#table').html(table_rows);
                    }
                });
            });

            // if next button is hit
            var next = '#next';
            /**
             * Documentation
             * when the next button is hit
             * data is sent to http://127.0.0.1:8000/readLogFile
             * then the table is populated with the data
            */
            $(next).on('click', function(event_1){
                setUp();
                event_1.preventDefault();
                var url = "{{ route('readLogFile') }}";
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token:'{{ csrf_token() }}',
                        next: 'next'
                    },
                    dataType: 'json',
                    success:function(response)
                    {
                        if(response.length == 0){
                            $('#nli').addClass('disabled');
                            $('#lli').addClass('disabled');
                            return 1;
                        }
                        if(typeof response === 'object'){
                            response[0] = Object.keys(response[0]).map((key) => [Number(key), response[0][key]]);
                        }
                        var table_rows = '';
                        var key = response[1]+1;
                        for (let index = 0; index < response[0].length; index++) {
                            if(key == 0){
                                key ++;
                            }
                            table_rows += `
                                <tr>
                                    <td style="width: 2px;">${key}</td>
                                    <td>${response[0][index]}</td>
                                </tr>
                            `;
                            key ++;
                        }
                        table_rows = `<tbody>${table_rows}</tbody>`;
                        $('#table').html(table_rows);
                    },
                    error: function(req, err){ console.log('my message ' + err); }
                });
            });

            // if previous button is hit
            var previous = '#previous';
            /**
             * Documentation
             * when the pervious button is hit
             * data is sent to http://127.0.0.1:8000/readLogFile
             * then the table is populated with the data
            */
            $(previous).on('click', function(event_1){
                setUp();
                event_1.preventDefault();
                var url = "{{ route('readLogFile') }}";
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token:'{{ csrf_token() }}',
                        previous: 'previous'
                    },
                    dataType: 'json',
                    success:function(response)
                    {
                        if(response.length == 0){
                            $('#pli').addClass('disabled');
                            $('#fli').addClass('disabled');
                            return 1;
                        }
                        if(typeof response === 'object'){
                            response[0] = Object.keys(response[0]).map((key) => [Number(key), response[0][key]]);
                        }
                        var table_rows = '';
                        var key = response[1]+1;
                        for (let index = 0; index < response[0].length; index++) {
                            if(key == 0){
                                key ++;
                            }
                            table_rows += `
                                <tr>
                                    <td style="width: 2px;">${key}</td>
                                    <td>${response[0][index]}</td>
                                </tr>
                            `;
                            key ++;
                        }
                        table_rows = `<tbody>${table_rows}</tbody>`;
                        $('#table').html(table_rows);

                    },
                    error: function(req, err){ console.log('my message ' + err); }
                });
            });

            // if last button is hit
            var last = '#last';
            /**
             * Documentation
             * when the last button is hit
             * data is sent to http://127.0.0.1:8000/readLogFile
             * then the table is populated with the data
            */
            $(last).on('click', function(event_1){
                setUp();
                event_1.preventDefault();
                var url = "{{ route('readLogFile') }}";
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token:'{{ csrf_token() }}',
                        last: 'last'
                    },
                    dataType: 'json',
                    success:function(response)
                    {
                        if(response.length == 0){
                            $('#nli').addClass('disabled');
                            $('#lli').addClass('disabled');
                            return 1;
                        }
                        if(typeof response === 'object'){
                            response[0] = Object.keys(response[0]).map((key) => [Number(key), response[0][key]]);
                        }
                        var table_rows = '';
                        var key = response[1]+1;
                        for (let index = 0; index < response[0].length; index++) {
                            if(key == 0){
                                key ++;
                            }
                            table_rows += `
                                <tr>
                                    <td style="width: 2px;">${key}</td>
                                    <td>${response[0][index]}</td>
                                </tr>
                            `;
                            key ++;
                        }
                        table_rows = `<tbody>${table_rows}</tbody>`;
                        $('#table').html(table_rows);
                        console.log(table_rows);
                    },
                    error: function(req, err){ console.log('my message ' + err); }
                });
            });
        });
    </script>
</body>
</html>