<?php

namespace App\Http\Controllers;

use App\Models\TiketModel;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        return response([
            'tiket' => TiketModel::with([
                'user:id,first_name,last_name,email',
                'kajian:id,image,title,speaker_name,theme,date,location,start_time,end_time'
            ])->get()
            // 'tiket' => TiketModel::all()
        ], 200);
    }


    // get single post
    public function show($id)
    {
        return response([
            'tiket' => TiketModel::where('id', $id)->get()
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
