<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
</head>
<body style="font-family: 'Poppins', sans-serif;">
    <div class="row d-flex" style="height: 100vh">
        <div class="col-md-7" style="background:url('https://images.unsplash.com/photo-1628771065518-0d82f1938462?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2940&q=80');background-size:cover;background-repeat:no-repeat;background-position: center">

        </div>
        <div class="col-md-5">
            <div class="p-lg-5">

                <h3 class="mt-5">Login</h3>
                <p style="color: rgb(163, 163, 163)">Login untuk mengakses menu pada Dokter</p>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" id="email" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" id="password" class="form-control form-control-sm">
                        </div>
                        <div class="text-right">
                            <button class="btn btn-sm btn-primary" id="btn-login">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        $('#btn-login').click(function(){
            let email = $('#email').val()
            let password = $('#password').val()

            $.ajax({
                url: window.location.origin + '/api/login',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(res){

                    console.log(res)
                    if(res.status == 'success'){
                        Cookies.set('admin_cookie', res.data.token)
                        window.location.href = window.location.origin + '/list-konsultasi'
                    }else{
                        alert(res.message)
                    }
                },error : function (res) {
                    alert("Username atau password")
                }
            })
        })
    </script>
</body>
</html>


