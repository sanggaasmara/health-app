@extends('layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-md-10">
            <h3>Rules</h3>
        </div>
        <div class="col text-right">
            <button class="btn btn-primary" id="btn-add-rule">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>


@endsection


@section('content-card')
<div class="table-responsive">
    <table class="table" id="konsultasi-table">
        <thead class="thead-dark" >
                <tr>
                    <th>No.</th>
                    <th>Penyakit</th>
                    <th style="width: 300px;">Gejala</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


<div class="modal fade" id="modal-add-rule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" name="" id="rule_id" hidden>
            <table>
                <div class="form-group">
                    <label for="alergi">ID</label>
                    <input type="text" id="id" class="form-control form-control-sm">
                </div>
               <div class="form-group">
                <label for="alergi">alergi</label>
                {{-- <input type="text" id="alergi" class="form-control form-control-sm"> --}}
                <select name="" id="alergi" class="form-control form-control-sm">

                </select>
               </div>
               <div class="form-group">
                <label for="alergi">Gejala</label>
                <br>
                <select name="" multiple class="form-control select-mygejala" style="width: 100%" id="gejala">

                </select>
               </div>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btn-save-rule">Simpan</button>
        </div>
      </div>
    </div>
  </div>


@endsection


@section('script')

<script>
    $.ajax({
        url : "/api/rules",
        type: "GET",
        success: function (data) {
            console.log(data);
        }
    })
     $(document).ready(function () {
                checkUrl();
                $('#konsultasi-table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url : "/api/rules",
                        type: "GET",
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'alergi', name: 'nama'},
                        {data: 'gejala', name: 'gejala',
                            render : function (data, type, row) {
                                var gjl = ``;
                                data.forEach(element => {
                                    gjl += `<li>${element}</li>`

                                });
                                return gjl;
                                // return gejala.join('\n')
                            }
                        },
                        {data: 'id',
                            render : function(data, type, row) {
                                return `

                                    <button class="btn btn-sm btn-primary btn-detail-konsul" data-id="${data}">Detail</button>
                                    <button class="btn btn-sm btn-warning btn-edit-konsul" data-id="${data}">Edit</button>
                                    <button class="btn btn-sm btn-danger btn-hapus-konsul" data-id="${data}">Hapus</button>`
                            }
                        },
                    ]
                })
            })


    function getGejala() {
        $.ajax({
            url : "/api/gejala",
            type: "GET",
            success: function (data) {
                console.log(data);
                var gejala = [];
                data.data.forEach(element => {
                    gejala.push({
                        id : element.id,
                        text : element.gejala
                    })
                });
                $(".select-mygejala").select2({
                    data : gejala
                })
            }
        })
    }

    function getAlergi() {
        $.ajax({
            url : "/api/alergi",
            type: "GET",
            success: function (data) {
                console.log(data);
                // var alergi = [];
                $("#alergi").html("").append(`
                    <option value="">Pilih Alergi</option>
                `);

                data.data.forEach(element => {
                    $("#alergi").append(`
                        <option value="${element.id}">${element.nama_alergi}</option>
                    `)
                });

            }
        })
    }

    $("body").on('click', '.btn-detail-konsul', function () {
        var id = $(this).data('id');
        $.ajax({
            url : "/api/rules/"+id,
            type: "GET",
            success: function (data) {
                console.log(data);
                $("#rule_id").val(data.data.id);
                $("#id").val(data.data.id);
                $("#alergi").val(data.data.id_alergi);
                $("#gejala").val(data.data.id_gejala);
                $("#modal-add-rule").modal('show')
                getGejala();
                getAlergi();
            }
        })
    })


    $("#btn-add-rule").on('click',function () {
        $("#modal-add-rule").modal('show')
        getGejala();
        getAlergi();
    })

    $("#btn-save-rule").on('click', function () {
        var alergi = $("#alergi").val();
        var gejala = $("#gejala").val();
        var id = $("#rule_id").val();
        var id_rule= $("#id").val();
        var url = "/api/rules";
        var method = "POST";

        if (id != "") {
            url = "/api/rules/"+id;
            method = "PUT";
        }


        $.ajax({
            url : url,
            type: method,
            data : {
                id : id_rule,
                id_alergi : alergi,
                id_gejala : gejala
            },
            success: function (data) {
                console.log(data);
                $("#modal-add-rule").modal('hide')
                $("#konsultasi-table").DataTable().ajax.reload();
            }
        })
    })
</script>
@endsection
