<?php

namespace App\Http\Controllers;

use App\Alternativa;
use App\RespuestasUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlternativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Alternativa::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function show($id_pregunta)
    {
        $lista_alternativas_pregunta = Alternativa::where('id_pregunta', $id_pregunta)->get();  
        $alternativas_pregunta=[];
        foreach ($lista_alternativas_pregunta as $alternativa){
            $temp_alternativas_pregunta['id'] = $alternativa['id'];
            $temp_alternativas_pregunta['id_pregunta'] = $alternativa['id_pregunta'];
            $temp_alternativas_pregunta['descripcion_alternativa'] = $alternativa['descripcion_alternativa'];
            $user = auth()->user();
            
            $respuesta_usuario = RespuestasUsuario::where('id_pregunta', $id_pregunta)->where('id_usuario', $user->id)->where('id_alternativa', $alternativa['id'])->get()->first();

            if($respuesta_usuario){
                $temp_alternativas_pregunta['selected'] = 'checked';
            }else{
                $temp_alternativas_pregunta['selected'] = 'no';
            }

            $alternativas_pregunta[]=$temp_alternativas_pregunta;
        }

        return $alternativas_pregunta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternativa $alternativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternativa $alternativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternativa $alternativa)
    {
        //
    }
}
