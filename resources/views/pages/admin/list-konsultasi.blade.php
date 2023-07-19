@extends('layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h3>List Konsultasi</h3>
        </div>
    </div>


@endsection


@section('content-card')

            <div class="table-responsive">
                <table class="table" id="konsultasi-table">
                    <thead class="thead-dark" >
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Usia</th>
                                <th>No. hp</th>
                                <th style="width: 300px;">Gejala</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>



    <div class="modal fade" id="modal-detail-konsul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <td class="pb-4" id="usia"></td>
                    </tr>
                    <tr>
                        <td class="pb-4">No. HP</td>
                        <td class="pb-4" id="no_hp"></td>
                    </tr>
                    <tr>
                        <td class="align-top pb-4">Gejala</td>
                        <td class="pb-4" id="gejala"></td>
                    </tr>
                    <tr>
                        <td class="pb-4 align-top">Hasil</td>
                        <td class="pb-4" id="hasil">

                        </td>
                        <td class="pb-4" style="width: 50px;">
                            <button class="btn btn-sm btn-primary" id="btn-diagnosa">
                                Diagnosa
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top mb-2">Saran</td>
                        <td class="mb-2" >
                            <textarea name="" class="form-control" id="saran" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="btn-save-konsul">Simpan</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('script')
    <script>
            $(document).ready(function () {
                checkUrl();
                $('#konsultasi-table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url : "/api/konsultasi",
                        type: "GET",
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'nama', name: 'nama'},
                        {data: 'usia', name: 'usia'},
                        {data: 'no_hp', name: 'no_hp'},
                        {data: 'gejalas', name: 'gejala',
                            render : function (data, type, row) {
                                var gjl = ``;
                                data.forEach(element => {
                                    gjl += `<li>${element.gejala}</li>`

                                });
                                return gjl;
                                // return gejala.join('\n')
                            }
                        },
                        {data: 'id',
                            render : function(data, type, row) {
                                return `

                                    <button class="btn btn-sm btn-primary btn-detail-konsul" data-id="${data}">Detail</button>`
                            }
                        },
                    ]
                })
            })

            $('body').on('click', '.btn-detail-konsul', function () {
                // console.log("test");
                $('#modal-detail-konsul').modal('show')
                var id = $(this).data('id')
                $.ajax({
                    url: `/api/konsultasi/${id}`,
                    type: "GET",
                    success: function (res) {
                        var data = res.data;
                        console.log(data.hasil_diagnosa);
                        $('#konsul_id').val(data.id)
                        $('#name').text(data.nama)
                        $('#usia').text(data.usia)
                        $('#no_hp').text(data.no_hp)
                        $('#gejala').html('')
                        data.gejalas.forEach(element => {
                            $('#gejala').append(`<li>${element.gejala}</li>`);
                        });
                        $('#hasil').html(data.hasil_diagnosa)
                        $('#saran').text(data.saran)
                    }
                })
            })

            $('#btn-diagnosa').on('click', function () {
                var id = $('#konsul_id').val()
                $.ajax({
                    url: `/api/konsultasi/${id}/diagnosa`,
                    type: "GET",
                    success: function (res) {
                        console.log(res);
                        $('#hasil').html(res.data)
                    }
                })
            })

    </script>
@endsection
