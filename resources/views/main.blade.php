<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>to do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Task manegemet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
    </nav>

    <div class="container text-center">
        <h1 class='text-center'>Task manegemet</h1>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar tarea
            </button>
            <br>
        </div>
    <div class="row">
        <div class="accordion col-6" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <h4>Pendiente <span class="badge bg-secondary">{{ $tasksTodo }}</span></h4>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">

                        <div class="accordion" id="accordiontask">
                            @forelse ($tasks as $task)
                                @if ($task->status === 'pendiente')
                                    <div class="accordion-item" id="showtask{{ $task->id }}">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $task->id }}"
                                                aria-expanded="false" aria-controls="collapse{{ $task->id }}">
                                                TAREA#{{ $task->id }}: {{ $task->title }}</button>
                                        </h2>
                                        <div id="collapse{{ $task->id }}" class="accordion-collapse collapse "
                                            data-bs-parent="#accordiontask">
                                            <div class="accordion-body">
                                                <br>
                                                <strong> {{ $task->description }}</strong>
                                                <br>
                                                <br>
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="eliminarTarea('{{ $task->id }}')">Eliminar</button>
                                                    <button type="button" class="btn btn-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editartask"
                                                        onclick="prepararEdicion('{{ $task->id }}')">Editar</button>
                                                    <button type="button" class="btn btn-success"
                                                        onclick="finalizar('{{ $task->id }}')">completar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @empty
                                <p>Sin tareas pendientes</p>
                            @endforelse



                        </div>
                    </div>
                </div>

                
            </div>    
        </div>
  
     
        <div class="accordion col-6" id="accordionPanelsStayOpenExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseThree">
                            <h4>Completadas <span class="badge bg-secondary">{{ $tasksDone }}</span></h4>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="accordion" id="accordiontaskdone">
                                @forelse ($tasks as $task)
                                    @if ($task->status === 'completada')
                                        <div class="accordion-item" id="showtask{{ $task->id }}">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $task->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse{{ $task->id }}">
                                                    TAREA#{{ $task->id }}: {{ $task->title }}</button>
                                            </h2>
                                            <div id="collapse{{ $task->id }}"
                                                class="accordion-collapse collapse "
                                                data-bs-parent="#accordiontaskdone">
                                                <div class="accordion-body">
                                                    <strong> {{ $task->description }}</strong>
                                                    <br>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="eliminarTarea('{{ $task->id }}')">Eliminar</button>
                                                        <button type="button" class="btn btn-warning"
                                                            data-bs-toggle="modal" data-bs-target="#editartask"
                                                            onclick="prepararEdicion('{{ $task->id }}')">Editar</button>
                                                        <button type="button" class="btn btn-success"
                                                            onclick="finalizar('{{ $task->id }}')">Marcar como
                                                            pendiente</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @empty
                                    <p>Sin tareas pendientes</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
      
    </div>   
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva tarea </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title"
                            aria-describedby="titleHelp">
                        <div id="titleHelp" class="form-text">Titulo de tu tarea</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="agregarTarea()">Agregar
                    Tarea</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar-->
<div class="modal fade" id="editartask" tabindex="-1" aria-labelledby="editartaskLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editartaskLabel">Editar tarea </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    @csrf
                    <div class="mb-3">
                        <label for="titleedit" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titleedit"
                            aria-describedby="titleHelp">
                        <div id="titleHelp" class="form-text">Titulo de tu tarea</div>
                    </div>
                    <div class="mb-3">
                        <label for="descriptionedit" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descriptionedit" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="actualizarTarea()">Actualizar
                    Tarea</button>
            </div>
        </div>
    </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            let taskIdGlobal = "";

            function agregarTarea() {
                var title = $('#title').val();
                var description = $('#description').val();
                $.ajax({
                    url: '{{ route('task.store') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: title,
                        description: description
                    },
                    success: function(response) {
                        console.log('Tarea agregada con éxito:', response);

                        $('#exampleModal').modal('hide');
                        alert("Tarea agregada con éxito:");
                        window.location.reload();

                    },
                    error: function(error) {
                        console.error('Error al agregar la tarea:', error);
                        alert("Error al agregar la tarea:");
                    }
                });
            }

            function eliminarTarea(taskid) {
                $.ajax({
                    url: '{{ url('task') }}/' + taskid,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log('Tarea eliminada con éxito:', response);
                        alert("Tarea eliminada con éxito:");

                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('Error al eliminar la tarea:', error);
                        alert("Error al eliminar la tarea:");
                    }
                });
            }

            function prepararEdicion(taskId) {
                $.ajax({
                    url: '{{ route('task.edit', ':id') }}'.replace(':id', taskId),
                    type: 'GET',
                    success: function(response) {
                        $('#titleedit').val(response.title);
                        $('#descriptionedit').val(response.description);
                        taskIdGlobal = response.id;
                        $('#editartask').modal('show');
                    },
                    error: function(error) {
                        console.error('Error al obtener detalles de la tarea:', error);
                        alert("Error al obtener detalles de la tarea:");
                    }
                });
            }

            function actualizarTarea() {
                var title = $('#titleedit').val();
                var description = $('#descriptionedit').val();
                $.ajax({
                    url: '{{ route('task.update', ':id') }}'.replace(':id', taskIdGlobal),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: title,
                        description: description
                    },
                    success: function(response) {
                        console.log('Tarea actualizada con éxito:', response);

                        $('#editartask').modal('hide');
                        alert("Tarea actualizada con éxito:");
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('Error al actualizar la tarea:', error);
                        alert("Error al actualizar la tarea:");
                    }
                });
            }

            function finalizar(taskId) {
                $.ajax({
                    url: '{{ route('task.updateStatusTask', ':id') }}'.replace(':id', taskId),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Tarea finalizada:', response);
                        alert("Tarea finalizada");
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error('Error al finalizar tarea:', error);
                        alert("Error al finalizar tarea:");
                    }
                });
            }
        </script>
</body>

</html>
