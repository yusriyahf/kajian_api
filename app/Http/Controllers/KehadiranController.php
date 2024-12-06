<?php

namespace App\Http\Controllers;

use App\Models\KehadiranModel;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
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
