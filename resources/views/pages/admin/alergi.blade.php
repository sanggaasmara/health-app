@extends('layouts.app')


@section('content')
<div class="row mb-3">
    <div class="col-md-10">
        <h3>alergi</h3>
    </div>
    <div class="col text-right">
        <button class="btn btn-primary" id="btn-add-alergi">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

@endsection



@section('content-card')

            <div class="table-responsive">
                <table class="table" id="alergi-table">
                    <thead class="thead-dark" >
                            <tr>
                                <th style="width: 50px;">No.</th>

                                <th>alergi</th>
                                <th >Aksi</th>
                            </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>



    <div class="modal fade" id="modal-add-alergi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="text" name="" id="alergi_id" hidden>
                <table>
                    <div class="form-group">
                        <label for="alergi">ID</label>
                        <input type="text" id="id_alergi" class="form-control form-control-sm">
                    </div>
                   <div class="form-group">
                    <label for="alergi">alergi</label>
                    <input type="text" id="alergi" class="form-control form-control-sm">
                   </div>
                   {{-- <div class="form-group">
                    <label for="alergi">Gejala</label>
                    <select name="" multiple class="form-control select-mygejala" id="gejala">

                    </select>
                   </div> --}}
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="btn-save-alergi">Simpan</button>
            </div>
          </div>
        </div>
      </div>

@endsection


@section('script')
<script>
    $(document).ready(function () {

        $('#alergi-table').DataTable({
            processing: true,
                    serverSide: false,
                    ajax: {
                        url : "/api/alergi",
                        type: "GET",
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'nama_alergi', name: 'alergi'},
                        {data: 'id',
                            render : function(data, type, row) {
                                return `
                                    <button class="btn btn-sm btn-warning btn-edit-alergi" data-id="${data}"><i class="fas fa-pencil-alt"></i></button>&nbsp;
                                    <button class="btn btn-sm btn-danger btn-delete-alergi" data-id="${data}"><i class="fas fa-trash"></i></button>&nbsp;`
                            }
                        },
                    ]
        })
    })

    $('#btn-add-alergi').click(function () {
        // $('.form-control').value = '';

        var label = document.querySelectorAll('.form-control').forEach(element => {
            element.value = '';
        }
        );

        $('#modal-add-alergi').modal('show');
        // $('.select-mygejala').select2({
        //     width: '100%',
        //     ajax: {
        //         url: '/api/gejala',
        //         type: 'GET',
        //         proccessResults: function (data) {

        //             var res = data.data.map(function (item) {
        //                 return { id: item.id, text: item.gejala };
        //             });
        //             console.log(res);

        //             return {
        //                 results: res
        //             };
        //         }
        //     }

        // })
    })

    $('body').on('click', '.btn-edit-alergi', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '/api/alergi/' + id,
            type: 'GET',
            success: function (data) {
                var response = data.data;
                console.log(response);
                $('#alergi_id').val(response.id);
                $('#id_alergi').val(response.id);
                $('#alergi').val(response.nama_alergi);
                $('#modal-add-alergi').modal('show');
            }
        })
    })

    $('#btn-save-alergi').click(function () {
        let alergi = $('#alergi').val();
        let url = '/api/alergi';
        var idGjl = $('#id_alergi').val();
        let method = 'POST';
        var id = $('#alergi_id').val();
        if (id) {
            url = '/api/alergi/' + id;
            method = 'PUT';
            id = $('#alergi_id').val();
        }
        $.ajax({
            url: url,
            type: method,
            data: {
                id : idGjl ?? id,
                nama_alergi: alergi
            },
            success: function (response) {
                $('#modal-add-alergi').modal('hide');
                $('#alergi-table').DataTable().ajax.reload();
            }
        })
    })

    $('body').on('click', '.btn-delete-alergi', function () {
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
                    url: '/api/alergi/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        $('#alergi-table').DataTable().ajax.reload();
                    }
                })
            }
          })
    })
</script>
@endsection
