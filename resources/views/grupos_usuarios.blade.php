<style>
    .grid-check {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .table > tbody > tr > td, .table > tfoot > tr > td, .table > thead > tr > td {
        padding: 6px 5px;
    }
</style>

<div class="page-title-box mx-4">
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center" style="gap: 0.5rem">
            <h1 class="page-title text-uppercase" id="page-title"></h1>
            <a href="#" data-toggle="modal" data-target="#editGrupoModal" data-title-modal="Editar Grupo">
                <i class="fa fa-edit"></i>
            </a>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <ol class="breadcrumb float-right">
                
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </div>
    </div>
    <div class="dropdown-divider"></div>
</div>

<div class="te container-fluid">
    <input type="hidden" id="grupo_id" name="grupo_id" value="{{ $grupo[0]->id }}">

    <div class="row">   
        <div class="col-sm-12 col-lg-4">
        <div>
            <p class="font-14 text-left my-1"> <b>Curso:</b> <span id="div_curso"></span> </p>
            <p class="font-14 text-left my-1"> <b>Fecha y Hora:</b> <span id="div_fecha"></span> <span id="div_hora"></span></p>
            <p class="font-14 text-left my-1"> <b>Cliente:</b> <span id="div_cliente"></span></p>
            <p class="font-14 text-left my-1"> <b>Tutor:</b> <span id="div_tutor"></span></p>
        </div>
        </div>
        <div class="col-sm-12 col-lg-4">
        <div>
            {{-- <p class="font-14 text-left my-1"> 
                <b>Contraseña:</b> <span id="div_curso">********</span> 
                <a href="javascript:void"><i class="fa fa-eye"></i></a> 
            </p> --}}
        </div>
        </div>
        <div class="col-sm-12 col-lg-4">
        <div>
            <p class="font-14 text-left my-1"> <b>Temarios</b> </p>
            <p class="font-14 text-left my-1"> 
                <ul id="lista-temarios"></ul>
            </p>
        </div>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="row">
        <div class="col-sm-12">
            
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-uppercase">Gestión de Usuarios</h5>

                <div>
                    <button  onclick="agregar_fila()" class="btn btn-sm btn-success">
                        <i class="fas fa-plus" style="color: #fff;"></i> Agregar linea
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table id="users-table" class="table table-sm table-bordered w-full table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th style="width: 25%" class="text-center">Nombre</th>
                            <th style="width: 25%" class="text-center">Correo electrónico</th>
                            <th style="width: 20%" class="text-center">Tel&eacute;fono</th>
                            <th style="width: 20%" class="text-center">Rut</th>
                            <th style="width: 10%" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="" style="display: flex; justify-content: center">
                <a href="{{url('/grupos_usuarios')}}" type="button" class="btn btn-secondary">Regresar</a>&nbsp;
                <button type="button" class="btn btn-primary" onclick="validacion()">Guardar</button>
            </div>
        </div>
    </div>
    
    <div style="padding: 50px 30px 20px; width: 100%"></div>

</div>

<div class="modal fade" id="editGrupoModal" tabindex="-1" aria-labelledby="addGruposModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGruposModalLabel">Editar Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editGruposForm" action="{{ route('grupos.store') }}">
                    @csrf
                    <input type="hidden" name="id" id="id_grupo" value="{{ $grupo[0]->id }}">
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
                                    <input type="hidden" name="password_grupo" id="password_grupo" value="{{ $grupo[0]->password }}">
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
                <button type="button" class="btn btn-primary" id="editGruposBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>
    
<script>
    var datos = {
        id_usuario: null
    }

    function listener(){
        $.ajax({
            method: "POST",
            url: '/grupo_usuario/getGrupo',
            data: {
                _token: '{{ csrf_token() }}', // Token CSRF generado por Laravel
                id: $("#id_grupo").val() 
            },
            success: function(response){
                $("#lista-temarios").empty()

                $("#page-title").text('Grupo '+response.nombre)
                $("#div_curso").text(response.curso)
                $("#div_cliente").text(response.cliente)
                $("#div_tutor").text(response.tutor)
                $("#div_fecha").text(formatDate2(response.fecha))
                $("#div_hora").text(response.hora)
                $("#id_grupo").val(response.id)
                $("#nombre").val(response.nombre)
                $("#curso").val(response.curso)
                $("#cliente").val(response.cliente)
                $("#tutor").val(response.tutor)
                $("#fecha").val(formatDate(response.fecha))
                $("#hora").val(response.hora)
                const temariosIds = response.temarios.map(temario => {

                    $("#lista-temarios").append(`<li>${temario?.temario?.name}</li>`)
                    
                    return temario.temario_id
                })
                
                $('input[name="temarios_id[]"]').each(function() {

                    const checkboxValue = $(this).val();

                    if (temariosIds.includes(parseInt(checkboxValue))) {
                        $(this).prop('checked', true);
                    }

                });
            },
        });  
    }

    function agregar_fila(){
        if ($("#id").length == 0) {
           $('#users-table > tbody').empty() 
        }
        const rand = parseInt(Math.random() * 100)
        $("#users-table > tbody").prepend(`
            <tr style="text-align:center">
            <td style="width:23%">
            <input type="hidden" id="id" name="id">
            <input type="text" class="form-control" id="name" name="name"></td>
            <td><input type="email" class="form-control" id="email" name="email"></td>
            <td>
                <input type="text" class="form-control" id="telefono" name="telefono">    
            </td>
            <td> 
                <input type="text" class="form-control" id="rut" name="rut">    
            </td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button></td>
            </tr>
        `);

        $('#users-table > tbody > tr').each(function(key, value) {
          $(this).attr('id', 'tr'+key);
        });
    }

     function removeFila(e) {
        let tr = e.closest('tr');
        var id = $(tr).find('[name="id"]').val(); 
        if(id != ""){ 
        delete_grupo_usuario(id)
        }else{
        $(e).closest("tr").remove(); 
        }  
    }
    
    function delete_grupo_usuario(id){
        swal({
            title: "Eliminar Usuario",
            text: "¿Realmente deseas eliminar este usuario?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonText: "Si",
            closeOnConfirm: false
        }).then(function (value) {
            if (value.value == true) {
            $.ajax({
                method: "DELETE",
                url: '/grupo_usuario/' + id,
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF generado por Laravel
                    id: id 
                },
                success: function(response){

                    swal(
                        'Eliminado!',
                        'El Usuario ha sido eliminado.',
                        'success'
                    );
                    $('#users-table').DataTable().ajax.reload();
                },
                error: function(response){
                    swal(
                        'Error',
                        'Ha ocurrido un error al intentar eliminar el usuario.',
                        'error'
                    );
                }
            });
            }else{
            swal(
                    'Cancelado',
                    'El Usuario no ha sido eliminado.',
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

    function formatDate2(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month, year].join('/');
    }

    $("#editGruposBtn").on("click", function(event){
            event.preventDefault(); // Evitar que se envíe el formulario por defecto

            var form = $("#editGruposForm");
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
                        $('#editGrupoModal').modal('hide');
                        listener()
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

    $(document).ready(function() {
        $('#users-table').DataTable({
            ordering: false,
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
            ajax :  '/grupo_usuario/datatable/'+$("#grupo_id").val(),
            columns: [
            {
                    data: 'nombre_usuario', 
                    name: 'nombre_usuario',
                        render: function(data, type, row, meta) {
                            return '<input type="hidden" id="id" name="id" value='+row.id_usuario+'>'+
                            '<input type="text" class="form-control" id="name" name="name" value='+data+'>'
                    }
                
            },
            {
                    data: 'email', 
                    name: 'email',
                        render: function(data, type, row, meta) {
                            return '<input type="email" class="form-control" id="email" name="email" value='+data+'>'
                    }
                
            },
            {
                    data: 'telefono', 
                    name: 'telefono',
                        render: function(data, type, row, meta) {
                            if(data == null){
                                data = "";
                            }
                            return '<input type="text" class="form-control" id="telefono" name="telefono" value='+data+'>'
                            
                    }
                
            },
            {
                    data: 'rut', 
                    name: 'rut',
                        render: function(data, type, row, meta) {
                            if(data == null){
                                data = "";
                            }
                            return '<input type="text" class="form-control" id="rut" name="rut" value='+data+'>'
                    }
                
            },
            {
                    data: 'id',
                    className: "text-center",
                    name: 'button',
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button>`
                    }
                
            },
            ]
        });
        
        listener()
    });

    function validacion(){
        var emails = [];

        $("#users-table #email").each(function(key, value) {
            emails.push($(this).val())
        });

        var repetidos = new Set(emails).size!==emails.length

        if(repetidos == true){
            swal(
                'Error',
                'Se ha detectado un correo repetido en el formulario',
                'error'
            );
        }else{
            store_user()
        }

    }

    function store_user(){
        var errores = [];
        var total_columnas = $("#users-table tbody tr").length;
        var users = []

        $("#users-table tbody tr").each(function(key, value){
            let tr = $(this).closest('tr');
            var name = $(tr).find('[name="name"]').val(); 
            var email = $(tr).find('[name="email"]').val();
            var telefono = $(tr).find('[name="telefono"]').val(); 
            var rut = $(tr).find('[name="rut"]').val();
            var id = $(tr).find('[name="id"]').val();
            var grupo_id = $("#grupo_id").val();
            
            const body = {
                'id':id,
                'grupo_id': grupo_id,
                'name':name,
                'email':email,
                'telefono':telefono,
                'rut':rut,
                'password':$("#password_grupo").val(),
                'password_confirmation':$("#password_grupo").val(),
            }

            users.push(body)
        }); 

        $.ajax({
            method: "POST",
            url: "{{ route('grupo_usuario.store_multiple') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'groups': users
            },
            success: function(response){

                if (response.errors) {
                    const errorsMsg = Object.values(response.errors).map(err => `- ${err[0]}`).join("<br>")

                        swal({
                            title: 'Revise sus datos nuevamente',
                            html: `Error en la fila ${response.index + 1} <br> ${errorsMsg}`,
                            type: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    return;
                }

                swal({
                    title: 'Confirmación',
                    text: 'Guardado con Exito',
                    type: 'success',
                })    

                $('#users-table').DataTable().ajax.reload();
            },
        });
    }


</script>