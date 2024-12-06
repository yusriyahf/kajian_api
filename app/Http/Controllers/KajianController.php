<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\KehadiranModel;
use Illuminate\Http\Request;

class KajianController extends Controller
{

    public function index()
    {
        return response([
            'kajian' => Kajian::all()
        ], 200);
    }

    public function kajianToday()
    {
        // Get the current date
        $currentDate = now()->toDateString(); // Formats to 'YYYY-MM-DD'

        // Find the Kajian with the current date
        $kajian = Kajian::whereDate('date', $currentDate)->get();

        if (!$kajian) {
            return response([
                'message' => 'No kajian found.'
            ], 404);
        }

        return response([
            'kajian' => $kajian
        ], 200);
    }

    public function kajianLast()
    {
        $kajians = Kajian::latest()->take(2)->get(); // Ambil 2 entri terakhir

        if ($kajians->isEmpty()) {
            return response([
                'message' => 'No kajian found.'
            ], 404);
        }

        return response([
            'kajian' => $kajians
        ], 200);
    }


    // get single post
    public function show($id)
    {
        return response([
            'kajian' => Kajian::where('id', $id)->get()
        ], 200);
    }

    // create a post
    public function store(Request $request)
    {
        // Validate fields
        $attrs = $request->validate([
            'title' => 'required|string',
            'speaker_name' => 'required|string',
            'theme' => 'required|string',
            'price' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        // Save the image
        $image = $this->saveImage($request->image, 'kajian');

        // Create the Kajian
        $kajian = Kajian::create([
            'title' => $attrs['title'],
            'speaker_name' => $attrs['speaker_name'],
            'theme' => $attrs['theme'],
            'date' => $attrs['date'],
            'price' => intval($attrs['price']),
            'location' => $attrs['location'],
            'start_time' => $attrs['start_time'],
            'end_time' => $attrs['end_time'],
            'image' => $image
        ]);

        // $kehadiran = KehadiranModel::create([
        //     'kajian_id' => $kajian->id,
        // ]);

        // Return response
        return response([
            'message' => 'Kajian created.',
            'kajian' => $kajian,
            // 'kehadiran' => $kehadiran,
        ], 200);
    }


    // update a post
    public function update(Request $request, $id)
    {
        $kajian = Kajian::find($id);

        if (!$kajian) {
            return response([
                'message' => 'kajian not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'title' => 'required|string',
            'speaker_name' => 'required|string',
            'theme' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        $kajian->update([
            'title' => $attrs['title'],
            'speaker_name' => $attrs['speaker_name'],
            'theme' => $attrs['theme'],
            'date' => $attrs['date'],
            'location' => $attrs['location'],
            'start_time' => $attrs['start_time'],
            'end_time' => $attrs['end_time'],
        ]);

        // for now skip for kajian image

        return response([
            'message' => 'kajian updated.',
            'kajian' => $kajian
        ], 200);
    }

    //delete post
    public function destroy($id)
    {
        $kajian = Kajian::find($id);

        if (!$kajian) {
            return response([
                'message' => 'kajian not found.'
            ], 403);
        }

        if ($kajian->user_id != auth()->user()->id) {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $kajian->delete();

        return response([
            'message' => 'Kajian deleted.'
        ], 200);
    }

    // public function index()
    // {
    //     $data = Kajian::all();
    //     return $data;
    // }

    // public function store(Request $request)
    // {
    //     $save = new Kajian();
    //     $save->image = $request->image;
    //     $save->title = $request->title;
    //     $save->speaker_name = $request->speaker_name;
    //     $save->theme = $request->theme;
    //     $save->date = $request->date;
    //     $save->location = $request->location;
    //     $save->start_time = $request->start_time;
    //     $save->end_time = $request->end_time;
    //     $save->save();

    //     return "Berhasil Menyimpan Data";
    // }

    // public function show(Request $request)
    // {
    //     $data = Kajian::all()->where('kajian_id', $request->kajian_id)->first();
    //     return $data;
    // }

    // public function update(Request $request)
    // {
    //     $data = Kajian::all()->where('kajian_id', $request->kajian_id)->first();
    //     $data->image = $request->image;
    //     $data->title = $request->title;
    //     $data->speaker_name = $request->speaker_name;
    //     $data->theme = $request->theme;
    //     $data->date = $request->date;
    //     $data->location = $request->location;
    //     $data->start_time = $request->start_time;
    //     $data->end_time = $request->end_time;
    //     $data->save();
    //     return "Berhasil Mengubah Data";
    // }


    // public function destroy(Request $request)
    // {
    //     $del = KajianModel::all()->where('kajian_id', $request->kajian_id)->first();
    //     $del->delete();
    //     return "Berhasil Menghapus Data";
    // }
}
