<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\KehadiranModel;
use Illuminate\Http\Request;

class KajianControllerWeb extends Controller
{
    public function index()
    {
        $data = Kajian::all();
        return view('kajian.index', ['data' => $data]);
    }

    public function create()
    {
        return view('kajian.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'speaker_name' => 'required',
            'theme' => 'required',
            'date' => 'required',
            'location' => 'required',
            'price' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $image = $this->saveImage($request->image, 'kajian');

        Kajian::create($validatedData);

        return redirect('/kajian')->with('success', 'Data kajian Berhasil Ditambahkan');
    }

    public function edit(string $id)
    {
        $data = Kajian::find($id);
        $kehadiran = KehadiranModel::where('kajian_id', $id)->get();
        $totalMale = KehadiranModel::where('kajian_id', $id)
            ->where('male', true)
            ->count();
        $totalFemale = KehadiranModel::where('kajian_id', $id)
            ->where('male', true)
            ->count();
        $totalAll = $totalFemale + $totalMale;
        $price = $data->price;

        $totalPrice = $price * $totalAll;
        return view('kajian.edit', [
            'data' => $data,
            'kehadiran' => $kehadiran,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'totalAll' => $totalAll,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'speaker_name' => 'required',
            'theme' => 'required',
            'date' => 'required',
            'price' => 'required',
            'location' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Kajian::find($id)->update([
            'title' => $request->title,
            'speaker_name' => $request->speaker_name,
            'theme' => $request->theme,
            'date' => $request->date,
            'price' => $request->price,
            'location' => $request->location,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect('/kajian')->with('success', 'Data Kajian berhasil diubah');
    }

    public function destroy(String $id)
    {
        $check = Kajian::find($id);
        if (!$check) {
            return redirect('/kajian')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            Kajian::destroy($id);

            return redirect('/kajian')->with('success', 'Data kajian berhasil dihapus');
        } catch (\illuminate\Database\QueryException $e) {
            return redirect('/kajian')->with('error' . 'Data kajian gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
