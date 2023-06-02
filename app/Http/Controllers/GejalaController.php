<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Traits\Response;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    //
    use Response;

    public function index()
    {
        try {
            $data = Gejala::all();

            return $this->success($data, 'Data Gejala');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
