<?php

namespace App\Http\Controllers;

use App\Models\TiketModel;
use App\Models\User;
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

    public function checkTiket(Request $request)
    {
        $validatedData = $request->validate([
            'kajian_id' => 'required',
            'name' => 'required|string',
        ]);

        // Pisahkan nama menjadi first_name dan last_name
        $nameParts = explode(' ', $validatedData['name'], 2);
        $first_name = $nameParts[0];
        $last_name = isset($nameParts[1]) ? $nameParts[1] : '';

        // Cari user_id berdasarkan first_name dan last_name
        $user = User::where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Cek keberadaan tiket berdasarkan kajian_id dan user_id
        $exists = TiketModel::where('kajian_id', $validatedData['kajian_id'])
            ->where('user_id', $user->id)
            ->exists();

        return response()->json(['tiket' => $exists], 200);
    }

    public function getIdUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $nameParts = explode(' ', $validatedData['name'], 2);
        $first_name = $nameParts[0];
        $last_name = isset($nameParts[1]) ? $nameParts[1] : '';

        // Cari user_id berdasarkan first_name dan last_name
        $user = User::where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->first();

        if ($user) {
            // Mengembalikan id dari user yang ditemukan
            return response()->json(['user_id' => $user->id], 200);
        } else {
            // Jika tidak ditemukan, mengembalikan error
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function totalMale()
    {
        $totalMale = User::where('gender', 'Laki-laki')
            ->where('role', 2)
            ->count();

        return response([
            'totalMale' => $totalMale,
        ], 200);
    }

    public function totalFemale()
    {
        $totalFemale = User::where('gender', 'Perempuan')
            ->where('role', 2)
            ->count();

        return response([
            'totalFemale' => $totalFemale,
        ], 200);
    }

    public function totalAll()
    {
        $totalUsers = User::where('role', 2)->count();
        return response([
            'totalFemale' => $totalUsers,
        ], 200);
    }
    // public function totalGender()
    // {
    //     $totalMale = User::where('gender', 'Laki-laki')
    //         ->where('role', 2)
    //         ->count();

    //     $totalFemale = User::where('gender', 'Perempuan')
    //         ->where('role', 2)
    //         ->count();

    //     $totalAll = $totalFemale + $totalMale;

    //     return response([
    //         'totalMale' => $totalMale,
    //         'totalFemale' => $totalFemale,
    //         'totalAll' => $totalAll,
    //     ], 200);
    // }
}
