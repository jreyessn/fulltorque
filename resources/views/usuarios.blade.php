<div class="page-title-box mx-4">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Listado de Usuarios</h4>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <ol class="breadcrumb float-right">
                
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
            <div class="ml-3">
                <a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target="#addUserModal" data-title-modal="Nuevo Usuario">Nuevo</a>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="float-right">
       
    </div>
</div>
<div class="">
    <table id="users-table" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Correo electrónico</th>
                <th>Presentó</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    @csrf

                    {{-- Se ocultan para evitar el autocomplete de chrome --}}
                    <div class="form-group" style="display:none">
                        <label for="email">Correo electrónico Hidden</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group" style="display:none">
                        <label for="password">Contraseña Hidden</label>
                        <input type="password" class="form-control">
                    </div>

                    {{-- Aqui está el verdadero form --}}
                    <div class="form-group">
                        <label for="name">Nombres </label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="addUserBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>
    
<script>
    var datos = {
        id_usuario: null
    }

    function listeners(){
        $("#addUserModal").on('show.bs.modal', function(event){
            datos.id_usuario = $(event.relatedTarget).data("id_usuario") || null

            if(datos.id_usuario){
                $.ajax({
                    url:  "/users/" + datos.id_usuario,
                    method: "GET",
                    success: function(data) {
                        $("#name").val(data.name);
                        $("#email").val(data.email);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

            $("#addUserModal .modal-title").text($(event.relatedTarget).data("title-modal"))
            $('#addUserForm')[0].reset();
        });

        $("#addUserBtn").on("click", function(event){
            alert("guardame")
        })
    }
    
    function deleteUser(user_id){
        alert("eliminame")
    }

    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
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
            ajax: '{{ route('usuarios.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'presento', 
                    name: 'presento',
                    render: function(data){
                        return data.presento? "Si" : "No"
                    }
                },
                {
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data) {
                        const fecha = new Date(data);
                        const dia = ('0' + fecha.getDate()).slice(-2);
                        const mes = ('0' + (fecha.getMonth() + 1)).slice(-2);
                        const anio = fecha.getFullYear();
                        const horas = ('0' + fecha.getHours()).slice(-2);
                        const minutos = ('0' + fecha.getMinutes()).slice(-2);
                        const am_pm = horas >= 12 ? 'PM' : 'AM';
                        const hora12 = horas % 12 || 12;

                        const fechaFormateada = `${dia}-${mes}-${anio} ${hora12}:${minutos} ${am_pm}`;

                        return fechaFormateada
                    },
                },
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });

        listeners()
    });



</script>