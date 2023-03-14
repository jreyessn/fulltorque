<?php

namespace App\Http\Controllers;

use App\PruebaRendidaUsuario;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('panel');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function resultadosServerside($id)
    {
        $resultado_prueba = PruebaRendidaUsuario::obtenerResultadosUsuario($id);
        $prueba = app(PruebaController::class)->getResultadoOnePrueba($id);
        $resultados_temarios = collect($resultado_prueba)->groupBy("pregunta.temario.name");

        return view('resultados', compact("prueba", "resultados_temarios"));
    }
}
