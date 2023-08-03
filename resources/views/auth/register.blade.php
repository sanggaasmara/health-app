@extends('layouts.app')


@section('content')

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
        <div class="col-md-4" style="background:url('https://images.unsplash.com/photo-1628771065518-0d82f1938462?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2940&q=80');background-size:cover;background-repeat:no-repeat;background-position: right">
            <style>
                .card-body{
                    display: none !important;
                }
            </style>
        </div>
        <div class="col-md-8 shadow">
            <div class="p-lg-5">

                <h3 class="mt-5">Register</h3>
                <p style="color: rgb(163, 163, 163)">Register untuk mengakses menu pada Pasien</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" id="name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" id="email" class="form-control form-control-sm">
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" id="password" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="">Usia</label>
                                    <input type="number" id="usia" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    {{-- <input type="number" id="usia" class="form-control form-control-sm"> --}}
                                    <textarea name="" class="form-control" id="alamat" cols="30" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">No Hp</label>
                                    <input type="number" id="no_hp" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    {{-- <input type="text" id="name" class="form-control form-control-sm"> --}}
                                    <select name="jenis_kelamin" class="form-control form-control-sm" id="jenis_kelamin">
                                        <option value="l">Laki-Laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>




                        <div class="text-right">
                            <button class="btn btn-sm btn-primary" id="btn-login">
                                Register
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
                url: window.location.origin + '/api/register',
                method: 'POST',
                data: {
                    name : $('#name').val(),
                    usia : $('#usia').val(),
                    alamat : $('#alamat').val(),
                    no_hp : $('#no_hp').val(),
                    jenis_kelamin : $('#jenis_kelamin').val(),
                    email: email,
                    password: password
                },
                success: function(res){

                    console.log(res)
                    var data = res.data
                    if(res.status == 'success'){
                       window.location.href = window.location.origin + '/login'
                    }else{
                        alert(res.message)
                    }
                },error : function (res) {
                    // alert(res);
                    alert("Username atau password salah")
                }
            })
        })
    </script>
</body>
</html>


@endsection
