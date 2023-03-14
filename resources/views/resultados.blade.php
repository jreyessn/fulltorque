
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="text-center">
            <h5>{{ $prueba->name }}</h5>
            <p class="text-muted">
                Ha obtenido un <b class="text-danger">{{ round($prueba->porcentaje_respuestas_correctas ?? 0, 2) }}%</b> del total.
            </p>
            <div>
                <b class="text-secondary">Total Preguntas:</b> <span>{{ $prueba->total_preguntas ?? 0 }}</span>
            </div>            
            <div>
                <b class="text-primary">Respondidas:</b> <span>{{ $prueba->total_respuestas ?? 0 }}</span>
            </div>
            <div>
                <b class="text-success">Correctas:</b> <span>{{ $prueba->respuestas_correctas ?? 0 }}</span>
            </div>
            <div>
                <b class="text-danger">Incorrectas:</b> <span>{{ $prueba->respuestas_incorrectas ?? 0 }}</span>
            </div>
            <div>
                <span class="badge {{ $prueba->estado_aprobado? 'badge-success' : 'badge-danger' }}">
                    {{ $prueba->estado_aprobado? 'Aprobado' : 'Reprobado' }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row m-t-30">
    @foreach ($resultado_prueba as $key => $item_respuesta)
        @php
           $is_correct   = ($item_respuesta["respuesta_correcta"]["id"] ?? false) == ($item_respuesta["respuesta_usuario"]["id"] ?? true);
           $temario      = $item_respuesta["pregunta"]["temario"]["name"] ?? null;
           $prev_temario = ($resultado_prueba[$key - 1] ?? null)? $resultado_prueba[$key - 1]["pregunta"]["temario"]["name"] : null;
        @endphp

        @if ($temario != $prev_temario)
            <div class="col-lg-12">
                <h5 class="header-title">{{ $temario }}</h5>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card faq-box {{ $is_correct? "border-success" : "border-danger" }} p-2 mb-1">
                <div class="card-body p-2">
                    <h5 class="mb-1">
                        <span class="{{ $is_correct? "text-success" : "text-danger" }}">
                            {{ $key + 1 }}.
                        </span>
                        <span class="font-14 mb-2 mt-2">{{ $item_respuesta["pregunta"]["enunciado_pregunta"] ?? "" }}</span> 
                    </h5>
                    <p class="text-muted mb-0">
                        <b class="text-primary">Correcta</b> {{ $item_respuesta["respuesta_correcta"]["descripcion_alternativa"] ?? "" }}
                    </p>             
                    <p class="text-muted mb-0">
                        <b class="text-secondary">Respondido</b>  {{ $item_respuesta["respuesta_usuario"]["descripcion_alternativa"] ?? "" }}  
                        @if ($is_correct)
                            <i class="fas fa-check text-success"></i> 
                        @else
                            <i class="fas fa-times text-danger"></i> 
                        @endif
                    </p>
                </div>
            </div>
        </div>    
    @endforeach

</div>