<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PruebaSeeder::class);
        $this->call(EncabezadoPruebaSeeder::class);
        $this->call(EstadoPruebaSeeder::class);
        $this->call(TipoPruebaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PreguntaSeeder::class);
        $this->call(AlternativaSeeder::class);
        $this->call(RespuestasPruebaSeeder::class);
    }
}
