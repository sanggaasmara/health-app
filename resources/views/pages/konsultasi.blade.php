@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Konsultasi</h1>
        </div>
    </div>

    <div class="row d-flex">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                        <h3>Catatan</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card border-0 shadow">
                <div class="card-header">
                    <h3>Form Konsultasi</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" id="nama" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="" id="alamat" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">No. Hp</label>
                        <input type="text" id="no_hp" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" name="" id="tanggal_lahir" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" id="email" class="form-control form-control-sm">
                    </div>


                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input jenis-kelamin" type="radio" name="exampleRadios" id="laki" value="laki-laki" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  Laki - laki
                                </label>
                              </div>
                              &nbsp;
                              &nbsp;
                              <div class="form-check">
                                <input class="form-check-input jenis-kelamin" type="radio" name="exampleRadios" id="perempuan" value="perempuan">
                                <label class="form-check-label" for="exampleRadios2">
                                 Perempuan
                                </label>
                              </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Gejala</label>
                        <select name="gejalas[]" id="gejala" class="js-example-basic-multiple form-control " multiple>

                        </select>
                    </div>


                    <button class="btn btn-sm btn-primary mt-4" id="btn-simpan-konsultasi">
                        Simpan
                    </button>
                </div>
            </div>

        </div>

    </div>
@endsection


@section('script')

<script>


    $(document).ready(function() {


        $('.js-example-basic-multiple').select2({
            placeholder: 'Pilih Gejala',
            ajax: {
                url: window.location.origin +  '/api/gejala',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    var res = [];
                    console.log(data);
                    $.each(data.data, function(index, value) {
                        res.push({
                            id: value.id,
                            text: value.gejala
                        });
                    });
                    console.log(res);
                    return {
                        results: res
                    };
                },
                cache: true,
                maximumSelectionLength: 3
            },

        });

        // $('.js-example-basic-multiple').select2({
        //     placeholder: 'Pilih Gejala',
        //     ajax: {
        //         url: '/api/gejala',
        //         dataType: 'json',
        //         delay: 250,
        //         processResults: function (data) {
        //             return {
        //                 results: data.gejala
        //             };
        //         },
        //         cache: true
        //     }
        // });

        $('#gejala').on('change', function() {
            var gejala = $(this).val();
            var gjelas = [];
            $.each(gejala, function(index, value) {
                gjelas.push(value);
            });
            console.log(gjelas);
        });
    });

    $('#btn-simpan-konsultasi').on('click', function () {
        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        var no_hp = $('#no_hp').val();
        var email = $('#email').val();
        var gejala = $('#gejala').val();
        var jenis_kelamin = $('.jenis-kelamin:checked').val();
        var tanggal_lahir = $('#tanggal_lahir').val();
        var usia =  new Date().getFullYear() - tanggal_lahir.split('-')[0] ;
        console.log(usia);
        $.ajax({
            url: window.location.origin + '/api/konsultasi',
            method: 'POST',
            data: {
                nama: nama,
                alamat: alamat,
                no_hp: no_hp,
                email: email,
                gejala: gejala,
                jenis_kelamin: jenis_kelamin,
                usia: usia
            },
            success: function (response) {
                console.log(response);
                if (response.status == 'success') {
                    alert(response.message);
                    // window.location.href = window.location.origin + '/hasil/' + response.id;
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    })
</script>
@endsection
