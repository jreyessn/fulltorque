<div class="page-title-box mx-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Listado de Grupos</h4>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <ol class="breadcrumb float-right">
                
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
            <div class="ml-3">
                <a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target="#addGruposModal" data-title-modal="Nuevo Grupo">Nuevo</a>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="float-right">
       
    </div>
</div>
<?php $total = count($grupos);
$total = $total - 1; 
?>
<div class="">
    <table id="grupos-table" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th></th>             
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $key => $grupo)
            @if($key == $total && $key%2==0) 
            <tr>
                <td rowspan="2" style="width:50%">
                    <div class="col-sm-12 grupos_card">
                        <input type="hidden" name="id_card" class="id_card" value="{{$grupo->id}}">
                    <div class="card"> 
                    <div class="card-header" style="background-color:#30419b; height:30px;">
                    <div class="dropdown" style="margin-left:95%; margin-top: -2%;">
                        <a class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
                            <i class="fas fa-ellipsis-h lg" style="color:white;"></i>
                        </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" data-toggle="modal" data-target="#addGruposModal" data-title-modal="Editar Grupo" data-id_grupo="{{$grupo->id}}" href="#"><i class="fas fa-edit"></i> Editar</a>
                        <a class="dropdown-item" href="{{ url('/gestion_usuarios/'.$grupo->id)}}"><i class="fas fa-tasks"></i> Gesti&oacute;n</a>
                        <a class="dropdown-item" href="{{ url('/excel/'.$grupo->id) }}"><i class="fas fa-regular fa-file-excel"></i> Reporte</a>
                        <a class="dropdown-item" href="#" onclick="deleteGrupo('/grupos/{{$grupo->id}}')"><i class="fas fa-trash-alt"></i> Eliminar</a>
                      </div>
                    </div>
                </div>        
                <div class="card-body" style="font-size: 14px;">
                      <h5 class="card-title text-uppercase">{{ $grupo->nombre }}</h5>
                      <p class="text-capitalize">
                      <strong><i class="fas fa-chalkboard-teacher"></i> Tutor:</strong> {{ $grupo->tutor }}<br>
                      <strong><i class="fas fa-book"></i> Curso:</strong> {{ $grupo->curso }}<br>
                      <strong><i class="fas fa-user"></i> Usuarios: </strong><span class="cantidad_usuarios"></span></p>
                </div>
                </div>
                </div>
              </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            @else
            <tr>
                <td rowspan="2" style="width:50%">
                    <div class="col-sm-12 grupos_card">
                        <input type="hidden" name="id_card" class="id_card" value="{{$grupo->id}}">
                    <div class="card"> 
                    <div class="card-header" style="background-color:#30419b; height:30px;">
                    <div class="dropdown" style="margin-left:95%; margin-top: -2%;">
                        <a class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
                            <i class="fas fa-ellipsis-h lg" style="color:white;"></i>
                        </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" data-toggle="modal" data-target="#addGruposModal" data-title-modal="Editar Grupo" data-id_grupo="{{$grupo->id}}" href="#"><i class="fas fa-edit"></i> Editar</a>
                        <a class="dropdown-item" href="{{ url('/gestion_usuarios/'.$grupo->id)}}"><i class="fas fa-tasks"></i> Gesti&oacute;n</a>
                        <a class="dropdown-item" href="{{ url('/excel/'.$grupo->id) }}"><i class="fas fa-regular fa-file-excel"></i> Reporte</a>
                        <a class="dropdown-item" href="#" onclick="deleteGrupo('/grupos/{{$grupo->id}}')"><i class="fas fa-trash-alt"></i> Eliminar</a>
                      </div>
                    </div>
                </div>        
                <div class="card-body" style="font-size: 14px;">
                      <h5 class="card-title text-uppercase">{{ $grupo->nombre }}</h5>
                      <p class="text-capitalize">
                      <strong><i class="fas fa-chalkboard-teacher"></i> Tutor:</strong> {{ $grupo->tutor }}<br>
                      <strong><i class="fas fa-book"></i> Curso:</strong> {{ $grupo->curso }}<br>
                      <strong><i class="fas fa-user"></i> Usuarios: </strong><span class="cantidad_usuarios"></span></p>
                </div>
                </div>
                </div>
              </td>
            </tr>
            
            @endif
            @endforeach           
        </tbody>
    </table>
   
    <div style="padding: 20px 30px 20px; width: 100%"></div>
</div>

<div class="modal fade" id="addGruposModal" tabindex="-1" aria-labelledby="addGruposModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGruposModalLabel">Nuevo Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addGruposForm" action="{{ route('grupos.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="id_grupo">
                    <div>
                        <div class="mt-2">
                            <div class="form-group">
                                <label for="nombre">Nombre </label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="curso">Curso</label>
                                <input type="text" class="form-control" id="curso" name="curso">
                            </div>
                            <div class="form-group">
                                <label for="cliente">Cliente</label>
                                <input type="text" class="form-control" id="cliente" name="cliente">
                            </div>
                            <div class="form-group">
                                <label for="tutor">Tutor</label>
                                <input type="text" class="form-control" id="tutor" name="tutor">
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora">
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="addGruposBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>
    
<script>
    var datos = {
        id_grupo: null
    }

    function listeners(){
        $("#addGruposModal").on('show.bs.modal', function(event){
            datos.id_grupo = $(event.relatedTarget).data("id_grupo") || null

            if(datos.id_grupo){
                $.ajax({
                    url:  "/grupos/" + datos.id_grupo,
                    method: "GET",
                    success: function(data) {
                        $("#nombre").val(data.nombre);
                        $("#curso").val(data.curso);
                        $("#cliente").val(data.cliente)
                        $("#tutor").val(data.tutor)
                        $("#fecha").val(formatDate(data.fecha))
                        $("#hora").val(data.hora)
                        $("#id_grupo").val(datos.id_grupo)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            $("#addGruposModal .modal-title").text($(event.relatedTarget).data("title-modal"))
            $('#addGruposForm')[0].reset();
        });

        $("#addGruposBtn").on("click", function(event){
            event.preventDefault(); // Evitar que se envíe el formulario por defecto

            var form = $("#addGruposForm");
            var url = form.attr('action');
            var data = form.serialize();
            $.ajax({
                method: "POST",
                url: url,
                data: data,
                success: function(response){
                    if(response.success){
                        swal({
                            title: 'Confirmación',
                            text: 'Guardado con Exito',
                            type: 'success',
                            confirmButtonText: "Aceptar"
                        })
                        // Cerrar la modal
                        $('#addGruposModal').modal('hide');
                        location.reload()

                        // Actualizar la tabla de datos
                       // $('#usersTable').DataTable().draw();
                    } else {
                        var errors = "";
                        $.each(response.errors, function(key, value){
                            errors += value[0] + "\n";
                        });
                        swal({
                            title: 'Error',
                            text: errors,
                            type: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(response){
                    swal({
                        title: 'Error',
                        text: 'revise los mensajes de error e intente nuevamente',
                        type: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        })

    }

   function deleteGrupo(grupo_id){
        grupo_id = grupo_id.replace(/.*\//, '');
        swal({
            title: "Eliminar Grupo",
            text: "¿Realmente deseas eliminar este grupo?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonText: "Si",
            closeOnConfirm: false
        }).then(function (value) {
            if (value.value == true) {
            $.ajax({
                method: "DELETE",
                url: '/grupos/' + grupo_id,
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF generado por Laravel
                    id: grupo_id 
                },
                success: function(response){
                    swal(
                        'Eliminado!',
                        'El Grupo ha sido eliminado.',
                        'success'
                    );
                    location.reload()
                },
                error: function(response){
                    swal(
                        'Error',
                        'Ha ocurrido un error al intentar eliminar el grupo.',
                        'error'
                    );
                }
            });
            }else{
            swal(
                    'Cancelado',
                    'El grupo no ha sido eliminado.',
                    'error'
                )
            }
        });
    }
    

    function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
    }
 
    

   $(document).ready(function() {
        listeners()
        $('#grupos-table').DataTable({
            ordering: false,

            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
    });
        var cantidad_usuarios = [];
        $(".grupos_card").each(function(key, value){
            var id_card = $(this).find('input[name="id_card"]').val();
            $.ajax({
                method: "POST",
                url: "{{ route('grupos.total_usuarios') }}",
                data : {
                    _token: '{{ csrf_token() }}', 
                    id: id_card
                },
                success: function(response){
                $(value).find('.cantidad_usuarios').text(response);
                },
            });
        });


    });



</script>