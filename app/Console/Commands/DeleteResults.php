<?php

namespace App\Console\Commands;

use App\User;
use App\PruebaRendidaUsuario;
use App\RespuestasUsuario;
use Illuminate\Console\Command;

class DeleteResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrar:resultado {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borrar resultados de un usuario';

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
		$email = trim($this->argument('email'));
        $this->info('Borrando resultados de '.$email);
		$user = User::where('email', $email)->first();
		if ($user) {
			$user->presento = 0;
			$user->save();
			PruebaRendidaUsuario::where('id_usuario', $user->id)->delete();
			RespuestasUsuario::where('id_usuario', $user->id)->delete();
			$this->info('Resultados eliminados para usuario : '.$email);
		} else {
			$this->info('usuario con email :'.$email.' no existe');
		}
    }
}
