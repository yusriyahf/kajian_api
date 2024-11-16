<?php

namespace App\Http\Controllers;

use App\Models\CatatanModel;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        return response([
            'catatan' => CatatanModel::where('user_id', auth()->user()->id)->get()
        ], 200);
    }

    // get single post
    public function show($id)
    {
        return response([
            'catatan' => CatatanModel::where('id', $id)->get()
        ], 200);
    }

    // create a post
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',

        ]);

        $catatan = CatatanModel::create([
            'user_id' => auth()->user()->id,
            'title' => $attrs['title'],
            'description' => $attrs['description'],
        ]);

        // for now skip for post image

        return response([
            'message' => 'Catatan created.',
            'catatan' => $catatan,
        ], 200);
    }

    // update a post
    public function update(Request $request, $id)
    {
        $catatan = CatatanModel::find($id);

        if (!$catatan) {
            return response([
                'message' => 'catatan not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $catatan->update([
            'user_id' => auth()->user()->id,
            'title' => $attrs['title'],
            'description' => $attrs['description'],
        ]);

        // for now skip for kajian image

        return response([
            'message' => 'catatan updated.',
            'catatan' => $catatan
        ], 200);
    }

    //delete post
    public function destroy($id)
    {
        $catatan = CatatanModel::where('id', $id)->first();

        if (!$catatan) {
            return response([
                'message' => 'catatan not found.'
            ], 403);
        }


        // if ($catatan->catatan_id != auth()->user()->id) {
        //     return response([
        //         'message' => 'Permission denied.'
        //     ], 403);
        // }

        $catatan->delete();

        return response([
            'message' => 'Kajian deleted.'
        ], 200);
    }
}
