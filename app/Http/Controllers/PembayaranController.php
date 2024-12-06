<?php

namespace App\Http\Controllers;

use App\Models\PembayaranModel;
use App\Models\TiketModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function index()
    {
        return response([
            'pembayaran' => PembayaranModel::with([
                'user:id,first_name,last_name,email',
                'kajian:id,image,title,speaker_name,theme,date,location,start_time,end_time,price'
            ])
                ->where('status', 'diproses')
                ->get()
        ], 200);
    }


    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'kajian_id' => 'required|string',
        ]);

        // Check if the payment already exists
        $existingPembayaran = PembayaranModel::where('kajian_id', $attrs['kajian_id'])
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($existingPembayaran) {
            return response([
                'message' => 'Pembayaran untuk kajian ini sudah ada.',
            ], 400); // Gunakan HTTP status 400 untuk Bad Request
        }

        // Save the payment proof image
        $bukti_pembayaran = $this->saveImage($request->bukti_pembayaran, 'pembayaran');

        // Create the new payment
        $pembayaran = PembayaranModel::create([
            'kajian_id' => $attrs['kajian_id'],
            'user_id' => auth()->user()->id,
            'date' => Carbon::now(),
            'status' => 'diproses',
            'bukti_pembayaran' => $bukti_pembayaran,
        ]);




        // Return success response
        return response([
            'message' => 'Pembayaran berhasil dibuat.',
            'pembayaran' => $pembayaran,
            // 'tiket' => $tiket,
        ], 200);
    }

    public function acc(Request $request, $id)
    {

        $pembayaran = PembayaranModel::find($id);

        if (!$pembayaran) {
            return response([
                'message' => 'pembayaran not found.'
            ], 403);
        }

        $attrs = $request->validate([
            'kajian_id' => 'required|string',
            // 'bukti_pemabayaran' => 'required|string',
        ]);

        $tiket = TiketModel::create([
            'kajian_id' => $attrs['kajian_id'],
            'user_id' => auth()->user()->id,
            // 'bukti_pembayaran' => $attrs['bukti_pembayaran'],
        ]);

        //validate fields
        // $attrs = $request->validate([
        //     'title' => 'required|string',
        //     'description' => 'required|string',
        // ]);

        $pembayaran->update([
            'status' => 'diacc',
        ]);


        // 
        // for now skip for kajian image

        return response([
            'message' => 'pembayaran updated.',
            'pembayaran' => $pembayaran,
            'tiket' => $tiket,
        ], 200);
    }

    public function tolak(Request $request, $id)
    {


        $pembayaran = PembayaranModel::find($id);

        if (!$pembayaran) {
            return response([
                'message' => 'pembayaran not found.'
            ], 403);
        }

        //validate fields
        // $attrs = $request->validate([
        //     'title' => 'required|string',
        //     'description' => 'required|string',
        // ]);

        $pembayaran->update([
            'status' => 'ditolak',
        ]);

        $pembayaran->update([
            'status' => 'ditolak',
        ]);


        // 
        // for now skip for kajian image

        return response([
            'message' => 'pembayaran updated.',
            'pembayaran' => $pembayaran
        ], 200);
    }
}
