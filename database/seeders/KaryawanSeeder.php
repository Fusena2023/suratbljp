<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        db::table('karyawans')->insert([
            'nama' => 'Imam Maulana',
            'jeniskelamin' => 'laki',
            'notlpn' => '083811391499',
        ]);
    }
}
