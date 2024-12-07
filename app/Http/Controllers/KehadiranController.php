<?php

namespace App\Http\Controllers;

use App\Models\KehadiranModel;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function addKehadiran(Request $request)
    {
        // Validasi fields
        $attrs = $request->validate([
            'user_id' => 'required',
            'kajian_id' => 'required',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);

        $genderData = [];
        if ($attrs['gender'] == 'Laki-laki') {
            $genderData['male'] = true;
        } elseif ($attrs['gender'] == 'Perempuan') {
            $genderData['female'] = true;
        }

        // Check if record already exists
        $existingKehadiran = KehadiranModel::where('kajian_id', $attrs['kajian_id'])
            ->where('user_id', $attrs['user_id'])
            ->first();

        if ($existingKehadiran) {
            return response([
                'message' => 'Kehadiran already exists.',
                'kehadiran' => $existingKehadiran,
            ], 400); // Return error response with 400 status
        }

        // Create new record if not exists
        $kehadiran = KehadiranModel::create([
            'kajian_id' => $attrs['kajian_id'],
            'user_id' => $attrs['user_id'],
            'gender' => $attrs['gender'],
            ...$genderData, // Menyertakan data gender
        ]);

        return response([
            'message' => 'Kehadiran created.',
            'kehadiran' => $kehadiran,
        ], 201); // Return success response with 201 status
    }





    public function addMale(Request $request)
    {
        // Validate fields
        $attrs = $request->validate([
            'user_id' => 'required',
            'kajian_id' => 'required',
        ]);

        // Create or get existing record
        $kehadiran = KehadiranModel::firstOrCreate(
            [
                'kajian_id' => $attrs['kajian_id'],
                'user_id' => $attrs['user_id'],
            ],
            [
                'male' => true,
            ]
        );

        $message = $kehadiran->wasRecentlyCreated ? 'Kehadiran created.' : 'Kehadiran already exists.';

        return response([
            'message' => $message,
            'kehadiran' => $kehadiran,
        ], 200);
    }

    public function addFemale(Request $request)
    {
        // Validate fields
        $attrs = $request->validate([
            'user_id' => 'required',
            'kajian_id' => 'required',
        ]);

        // Create or get existing record
        $kehadiran = KehadiranModel::firstOrCreate(
            [
                'kajian_id' => $attrs['kajian_id'],
                'user_id' => $attrs['user_id'],
            ],
            [
                'female' => true,
            ]
        );

        $message = $kehadiran->wasRecentlyCreated ? 'Kehadiran created.' : 'Kehadiran already exists.';

        return response([
            'message' => $message,
            'kehadiran' => $kehadiran,
        ], 200);
    }

    public function totalKehadiran($id)
    {

        // Calculate the total counts for the given kajian_id
        $totalMale = KehadiranModel::where('kajian_id', $id)
            ->where('male', true)
            ->count();

        $totalFemale = KehadiranModel::where('kajian_id', $id)
            ->where('female', false)
            ->count();

        $totalKehadiran = $totalMale + $totalFemale;

        return response([
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'totalKehadiran' => $totalKehadiran,
        ], 200);
    }
    public function totalMale($id)
    {
        // Calculate the total counts for the given kajian_id
        $totalMale = KehadiranModel::where('kajian_id', $id)
            ->where('male', true)
            ->count();

        return response([
            'totalMale' => $totalMale,
        ], 200);
    }
    public function totalFemale($id)
    {
        // Calculate the total counts for the given kajian_id
        $totalFemale = KehadiranModel::where('kajian_id', $id)
            ->where('female', true)
            ->count();

        return response([
            'totalFemale' => $totalFemale,
        ], 200);
    }
    public function total($id)
    {
        // Calculate the total counts for the given kajian_id
        $total = KehadiranModel::where('kajian_id', $id)
            ->count();

        return response([
            'total' => $total,
        ], 200);
    }
}
