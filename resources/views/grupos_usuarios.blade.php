<style>
    .grid-check {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
</style>

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
        <h5 class="page-title text-uppercase">Usuarios</h5>
    </div><br>
    <table id="users-table" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; text-align: center;">
        <thead style="text-align:center;">
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th>Temarios</th>
                <th><button  onclick="agregar_fila()" class="btn btn-success"><i class="fas fa-plus" style="color: #fff;"></i></button></th>
            </tr>
        </thead>
        <tbody>
           
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
                <input placeholder="Contraseña" type="password" class="form-control" id="password" name="password">
                <br />
                <input placeholder="Confirmar Contraseña" type="password" class="form-control" id="password_confirmation" name="password_confirmation">    
            </td>
            <td class="grid-check"> @foreach ($temarios as $key => $temario)                       
                    <div class="custom-control custom-checkbox" style="text-align:left;">
                        <input type="checkbox" value="{{ $temario->id }}" id="temario-{{ $key }}-${rand}" name="temarios_id[]" >
                        <label for="temario-{{ $key }}-${rand}">{{ $temario->name }}</label>
                    </div>
                @endforeach
            </td>
            <td><button  type="button" class="btn btn-success addUserBtn" onclick="store(this)"><i class="fas fa-check"></i></button><button type="button" class="btn btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button></td>
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
                 $('#users-table').DataTable().ajax.reload();
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

    $(document).ready(function() {
        $('#users-table').DataTable({
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
                    data: 'id', 
                    name: 'password',
                        render: function(data, type, row, meta) {
                            return `
                                <input placeholder="Contraseña" type="password" class="form-control" id="password" name="password">
                                <br />
                                <input placeholder="Confirmar Contraseña" type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            `
                    }
                
            },
            {
                    data: 'temarios', 
                    className: 'grid-check',
                    name: 'temarios',
                        render: function(data, type, row, meta) {
                            var temarios = row.temarios
                            var users_temarios = row.users_temarios
                            var html = ""
                            $(temarios).each(function(key, value){
                            var checked = "";
                                $(users_temarios).each(function(key2, value2){
                                    if(row.users_id == value2.user_id){
                                        if(value2.temario_id == value.id){
                                            checked = "checked";
                                        }
                                    }
                                });
                            html += `
                                    <div class="custom-control custom-checkbox" style="text-align:left;">
                                        <input type="checkbox" id="check-${key}-${row.id}" value="${value.id}" name="temarios_id[]" ${checked}>
                                        <label for="check-${key}-${row.id}">${value.name}</label>
                                    </div>
                                `;
                            });

                            return html;
                    }
                
            },
            {
                    data: 'id', 
                    name: 'button',
                        render: function(data, type, row, meta) {
                            return '<button  type="button" class="btn btn-success addUserBtn" onclick="store(this)"><i class="fas fa-check"></i></button>'+
                            '<button type="button" class="btn btn-danger" onclick="removeFila(this)"><i class="fas fa-trash"></i></button>'
                    }
                
            },
            ]
        });
    });



    


</script>