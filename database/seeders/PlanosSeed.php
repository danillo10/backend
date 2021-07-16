<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlanosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Planos')->insert([
            [
                'nome' => 'Free',
                'mensalidade' => '0,00'
            ],
            [
                'nome' => 'Basic',
                'mensalidade' => '100,00'
            ],
            [
                'nome' => 'Plus',
                'mensalidade' => '187,00'
            ]
        ]);
    }
}
