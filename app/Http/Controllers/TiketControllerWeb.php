<?php

namespace App\Http\Controllers;

use App\Models\TiketModel;
use Illuminate\Http\Request;

class TiketControllerWeb extends Controller
{
    public function index()
    {
        $data = TiketModel::all();
        return view('tiket.index', ['data' => $data]);
    }
}
