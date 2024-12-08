<?php

namespace App\Http\Controllers;

use App\Models\PembayaranModel;
use Illuminate\Http\Request;

class PembayaranControllerWeb extends Controller
{
    public function index()
    {
        $data = PembayaranModel::all();
        return view('pembayaran.index', ['data' => $data]);
    }

    public function dashboard()
    {
        // Ambil data pembayaran dengan relasi ke KajianModel
        // $pembayaran = PembayaranModel::with('kajian')->get();

        // // Ambil data harga dari KajianModel
        // $salesData = $pembayaran->map(function ($pembayaran) {
        //     return [
        //         'date' => $pembayaran->created_at->format('F Y'), // Ambil bulan dan tahun dari pembayaran
        //         'price' => $pembayaran->kajian->price, // Ambil harga dari KajianModel
        //     ];
        // });

        // // Ubah ke koleksi dan Kelompokkan data berdasarkan bulan
        // $groupedSales = collect($salesData)->groupBy('date')->map(function ($monthSales) {
        //     return $monthSales->sum('price'); // Menghitung total harga per bulan
        // });

        // $total = PembayaranModel::sum('jumlah');

        // Kirim data ke view
        return view('welcome');
    }
}
