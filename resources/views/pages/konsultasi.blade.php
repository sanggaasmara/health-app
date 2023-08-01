@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Konsultasi</h3>
        </div>
    </div>

@endsection


@section('content-card')

    <div class="row d-flex">
        <div class="col-md-6">
                        <h3>Catatan</h3>
        </div>

        <div class="col-md-6">


                    <h3>Form Konsultasi</h3>

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" id="nama" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="" id="alamat" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">No. Hp</label>
                        <input type="text" id="no_hp" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="">Usia</label>
                        <input type="text" name="" id="usia" class="form-control form-control-sm">
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

                    <div class="text-right">

                        <button class="btn btn-sm btn-primary mt-4" id="btn-simpan-konsultasi">
                            Simpan
                        </button>
                    </div>
                </div>


    </div>

    <div class="modal fade" id="modal-hasil-konsul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="text" name="" id="konsul_id" hidden>
                <table>

                    <tr>
                        <td class="pb-4" style="width:100px;">Name</td>
                        <td class="pb-4" id="name"></td>
                    </tr>
                    <tr>
                        <td class="pb-4">Usia</td>
                        <td class="pb-4" id="usia-dtl"></td>
                    </tr>
                    <tr>
                        <td class="pb-4">No. HP</td>
                        <td class="pb-4" id="no_hp-dtl"></td>
                    </tr>
                    <tr>
                        <td class="align-top pb-4">Gejala</td>
                        <td class="pb-4" id="gejala-dtl"></td>
                    </tr>
                    <tr>
                        <td class="pb-4 align-top">Hasil</td>
                        <td class="pb-4" id="hasil-dtl">

                        </td>

                    </tr>
                    <tr>
                        <td class="align-top pb-4">Saran Dokter</td>
                        <td class="pb-4" id="saran"></td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
        var usia =  $('#usia').val();
        console.log(usia);
        $.ajax({
            url: window.location.origin + '/api/konsultasi/guest',
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
            success: function (data) {
                $('#nama').val("");
                $('#alamat').val("");
                $('#no_hp').val("");
                $('#email').val("");
                $('#gejala').val("");
                $('#usia').val("");
                var response = data.data;
                console.log(data);
                var response = data.data;
                if (data.status == 'success') {
                    // alert(response.message);
                    $("#modal-hasil-konsul").modal('show');
                    // $('#konsul_id').val(response.id);
                    $('#name').html(response.nama);
                    $('#usia-dtl').html(response.usia);
                    $('#no_hp-dtl').html(response.no_hp);
                    $('#gejala-dtl').html('');
                    response.gejalas.forEach(element => {
                            $('#gejala-dtl').append(`<li>${element.gejala}</li>`);
                        });
                    $('#hasil-dtl').html(response.hasil_diagnosa);
                    $('#saran').html(response.saran);
                    // window.location.href = window.location.origin + '/hasil/' + response.id;
                } else {
                    alert(data.message);
                }
            }
        });
    })
</script>
@endsection
