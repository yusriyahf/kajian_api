<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Kajian;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'first_name' => 'admin',
            'last_name' => '',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'password' => bcrypt('123456'),
            'gender' => 'Laki-laki',
        ]);

        User::create([
            'first_name' => 'yusriyah',
            'last_name' => 'firjatullah',
            'email' => 'yusriyah9@gmail.com',
            'role' => 2,
            'password' => bcrypt('123456'),
            'gender' => 'Laki-laki',
        ]);

        User::create([
            'first_name' => 'arya',
            'last_name' => 'bagus',
            'email' => 'arya@gmail.com',
            'role' => 2,
            'password' => bcrypt('123456'),
            'gender' => 'Laki-laki',
        ]);

        User::create([
            'first_name' => 'bimantara',
            'last_name' => 'dwi',
            'email' => 'bimantara@gmail.com',
            'role' => 2,
            'password' => bcrypt('123456'),
            'gender' => 'Laki-laki',
        ]);

        User::create([
            'first_name' => 'maulita',
            'last_name' => 'yasmin',
            'email' => 'maulita@gmail.com',
            'role' => 2,
            'password' => bcrypt('123456'),
            'gender' => 'Perempuan',
        ]);

        Kajian::create([
            'title' => 'Kajian Akhir Zaman',
            'speaker_name' => 'Ustadz Abdul Somad',
            'theme' => 'Persiapan Menghadapi Hari Akhir',
            'date' => now()->toDateString(),
            'price' => 20000,
            'location' => 'Masjid Raya Al-Falah, Surabaya',
            'start_time' => now()->format('H:i:s'), // Waktu sekarang
            'end_time' => now()->addHours(2)->format('H:i:s'),
            // 'image' => 'kajian_akhir_zaman.jpg' // Jika ada file gambar
        ]);
    }
}
