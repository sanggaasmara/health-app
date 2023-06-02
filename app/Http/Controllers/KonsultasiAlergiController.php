<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiAlergi;
use App\Traits\Response;
use Illuminate\Http\Request;

class KonsultasiAlergiController extends Controller
{
    //
    use Response;

    public function index()
    {
        try {
            $data = KonsultasiAlergi::all();
            return $this->success($data, 'Data Konsultasi Alergi');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request['gejala'] = json_encode($request->gejala);
            $data = KonsultasiAlergi::create($request->all());
            return $this->success($data, 'Data Konsultasi Alergi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
