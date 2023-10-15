<style type="text/css">
   
</style>
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
<div class="table-responsive">
    <table id="grupos-table" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th style="width:50%;"></th> 
                <th></th> 
            </tr>
        </thead>
        <tbody>
                
        </tbody>
    </table>
   
    <div style="padding: 20px 30px 20px; width: 100%"></div>
</div>

<div class="modal fade" id="addGruposModal" tabindex="-1" aria-labelledby="addGruposModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <div class="row mt-2">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre </label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="curso">Curso</label>
                                    <input type="text" class="form-control" id="curso" name="curso">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tutor">Tutor</label>
                                    <input type="text" class="form-control" id="tutor" name="tutor">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <h4 class="mt-0 header-title">Temarios</h4>
                                <div class="dropdown-divider"></div>
    
                                <div class="mt-2">
                                    <div class="form-group">
                                        <label>Temarios Disponibles</label>
                                        <div>
                                            @foreach ($temarios as $key => $temario)                       
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" value="{{ $temario->id }}" name="temarios_id[]" class="custom-control-input" id="temario-{{ $key }}">
                                                    <label class="custom-control-label" for="temario-{{ $key }}">{{ $temario->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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
                        const temariosIds = data.temarios.map(temario => temario.temario_id)
                        $('input[name="temarios_id[]"]').each(function() {
                            const checkboxValue = $(this).val();
                            if (temariosIds.includes(parseInt(checkboxValue))) {
                                $(this).prop('checked', true);
                            }
                        });
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
                        if($("#id_grupo").val() == ''){
                            $(location).attr('href','gestion_usuarios/'+response.ultimo_id);
                        }else{
                            // Actualizar la tabla de datos
                            $('#grupos-table').DataTable().draw();    
                        }
                        $("#id_grupo").val('')
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
                    $('#grupos-table').DataTable().draw();
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
        $('#grupos-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            pageLength:2,
            dom:'rtip',
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
            },
            ajax: "{{ route('grupos.index') }}",
            columns: [
               
                {
                    data: 'id', 
                    name: 'id',
                        render: function(data, type, row, meta) {
                        var fecha = ""
                        let date = new Date(row.fecha)
                        let day = date.getDate()
                        let month = date.getMonth() + 1
                        let year = date.getFullYear()
                        if(month < 10){
                           fecha = `${day}/0${month}/${year}`
                        }else{
                           fecha =`${day}/${month}/${year}`
                        }
                        return `
                            <div class="col-sm-12 grupos_card">
                                <input type="hidden" name="id_card" class="id_card" value=${row.id}>
                                <div class="card">
                           
                                    <div class="card-body">
                                        <div class="d-flex  flex-column flex-sm-row" style="justify-content: space-between; align-items: center;">
                                            <h5 class="card-title text-uppercase"> ${row.nombre}</h5>
                                            
                                            <div class="d-flex" style="gap: 0.5rem">
                                                <a data-toggle="modal" data-target="#addGruposModal" data-title-modal="Editar Grupo" data-id_grupo=${row.id} href="#"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="/gestion_usuarios/${row.id}"><i class="fas fa-tasks"></i> Gestionar Usuarios</a>
                                                <a hidden class="text-danger" href="/pdf/${row.id}"><i class="fas fa-regular fa-file-pdf"></i> PDF</a>
                                                <a class="text-success" href="/excel/${row.id}"><i class="fas fa-regular fa-file-excel"></i> Excel</a>
                                                <a class="text-danger" href="#" onclick="deleteGrupo('/grupos/${row.id}')"><i class="fas fa-trash-alt"></i> Eliminar</a>    
                                            </div>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-capitalize">
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-chalkboard-teacher"></i> Tutor:</strong> ${row.tutor}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-user"></i> Cliente:</strong> ${row.cliente}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-book"></i> Curso:</strong> ${row.curso}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-calendar"></i> Fecha:</strong> ${fecha}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-clock"></i> Hora:</strong> ${row.hora}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-user-friends"></i> Usuarios:</strong>  <span class="cantidad_usuarios">${row.total_usuarios}</span>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;

                    }
                
                },

                {
                    data: 'siguiente', 
                    name: 'siguiente',
                        render: function(data, type, row, meta) {
                        if(data){
                        var fecha = ""
                        let date = new Date(data.fecha)
                        let day = date.getDate()
                        let month = date.getMonth() + 1
                        let year = date.getFullYear()
                        if(month < 10){
                           fecha = `${day}/0${month}/${year}`
                        }else{
                           fecha =`${day}/${month}/${year}`
                        }
                        return `
                            <div class="col-sm-12 grupos_card">
                                <input type="hidden" name="id_card" class="id_card" value=${data.id}>
                                <div class="card">
                           
                                    <div class="card-body">
                                        <div class="d-flex" style="justify-content: space-between; align-items: center;">
                                            <h5 class="card-title text-uppercase"> ${data.nombre}</h5>
                                            
                                            <div class="d-flex" style="gap: 0.5rem">
                                                <a data-toggle="modal" data-target="#addGruposModal" data-title-modal="Editar Grupo" data-id_grupo=${data.id} href="#"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="/gestion_usuarios/${data.id}"><i class="fas fa-tasks"></i> Gestionar Usuarios</a>
                                                <a hidden class="text-danger" href="/pdf/${row.id}"><i class="fas fa-regular fa-file-pdf"></i> PDF</a>
                                                <a class="text-success" href="/excel/${data.id}"><i class="fas fa-regular fa-file-excel"></i> Excel</a>
                                                <a class="text-danger" href="#" onclick="deleteGrupo('/grupos/${data.id}')"><i class="fas fa-trash-alt"></i> Eliminar</a>    
                                            </div>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <p class="text-capitalize">
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-chalkboard-teacher"></i> Tutor:</strong> ${data.tutor}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-user"></i> Cliente:</strong> ${data.cliente}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-book"></i> Curso:</strong> ${data.curso}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-calendar"></i> Fecha:</strong> ${fecha}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-clock"></i> Hora:</strong> ${data.hora}
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <strong><i class="text-primary fas fa-user-friends"></i> Usuarios:</strong>  <span class="cantidad_usuarios">${data.total_usuarios}</span>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;
                    }else{
                        return '';
                    }
                }
                
                },
               

            ]
        });
        listeners()

    });



</script>