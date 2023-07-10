<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GejalaController extends Controller
{
    //
    use Response;

    public function index()
    {
        try {
            $data = DB::select('SELECT * FROM gejala');

            // $dataReturn = [];
            // $id = 1;
            // foreach ($data as $key => $value) {
            //     if (explode('G', $value->id)[1] == $id) {
            //         # code...
            //         $dataReturn[$id]['id'] = $value->id;
            //     }
            //     $id++;
            // }
            // dd($dataReturn);

            return $this->success($data, 'Data Gejala');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = Gejala::create($request->all());
            return $this->success($data, 'Data Gejala berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function show($id)
    {

        try {
            $data = Gejala::find($id);
            return $this->success($data, 'Data Gejala');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Gejala::find($id);
            $data->update($request->all());
            return $this->success($data, 'Data Gejala berhasil diubah');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Gejala::find($id);
            $data->delete();
            return $this->success($data, 'Data Gejala berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
