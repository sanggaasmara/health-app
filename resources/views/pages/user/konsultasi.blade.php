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
@endsection


@section('script')

<script>


    $(document).ready(function() {
        checkUrl();

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

        var gejala = $('#gejala').val();

        $.ajax({
            url: window.location.origin + '/api/konsultasi',
            method: 'POST',
            data: {
                gejala: gejala,
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
