<?php

namespace App\Http\Controllers;

use App\Models\Alergi;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlergiController extends Controller
{
    //
    use Response;

    public function index()
    {
        $alergi = Alergi::all();
        return $this->success($alergi, 'Data alergi berhasil diambil');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $alergi = Alergi::create($request->all());
            DB::commit();
            return $this->success($alergi, 'Data alergi berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $alergi = Alergi::find($id);
        if (!$alergi) {
            return $this->error('Data alergi tidak ditemukan', 404);
        }
        return $this->success($alergi, 'Data alergi berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $alergi = Alergi::find($id);
            if (!$alergi) {
                return $this->error('Data alergi tidak ditemukan', 404);
            }
            $alergi->update($request->all());
            DB::commit();
            return $this->success($alergi, 'Data alergi berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $alergi = Alergi::find($id);
            if (!$alergi) {
                return $this->error('Data alergi tidak ditemukan', 404);
            }
            $alergi->delete();
            DB::commit();
            return $this->success($alergi, 'Data alergi berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage(), 500);
        }
    }
}
