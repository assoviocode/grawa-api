<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $path = public_path('cidades.sql');
        // $path = 'app/developer_docs/countries.sql';
        // $sql = file_get_contents($path);
        // DB::unprepared($sql);
        //Eloquent::unguard();

        //$this->call('UserTableSeeder');
        $this->command->info('Cidade seeded!');

        $path = 'development/cidades.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cidade table seeded!');
    }
}
