@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-md-10">
        <h3>Gejala</h3>
    </div>
    <div class="col text-right">
        <button class="btn btn-primary" id="btn-add-gejala">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

@endsection



@section('content-card')

            <div class="table-responsive">
                <table class="table" id="gejala-table">
                    <thead class="thead-dark" >
                            <tr>
                                <th style="width: 50px;">No.</th>

                                <th>Gejala</th>
                                <th >Aksi</th>
                            </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>



    <div class="modal fade" id="modal-add-gejala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="text" name="" id="gejala_id" hidden>
                <table>
                    <div class="form-group">
                        <label for="gejala">ID</label>
                        <input type="text" id="id_gejala" class="form-control form-control-sm">
                    </div>
                   <div class="form-group">
                    <label for="gejala">Gejala</label>
                    <input type="text" id="gejala" class="form-control form-control-sm">
                   </div>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="btn-save-gejala">Simpan</button>
            </div>
          </div>
        </div>
      </div>

@endsection


@section('script')
<script>
    $(document).ready(function () {
        checkUrl();
        $('#gejala-table').DataTable({
            processing: true,
                    serverSide: false,
                    ajax: {
                        url : "/api/gejala",
                        type: "GET",
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'gejala', name: 'gejala'},
                        {data: 'id',
                            render : function(data, type, row) {
                                return `
                                    <button class="btn btn-sm btn-warning btn-edit-gejala" data-id="${data}"><i class="fas fa-pencil-alt"></i></button>&nbsp;
                                    <button class="btn btn-sm btn-danger btn-delete-gejala" data-id="${data}"><i class="fas fa-trash"></i></button>&nbsp;`
                            }
                        },
                    ]
        })
    })

    $('#btn-add-gejala').click(function () {
        $('#modal-add-gejala').modal('show');
    })

    $('body').on('click', '.btn-edit-gejala', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '/api/gejala/' + id,
            type: 'GET',
            success: function (data) {
                var response = data.data;
                console.log(response);
                $('#gejala_id').val(response.id);
                $('#id_gejala').val(response.id);
                $('#gejala').val(response.gejala);
                $('#modal-add-gejala').modal('show');
            }
        })
    })

    $('#btn-save-gejala').click(function () {
        let gejala = $('#gejala').val();
        let url = '/api/gejala';
        var idGjl = $('#id_gejala').val();
        let method = 'POST';
        var id = $('#gejala_id').val();
        if (id) {
            url = '/api/gejala/' + id;
            method = 'PUT';
            id = $('#gejala_id').val();
        }
        $.ajax({
            url: url,
            type: method,
            data: {
                id : idGjl ?? id,
                gejala: gejala
            },
            success: function (response) {
                $('#modal-add-gejala').modal('hide');
                $('#gejala-table').DataTable().ajax.reload();
            }
        })
    })

    $('body').on('click', '.btn-delete-gejala', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/gejala/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        $('#gejala-table').DataTable().ajax.reload();
                    }
                })
            }
          })
    })
</script>
@endsection
