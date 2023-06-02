@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>List Konsultasi</h1>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="konsultasi-table">
                    <thead class="thead-dark" >
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Usia</th>
                                <th>No. hp</th>
                                <th>Gejala</th>
                                <th>Aksi</th>
                            </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
            $(document).ready(function () {
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
                        {data: 'gejala', name: 'gejala'},
                        {data: 'id',
                            render : function(data, type, row) {
                                return '<a href="/admin/konsultasi/'+data+'" class="btn btn-primary btn-sm">Detail</a>'
                            }
                        },
                    ]
                })
            })
    </script>
@endsection
