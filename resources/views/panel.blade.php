
    <div class="page-title-box mx-4">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Panel de Resultados</h4>
            </div>
            <div class="col-sm-6">
                {{-- <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item active">Panel</li>
                </ol> --}}
            </div>
        </div>
    </div>

    <div class="">
        <table id="datatable" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Preguntas</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
        </table>
        <div style="padding: 20px 30px 20px; width: 100%"></div>
    </div>


    <div class="modal fade" id="modalEncuesta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Resultados</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Cargando contenido...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>      

    <script>

        function listeners(){
            $("#datatable").on("click", "#mostrarResultados", function(event){
                asyncModalResultados(event.target.getAttribute("data-id"))
            })
        }

        function asyncModalResultados(id_encuesta){
            var modal = $('#modalEncuesta');
            var htmlApi = '/panel/resultados/' + id_encuesta;

            modal.find('.modal-body').load(htmlApi);
            modal.modal('show');
        }

        $(document).ready(function() {
            $('#datatable').DataTable({
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
                ajax: "{{ route('prueba.resultados') }}",
                columns: [
                    {
                        data: 'name', 
                        name: 'name',
                        render: function(data, type, row, meta) {
                            return `
                                <div style="d-flex">
                                    <button id="mostrarResultados" data-id="${row.id}" class="btn btn-sm btn-link waves-effect">
                                        <i data-id="${row.id}" class="font-14 fas fa-eye"></i>   
                                    </button> 
                                    <b>${data}</b>
                                </div>
                                <p class="text-muted">Ha obtenido un 
                                    <b class="${row.estado_aprobado? 'text-success' : 'text-danger'}">${parseFloat(row.porcentaje_respuestas_correctas || 0).toFixed(2)}%</b> del total
                                </p>
                            `
                        }
                    },
                    {
                        data: 'total_preguntas',
                        name: 'total_preguntas',
                        render: function(data, type, row, meta) {
                            return `
                                <div>
                                    <b class="text-secondary">Total Preguntas:</b> <span>${row.total_preguntas}</span>
                                </div>                               
                                <div>
                                    <b class="text-primary">Respondidas:</b> <span>${row.total_respuestas}</span>
                                </div>
                                <div>
                                    <b class="text-success">Correctas:</b> <span>${row.respuestas_correctas || 0}</span>
                                </div>
                                <div>
                                    <b class="text-danger">Incorrectas:</b> <span>${row.respuestas_incorrectas || 0}</span>
                                </div>
                            `
                         },
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
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
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            const classBadge = row.estado_aprobado? "badge-success" : "badge-danger"
                            const text       = row.estado_aprobado? "Aprobado" : "Reprobado"

                            return `
                                <span class="badge ${classBadge}">${text}</span>
                            `
                        },
                    },
                    
                ]
            });

            listeners()
        });


    </script>
