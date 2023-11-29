
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>to do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

<div class="container">
        <h1 class='text-center'>Task manegemet</h1>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Agregar tarea
            </button>
            <br>
        </div>

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    <h4>Pendiente <span class="badge bg-secondary">1</span></h4> 
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    
                    <div class="accordion" id="accordiontask">
                @forelse ($tasks as $task)
                <div class="accordion-item" id="showtask{{$task->id}}">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$task->id}}" aria-expanded="false" aria-controls="collapse{{$task->id}}">
                              TAREA#{{$task->id}}: {{ $task->title}}</button>
                    </h2>
                    <div id="collapse{{$task->id}}" class="accordion-collapse collapse " data-bs-parent="#accordiontask">
                    <div class="accordion-body">
                        <strong> {{ $task->description}}</strong>
                        <br>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-danger" onclick="eliminarTarea('{{$task->id}}')">Eliminar</button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editartask" onclick="prepararEdicion('{{ $task->id }}')">Editar</button>
                            <button type="button" class="btn btn-success">completar</button>
                        </div>
                     </div>
                    </div>
                 </div>
                @empty
                    <p>No users</p>
                @endforelse
                    
                    
                 
                </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    <h4>Completadas <span class="badge bg-secondary">1</span></h4> 
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva tarea </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form id="taskForm">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp">
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
                <button type="button" class="btn btn-primary" onclick="agregarTarea()">Agregar Tarea</button>
            </div>
            </div>
        </div>
        </div>

        <!-- Modal editar-->
        <div class="modal fade" id="editartask" tabindex="-1" aria-labelledby="editartaskLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editartaskLabel">Editar tarea </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <form id="taskForm">
                        @csrf
                        <div class="mb-3">
                            <label for="titleedit" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titleedit" aria-describedby="titleHelp">
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
                <button type="button" class="btn btn-primary" onclick="actualizarTarea()">Agregar Tarea</button>
            </div>
            </div>
        </div>
        </div>
  </div>        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    let taskIdGlobal = "";
    function agregarTarea() {
        // Obtén los valores de los campos de entrada
        var title = $('#title').val();
        var description = $('#description').val();

        // Realiza una solicitud AJAX para enviar los datos al controlador de Laravel
        $.ajax({
            url: '{{ route("task.store") }}', // Reemplaza 'task.store' con la ruta correcta de tu controlador
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                title: title,
                description: description
            },
            success: function(response) {
                // Maneja la respuesta del servidor, si es necesario
                console.log('Tarea agregada con éxito:', response);

                // Cierra el modal después de agregar la tarea
                $('#exampleModal').modal('hide');
                window.location.reload();

            },
            error: function(error) {
                // Maneja cualquier error que ocurra durante la solicitud
                console.error('Error al agregar la tarea:', error);
            }
        });
    }
    
    function eliminarTarea(taskid) {
        // Realiza una solicitud AJAX para eliminar la tarea
        $.ajax({
            url: '{{ url("task") }}/'+taskid, 
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Maneja la respuesta del servidor, si es necesario
                console.log('Tarea eliminada con éxito:', response);

                // Puedes redirigir o actualizar la página después de la eliminación
                window.location.reload();
            },
            error: function(error) {
                // Maneja cualquier error que ocurra durante la solicitud
                console.error('Error al eliminar la tarea:', error);
            }
        });
    }

    function prepararEdicion(taskId) {
        // Realiza una solicitud AJAX para obtener los detalles de la tarea
        $.ajax({
            url: '{{ route("task.edit", ":id") }}'.replace(':id', taskId),
            type: 'GET',
            success: function(response) {
                // Llena el formulario con los detalles de la tarea
                $('#titleedit').val(response.title);
                $('#descriptionedit').val(response.description);
                taskIdGlobal=response.id;
                // Abre el modal de edición
                $('#editartask').modal('show');
            },
            error: function(error) {
                console.error('Error al obtener detalles de la tarea:', error);
            }
        });
    }

    function actualizarTarea() {
        var title = $('#titleedit').val();
        var description = $('#descriptionedit').val();

        // Realiza una solicitud AJAX para actualizar la tarea
        $.ajax({
            url: '{{ route("task.update", ":id") }}'.replace(':id', taskIdGlobal),
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                title: title,
                description: description
            },
            success: function(response) {
                // Maneja la respuesta del servidor, si es necesario
                console.log('Tarea actualizada con éxito:', response);

                // Cierra el modal después de actualizar la tarea
                $('#editartask').modal('hide');

                // Puedes redirigir o actualizar la página después de la actualización
                window.location.reload();
            },
            error: function(error) {
                // Maneja cualquier error que ocurra durante la solicitud
                console.error('Error al actualizar la tarea:', error);
            }
        });
    }
</script>
</body>

</html>
