<?php

namespace Database\Seeders;

use App\Models\ListDSS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListDSSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListDSS::create([
            'dss_title'=>'Penilaian Kompetensi Guru 2023'
        ]);
    }
}
