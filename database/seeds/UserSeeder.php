<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      

        //PARTICIPANTES
        User::create([
            'name' => 'Alejandra Sepulveda',
            'email' => 'a.sepulveda@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Manuel Contreras',
            'email' => 'm.contreras@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Cristhian Ferrada',
            'email' => 'c.ferrada@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Daniel Donoso',
            'email' => 'ddonoso.ochoa@gmail.com',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Jonathan Rojas',
            'email' => 'j.rojas@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);
        

        User::create([
            'name' => 'José Trejo',
            'email' => 'j.trejo@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);


        User::create([
            'name' => 'Yixsa Gallardo',
            'email' => 'y.gallardo@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);


        User::create([
            'name' => 'Cristian Fuentes',
            'email' => 'c.fuentes@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);


        User::create([
            'name' => 'Juliana Marquez',
            'email' => 'j.marquez@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);



        User::create([
            'name' => 'Felipe Diaz',
            'email' => 'logistica@fulltorque.cl',
            'password' =>  bcrypt('123456'),
        ]);


        User::create([
            'name' => 'Javier Ferrada',
            'email' => 'javier_tks@hotmail.com',
            'password' =>  bcrypt('123456'),
        ]);



        User::create([
            'name' => 'George Duarte',
            'email' => 'duartegtorres@gmail.com',
            'password' =>  bcrypt('123456'),
        ]);


        User::create([
            'name' => 'Esteban Vidal',
            'email' => 'esteban_moreno04@hotmail.com',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Nelson Cabello',
            'email' => 'njcabello18@gmail.com',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Ramon Aracena',
            'email' => 'ramon.aracena2608@gmail.com',
            'password' =>  bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Administrado del Sistema',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('123456'),
            'is_admin' => true
        ]);
    }
}
