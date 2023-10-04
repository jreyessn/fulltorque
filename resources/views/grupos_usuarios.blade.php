<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="page-title-box mx-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h1 class="page-title text-uppercase">Grupo {{ $grupo[0]->nombre }}</h1>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <ol class="breadcrumb float-right">
                
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
    <div class="float-right">
       
    </div>
</div>
<div class="te">
<input type="hidden" id="grupo_id" name="grupo_id" value="{{ $grupo[0]->id }}">
 <div style="text-align: center;">
    <div class="row">   
     <div class="form-group col">
        <label for="">Curso</label>
        <div>
            {{ $grupo[0]->curso }}
        </div>
      </div>

      <div class="form-group col">
        <label for="">Cliente</label>
        <div>
            {{ $grupo[0]->cliente }}
        </div>
      </div>

      <div class="form-group col">
        <label for="">Tutor</label>
        <div>
            {{ $grupo[0]->tutor }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col">
        <label for="">Fecha</label>
        <div>
            {{ date("d/m/Y", strtotime($grupo[0]->fecha)) }}
        </div>
      </div>
      <div class="form-group col">
        <label for="">Hora</label>
        <div>
            {{ date("g:i a", strtotime($grupo[0]->hora)) }}
        </div>
      </div>
      <div class="form-group col">
        <label for=""></label>
        <div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
        <h5 class="page-title text-uppercase">Usuarios del grupo {{ $grupo[0]->nombre }}</h5>
    </div><br>
    <table id="users-table" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; text-align: center;">
        <thead style="text-align:center;">
            <tr>
                <th><i class="fas fa-info-circle lg"></i></th>
                <th >Nombre</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th>Confirmar Contraseña</th>
                <th>Temarios</th>
                <th><button  onclick="agregar_fila()" class="btn btn-success"><i class="fas fa-plus" style="color: #fff;"></i></button></th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos_usuarios as $value)
                <tr>
                    <td>
                        <input type="checkbox"><input type="hidden" id="id" name="id" value="{{$value->id_usuario}}">
                    </td>
                    <td style="width:23%">
                        <input type="text" class="form-control" id="name" name="name" value="{{$value->nombre_usuario}}">
                    </td>
                    <td>
                        <input type="email" class="form-control" id="email" name="email" value="{{$value->email}}">
                    </td>
                    <td style="width:15%">
                        <input type="password" class="form-control" id="password" name="password">
                    </td>
                    <td style="width:15%">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </td>
                    <td>
                        @foreach ($temarios as $key => $temario)
                        <?php $checked = "";?>
                        @foreach ($users_temarios as $key => $temario2) 
                        <?php if($value->users_id == $temario2->user_id && $temario2->temario_id == $temario->id){
                            $checked = "checked";
                        }?>
                        @endforeach
                        <div class="custom-control custom-checkbox" style="text-align:left;">
                            <input type="checkbox" value="{{ $temario->id }}" name="temarios_id[]" {{$checked}}>
                        <label  for="temario-{{ $key }}">{{ $temario->name }}</label>
                        </div>
                        @endforeach
                    </td>
                    <td>
                        <button  type="button" class="btn btn-success addUserBtn" onclick="store(this)"><i class="fas fa-check"></i></button>
                        <button type="button" class="btn btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="" style="display: flex; justify-content: center">
        <a href="{{url('/grupos_usuarios')}}" type="button" class="btn btn-secondary">Regresar</a>
        <!--<button type="button" class="btn btn-primary" onclick="guardar_grupos_usuarios()">Guardar</button>-->
    </div><br>
    <div style="padding: 20px 30px 20px; width: 100%"></div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
<script>
    var datos = {
        id_usuario: null
    }

    function agregar_fila(){

        $('#users-table').DataTable().destroy();
        $("#users-table > tbody").append(`
            <tr style="text-align:center">
            <td><input type="checkbox"><input type="hidden" id="id" name="id">
            </td>
            <td style="width:23%">
            <input type="text" class="form-control" id="name" name="name"></td>
            <td><input type="email" class="form-control" id="email" name="email"></td>
            <td style="width:15%"><input type="password" class="form-control" id="password" name="password"></td>
            <td style="width:15%"><input type="password" class="form-control" id="password_confirmation" name="password_confirmation"></td>
            <td> @foreach ($temarios as $key => $temario)                       
                    <div class="custom-control custom-checkbox" style="text-align:left;">
                        <input type="checkbox" value="{{ $temario->id }}" name="temarios_id[]" >
                        <label for="temario-{{ $key }}">{{ $temario->name }}</label>
                    </div>
                @endforeach
            </td>
            <td><button  type="button" class="btn btn-success addUserBtn" onclick="store(this)"><i class="fas fa-check"></i></button><button type="button" class="btn btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button></td>
            </tr>`);

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
                    location.reload()                

                    //$('#users-table').DataTable().draw();
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

    $(document).ready(function() {
        var usuarios = [];
        $('#users-table tr .id_usuario').each(function() {
           var id_usuario = $(this).val();  
            usuarios.push(id_usuario);
        });
        $('#id_usuario option').each(function() {
            var id_usuario = $(this).val();  
             if(usuarios.includes(id_usuario) == true){
                $(this).css("display","none");
             }
        });
        $('#users-table').DataTable({
            
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
    });

    function store(button){
    let tr = button.closest('tr');
    var name = $(tr).find('[name="name"]').val(); 
    var email = $(tr).find('[name="email"]').val();
    var password = $(tr).find('[name="password"]').val(); 
    var password_confirmation = $(tr).find('[name="password_confirmation"]').val();
    var temarios_id = [];    
        $(tr).find('[name="temarios_id[]"]').each(function(){
            if (this.checked) {
            temarios_id.push($(this).val());
            }
        });  
    var id = $(tr).find('[name="id"]').val();
    var grupo_id = $("#grupo_id").val();
    $.ajax({
        method: "POST",
        url: "{{ route('grupo_usuario.store') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'id':id,
            'grupo_id': grupo_id,
            'name':name,
            'email':email,
            'password':password,
            'password_confirmation':password_confirmation,
            'temarios_id':temarios_id
        },
        success: function(response){
            if(response.success){
                swal({
                title: 'Confirmación',
                text: 'Guardado con Exito',
                type: 'success',
                })
                //$(tr).find('input').prop("disabled", true);
                $(tr).find('[name="id"]').val(response.id_usuario);
                location.reload()                
                //$('#usersTable').DataTable().draw();
            }else{
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
    }

    


</script>