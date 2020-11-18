<?php

use Illuminate\Database\Seeder;

class IklanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Iklan::create([
            'isi_iklan'  => 'test',
        ]);
    }
}
