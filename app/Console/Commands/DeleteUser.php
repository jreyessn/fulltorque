<?php

namespace App\Console\Commands;

use App\User;
use App\PruebaRendidaUsuario;
use App\RespuestasUsuario;
use Illuminate\Console\Command;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrar:usuario {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para borrar usuario y resultados';

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
		$user  = User::where('email', $email)->first();
		if($user == null) {
			$this->info('usuario no existe');
			return false;
		}
		if($user->is_admin == 1) {
			$this->info('usuario tiene permisos de administrador');
			return false;
		}
		$this->info('borrando resultados...');
		PruebaRendidaUsuario::where('id_usuario', $user->id)->delete();
		RespuestasUsuario::where('id_usuario', $user->id)->delete();
		$this->info('borrando usuario');
		$user->delete();
		$this->info('usuario eliminado de forma exitosa');
    }
}
