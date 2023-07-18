<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @yield('css')
    <script src="https://kit.fontawesome.com/5f712d1a25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style-home.css">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="css/colors.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset("style.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div class="container">

            <a class="navbar-brand" href="#">Healthy</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
                @if (Cookie::get("admin_cookie") == null ||Cookie::get("pasien_cookie") == null )
                <a class="nav-link" href="/guest/list-konsultasi">List Konsultasi</a>
                @endif
                @if (Cookie::get("admin_cookie") != null)
                <a class="nav-link" href="/list-konsultasi">List Konsultasi</a>
                <a class="nav-link" href="/alergi">Alergi</a>
                <a class="nav-link" href="/gejala">Gejala</a>
                @endif

                @if (Cookie::get("pasien_cookie") != null)
                <a class="nav-link " href="/konsultasi">Konsultasi</a>
                <a class="nav-link" href="/user/list-konsultasi">List Konsultasi</a>
                @endif
                @if (Cookie::get("admin_cookie") == null &&Cookie::get("pasien_cookie") == null )
                <a class="nav-link " href="/login">Login</a>
                @else
                <button class="nav-link btn btn-sm btn-danger" id="btn-logout" >Logout</button>
                @endif
              </div>
            </div>
        </div>
      </nav>


      <div class="container my-4 ">
        @yield('content')

        <div class="card border-0 shadow" style="border-radius: 10px">
            <div class="card-body">
                @yield('content-card')
            </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('script')

    <script>
        function checkUrl() {
            var url = window.location.pathname;
            // console.log(url);
            console.log(url);
            $('#navbarNavAltMarkup > div > a').removeClass('active');
            if (url == '/konsultasi') {
                $('#navbarNavAltMarkup > div > a:nth-child(2)').addClass('active');
            } else if (url == '/list-konsultasi') {
                // $('#navbarNavAltMarkup > div > a:nth-child(1)').removeClass('active');
                $('#navbarNavAltMarkup > div > a:nth-child(3)').addClass('active');
            } else if (url == '/'){
                // $('#navbarNavAltMarkup > div > a:nth-child(2)').removeClass('active');
                $('#navbarNavAltMarkup > div > a:nth-child(1)').addClass('active');
            }
            else if(url == '/alergi'){
                $('#navbarNavAltMarkup > div > a:nth-child(4)').removeClass('active');
                // $('#navbarNavAltMarkup > div > a:nth-child(2)').addClass('active');
            }
             else if(url == '/gejala'){
                $('#navbarNavAltMarkup > div > a:nth-child(5)').removeClass('active');
                // $('#navbarNavAltMarkup > div > a:nth-child(2)').addClass('active');
            } else if(url == '/login'){
                $('#navbarNavAltMarkup > div > a:nth-child(6)').removeClass('active');
                // $('#navbarNavAltMarkup > div > a:nth-child(2)').addClass('active');
            }

        }

        $("#btn-logout").click(function () {
            $.ajax({
                url : "/api/logout",
                type : "POST",
                success : function (data) {
                    alert("Logout Sukses")
                    window.location.href = window.location.origin + "/login"
                }
            })
        })
    </script>
</body>
</html>
