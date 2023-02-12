<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>log</title><style>
        .gradient-custom {
            background: #6a11cb;
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
        /* .table td, .table th {
            border: none;
        } */
    </style>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/regular.min.css" integrity="sha512-k2UAKyvfA7Xd/6FrOv5SG4Qr9h4p2oaeshXF99WO3zIpCsgTJ3YZELDK0gHdlJE5ls+Mbd5HL50b458z3meB/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="mt-5 w-50 m-auto">
        <form class="form-inline mb-2" action="{{ url('/readFile') }}" method="post">
            @csrf
            <input style="" type="text" name="file_name" placeholder="/path/to/file" class="w-75">
            <div style="display: none;">
                <input type="hidden" name="start" value="0">
                <input type="hidden" name="end" value="10">
            </div>
            <button type="submit" class="btn p-1" style="background-color: lightgrey;">View</button>
        </form>
        
        {{-- <div style="display: none;">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 2px;background-color: lightgrey;">1</td>
                        <td style="text-align: left;">[Thu Jun 09 06:07:04 2005] [notice] LDAP: Built with OpenLDAP LDAP SDK</td>
                    </tr>
                    <tr>
                        <td style="width: 2px;background-color: lightgrey;">1</td>
                        <td style="text-align: left;">[Thu Jun 09 06:07:04 2005] [notice] LDAP: Built with OpenLDAP LDAP SDK</td>
                    </tr>
                </tbody>
            </table>
    
            <nav class="w-100">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled flex-fill">
                    <a class="page-link" href="#">|<i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item active flex-fill">
                    <a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
                    <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i>|</a>
                </ul>
            </nav>
        </div> --}}
        {{-- <div class="border-dark">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td style="width: 2px;">1</td>
                        <td>Mark</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav class="w-100">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled flex-fill">
                <a class="page-link" href="#">|<i class="fa-solid fa-chevron-left"></i></a>
              </li>
              <li class="page-item active flex-fill">
                <a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
              </li>
              <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
              <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i>|</a>
            </ul>
        </nav> --}}
    </div>

    {{-- <section class="gradient-custom w-90 h-50 m-auto">
        <div class="container py-5">
          <div class="row d-flex">
            <div class="w-100 col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                  <div class="mb-md-5 mt-md-4 pb-5">
                    <div class="mt-5 m-auto"> --}}
    
                        {{-- <form class="form-inline w-100">
                              <input style="" type="text" name="file_name" placeholder="/path/to/file">
                            <button type="submit" class="btn btn-primary mb-2">View</button>
                          </form>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width: 2px;">1</td>
                                        <td style="text-align: left;">[Thu Jun 09 06:07:04 2005] [notice] LDAP: Built with OpenLDAP LDAP SDK</td>
                                    </tr>
                                </tbody>
                            </table>
                
                        <nav class="w-100">
                            <ul class="pagination justify-content-center">
                              <li class="page-item disabled flex-fill">
                                <a class="page-link" href="#">|<i class="fa-solid fa-chevron-left"></i></a>
                              </li>
                              <li class="page-item active flex-fill">
                                <a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                              </li>
                              <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
                              <li class="page-item flex-fill"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i>|</a>
                            </ul>
                        </nav> --}}
                    {{-- </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section> --}}
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>