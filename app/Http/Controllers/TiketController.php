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
                'kajian:id,image,title,speaker_name,theme,date,location,start_time,end_time,price'
            ])->get()
            // 'tiket' => TiketModel::all()
        ], 200);
    }

    public function tiketLast()
    {
        // Ambil 2 entri terakhir dan sertakan relasi user dan kajian
        $tiket = TiketModel::with([
            'user:id,first_name,last_name,email',
            'kajian:id,image,title,speaker_name,theme,date,location,start_time,end_time,price'
        ])
            ->latest()
            ->take(2)
            ->get();

        if ($tiket->isEmpty()) {
            return response([
                'message' => 'No tiket found.'
            ], 404);
        }

        return response([
            'tiket' => $tiket
        ], 200);
    }



    // get single post
    public function show($id)
    {
        return response([
            'tiket' => TiketModel::where('id', $id)->get()
        ], 200);
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            return response()->json(['bukti_pembayaran' => $path], 200);
        }

        return response()->json(['error' => 'Gagal mengunggah file'], 500);
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
