<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crear:usuario {name} {surname} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear usuario con nombre apellido email y contraseña';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$name     = trim($this->argument('name'));
		$surname  = trim($this->argument('surname'));
        $email    = trim($this->argument('email'));
		$password = trim($this->argument('password'));
		$this->info('creando usuario con email :'.$email);
		
		if(strlen($password) < 6) {
			$this->info('contraseña debe tener al menos 6 caracteres (sin espacio)');
			return false;
		}
	
		$findUser = User::where('email', $email)->first();
		if($findUser) {
			$this->info('usuario ya existe en el sistema');
			return false;
		}
		$user = new User();
		$user->name = $name.' '.$surname;
		$user->email = $email;
		$user->password = bcrypt($password);
		$user->presento = 0;
		$user->is_admin = 0;
		$user->created_at = Carbon::now();
		$user->updated_at = Carbon::now();
		$user->save();
		$this->info('usuario creado de forma exitosa');
		
    }
}
