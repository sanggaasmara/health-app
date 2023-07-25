<?php

namespace App\Http\Controllers;

use App\Models\Alergi;
use App\Models\Gejala;
use App\Models\GejalaAlergi;
use App\Models\KonsultasiAlergi;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiAlergiController extends Controller
{
    //
    use Response;

    public function index()
    {
        try {
            $data = KonsultasiAlergi::all();

            $gejala = [];
            foreach ($data as $key => $value) {
                $gjl = json_decode($value["gejala"]);
                foreach ($gjl as $key => $val) {
                    array_push($gejala, Gejala::find($val));
                    # code...
                }
                $value['gejalas'] = $gejala;
                $gejala = [];
            }
            return $this->success($data, 'Data Konsultasi Alergi');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function indexMy()
    {
        // dd(Auth::user());
        try {
            $data = KonsultasiAlergi::where("input_by", Auth::user()->id)->get();

            $gejala = [];
            if ($data != null) {
                # code...
                foreach ($data as $key => $value) {
                    $gjl = json_decode($value["gejala"]);
                    foreach ($gjl as $key => $val) {
                        array_push($gejala, Gejala::find($val));
                        # code...
                    }
                    $value['gejalas'] = $gejala;
                    $gejala = [];
                }
            }
            return $this->success($data, 'Data Konsultasi Alergi');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $request['gejala'] = json_encode($request->gejala);
            $request['nama'] = $user['name'];
            $request['email'] = $user['email'];
            $request['no_hp'] = $user['no_hp'];
            $request['alamat'] = $user['alamat'];
            $request['jenis_kelamin'] = $user['jenis_kelamin'];
            $request['usia'] = $user['usia'];
            if (Auth::check()) {
                # code...
                $request["input_by"] = Auth::user()->id ?? null;
            }
            $data = KonsultasiAlergi::create($request->all());
            return $this->success($data, 'Data Konsultasi Alergi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function storeGuest(Request $request)
    {
        # code...
        try {
            $request['gejala'] = json_encode($request->gejala);
            if (Auth::check()) {
                # code...
                $request["input_by"] = Auth::user()->id ?? null;
            }
            $data = KonsultasiAlergi::create($request->all());
            return $this->success($data, 'Data Konsultasi Alergi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $data = KonsultasiAlergi::find($id);
            $gejala = [];
            foreach (json_decode($data['gejala']) as $key => $val) {
                array_push($gejala, Gejala::find($val));
            }
            $data['gejalas'] = $gejala;

            return $this->success($data, 'Data Konsultasi Alergi');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = KonsultasiAlergi::find($id);
            $data->update($request->all());
            return $this->success($data, 'Data Konsultasi Alergi berhasil diubah');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function analisa($id)
    {
        try {
            $data = KonsultasiAlergi::find($id);
            $gejala = [];
            $hasil = [];
            foreach (json_decode($data['gejala']) as $key => $val) {
                array_push($gejala, Gejala::find($val));
            }
            $gjl_alergi = GejalaAlergi::all();

            foreach ($gjl_alergi as $key => $value) {
                # code...
                $hasil[$value["id"]] = [];
            }

            foreach ($gjl_alergi as $key => $value) {
                $gjl = json_decode($data["gejala"]);
                foreach ($gjl as $key => $val) {
                    if (in_array($val, json_decode($value['id_gejala']))) {
                        array_push($hasil[$value["id"]], $val);
                    }
                }
            }
            $perhitungan = [];
            foreach ($hasil as $key => $value) {
                if (count($value) == 0) {
                    unset($hasil[$key]);
                } else {
                    $gjl_al = GejalaAlergi::find($key);
                    $presentase = count($value) / count(json_decode($gjl_al["id_gejala"])) * 100;
                    $presentase = number_format((float)$presentase, 2, '.', '');
                    $alergi = Alergi::find($gjl_al["id_alergi"])->nama_alergi;
                    $perhitungan[$key] = [
                        'presentase' => $presentase,
                        'alergi' => $alergi,
                        'kesimpulan' =>  $presentase >= 50 && $presentase < 85 ? "Kemungkinan Besar mengalami " . $alergi . " dengan presentase " . $presentase . '%' : ($presentase >= 85 ? "Sangat mungkin mengalami " . $alergi  . " dengan presentase " . $presentase . '%' : ("Kemungkinan Kecil mengalami " . $alergi . " dengan presentase " . $presentase . '%'))
                    ];
                }
            }

            $ret = "";
            foreach ($perhitungan as $key => $value) {
                # code...
                $ret .= "&#8226; " . $value["kesimpulan"] . "<br>";
            }

            $data->update([
                'hasil_diagnosa' => $ret
            ]);


            return $this->success($ret, 'Data Konsultasi Alergi');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $data = KonsultasiAlergi::find($id);
            $data->delete();
            return $this->success($data, 'Data Konsultasi Alergi berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
