@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/bootstrap.min.css">

@endsection

@section('content')
<h1 class="text-center">DAFTAR ALERGI YANG DAPAT DIKONSULTASIKAN</h1>
<div class="table-responsive">
    <table class="table" id="konsultasi-table">
        <thead class="thead-dark" >
                <tr>
                    <th>No.</th>
                    <th>Penyakit</th>

                </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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

            }
        })
    }
</script>
@endsection
