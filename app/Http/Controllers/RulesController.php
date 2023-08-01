<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\GejalaAlergi;
use App\Traits\Response;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    use Response;

    public function index()
    {
        try {
            $data = GejalaAlergi::with('alergi')->get();
            // dd($data-[>id_gejala);
            $dataRet = [];
            foreach ($data as $key => $value) {
                array_push($dataRet, [
                    'id' => $value->id,
                    'alergi' => $value->alergi->nama_alergi,
                    'gejala' => []
                ]);
                // dd(json_decode($data[$key]['id_gejala']));
                foreach (json_decode($data[$key]['id_gejala']) as $k2 => $v2) {
                    array_push($dataRet[$key]['gejala'], Gejala::find($v2)->gejala);
                }
            }
            // dd($dataRet);
            return $this->success($dataRet, 'Data Rules');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        # code...
        try {
            $data = GejalaAlergi::with('alergi')->where('id', $id)->first();
            // dd($data-[>id_gejala);
            $dataRet = [
                'id' => $data->id,
                'alergi' => $data->alergi->id,
                'gejala' => [],
                'saran' => $data->saran
            ];
            // dd(json_decode($data[$key]['id_gejala']));
            foreach (json_decode($data['id_gejala']) as $k2 => $v2) {
                array_push($dataRet['gejala'], Gejala::find($v2)->id);
            }
            // dd($dataRet);
            return $this->success($dataRet, 'Data Rules');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = GejalaAlergi::create([
                'id' => $request->id,
                'id_alergi' => $request->id_alergi,
                'id_gejala' => json_encode($request->id_gejala),
                'saran' => $request->saran
            ]);
            return $this->success($data, 'Berhasil Menambahkan Rules');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = GejalaAlergi::find($id)->update([
                'id' => $request->id,
                'id_alergi' => $request->id_alergi,
                'id_gejala' => json_encode($request->id_gejala),
                'saran' => $request->saran
            ]);
            return $this->success($data, 'Berhasil Mengubah Rules');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = GejalaAlergi::find($id)->delete();
            return $this->success($data, 'Berhasil Menghapus Rules');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
