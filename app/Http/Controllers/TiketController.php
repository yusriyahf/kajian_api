<?php

namespace App\Http\Controllers;

use App\Models\TiketModel;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        return response([
            'tiket' => TiketModel::all()
        ], 200);
    }

    // get single post
    public function show($id)
    {
        return response([
            'tiket' => TiketModel::where('tiket_id', $id)->get()
        ], 200);
    }
    // public function index()
    // {
    //     $data = TiketModel::all();
    //     return $data;
    // }

    // public function show(Request $request)
    // {
    //     $data = TiketModel::all()->where('tiket_id', $request->tiket_id)->first();
    //     return $data;
    // }
}
