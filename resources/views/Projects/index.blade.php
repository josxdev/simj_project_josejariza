@extends('Layout.app_layout')

@section('content_header')
    <h1>Proyectos</h1>

    <div class="row mt-4">
        <div class="col-12 col-md-5">
            <div class="card card-primary color-palette-box">
                <div class="card-header d-flex">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-laptop"></i>
                        Listado de proyectos
                    </h3>

                    @if(session()->get('user')['is_admin'])
                        <button id="openModalProject" class="btn btn-light ml-auto">Crear nuevo</button>
                    @endif

                    <button id="openModalPDF" class="btn btn-light ml-3"><i class="fas fa-file-pdf text-danger"></i>
                    </button>

                </div>
                <div class="card-body body-projects">
                    <div id="external-events">

                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card card-navy color-palette-box">
                <div class="card-header d-flex">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-calendar"></i>
                        Calendario
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-group d-flex align-items-center">
                                <label class="mr-2 mb-0">Usuario</label>
                                <select class="form-control mr-2" name="user-selected"></select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex justify-content-end align-items-center">
                                <button id="previous-day" class="btn btn-outline-primary btn-sm mr-2"><i
                                        class="fas fa-arrow-left"></i></button>
                                <span id="current-day" class="font-weight-bold"></span>
                                <button id="next-day" class="btn btn-outline-primary btn-sm ml-2"><i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="calendar-container">
                        <table id="calendar" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="w-25">Hora</th>
                                <th>Eventos</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-project">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Añadir proyecto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-project">
                        <div class="form-group">
                            <label for="project-name">Nombre proyecto</label>
                            <input type="email" class="form-control" id="project-name" name="project-name"
                                   placeholder="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" id="save-button" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-pdf">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Obtener PDF</h4>
                </div>
                <div class="modal-body">
                    <form id="filter-tasks">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group"><label for="initDate">Fecha inicio</label><input
                                        class="form-control" name="startDate" type="date"></div>
                            </div>
                            <div class="col-6">
                                <div class="form-group"><label for="endDate">Fecha final</label><input
                                        class="form-control" name="endDate" type="date"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="projectPDF">Proyecto</label>
                            <select id="projectPDF" class="form-control" name="projects-available">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userPDF">Usuario</label>
                            <select class="form-control" id="userPDF" name="user-selected-pdf">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" id="generate-pdf" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-task">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Añadir tarea</h4>
                </div>
                <div class="modal-body">
                    <p>Esta tarea será asignada a <span class="fw-bolder" id="user-name-selected"></span></p>
                    <form id="create-task">
                        <div class="form-group">
                            <label for="task-description">Descripción de la tarea</label>
                            <input type="text" class="form-control" id="task-description" name="task-description"
                                   placeholder="Descripción">
                        </div>
                        <div class="form-group">
                            <label for="task-date">Inicio</label>
                            <input type="datetime-local" class="form-control" id="task-date-start"
                                   name="task-date-start">
                        </div>
                        <div class="form-group">
                            <label for="task-date">Final</label>
                            <input type="datetime-local" class="form-control" id="task-date-end" name="task-date-end">
                        </div>
                        <input type="hidden" id="project-id" name="project-id">
                    </form>
                </div>

                <div class="modal-footer justify-content-end">
                    <button type="button" id="save-task-button" class="btn btn-primary">Guardar tarea</button>
                </div>
            </div>
        </div>
    </div>


    <div class="clone d-none">
        <div class="project-card external-event bg-light color-palette mb-2" data-project-id="">
            <div class="row">
                <div class="col-auto">
                    <p class="name-project fw-bold fs-5"></p>

                </div>
                <div class="col">
                    <p class="date-project text-right fw-light"></p>
                </div>
            </div>
            <p class="creator-project fw-light fs-6"></p>
        </div>
    </div>
@stop

@section('content')
    <div>

    </div>
@stop

@section('js')
    <script>
        let projects = [];
        let users = [];
        let currentDate;

        $(() => {
            $('#save-button').click(saveProject);
            $('input').focus((e) => {
                $(e.target).removeClass('is-invalid');
            })
            currentDate = moment();

            $('#generate-pdf').click(function() {
                generatePDF();
            });



            resetProjectForm();
            getProjects();
            getUserList();

            $('#openModalProject').click(() => {
                $('#modal-project').modal('show');
            })
            $('#openModalPDF').click(() => {
                $('#modal-pdf').modal('show');
            })


            updateCurrentDayDisplay();
            generateCalendar();
            makeCalendarDroppable();

            $('#previous-day').click(() => {
                currentDate = currentDate.subtract(1, 'day');
                updateCurrentDayDisplay();
                generateCalendar();
                loadTasks();
            });


            $('#next-day').click(() => {
                currentDate = currentDate.add(1, 'day');
                updateCurrentDayDisplay();
                generateCalendar();
                loadTasks();
            });

            $('[name="user-selected"]').change(loadTasks);

        })

        function generatePDF() {
            const initDate = $('#filter-tasks [name="startDate"]').val();
            const endDate = $('#filter-tasks [name="endDate"]').val();
            const projectId = $('#projectPDF').val();
            const userId = $('#userPDF').val();

            if (!initDate || !endDate) {
                alert("Por favor, selecciona ambas fechas");
                return;
            }

            const url = '{{ route('pdf.get') }}';
            const queryParams = `?initDate=${initDate}&endDate=${endDate}&projectId=${projectId}&userId=${userId}`;

            window.open(url + queryParams, '_blank');
        }

        function loadTasks() {
            let userId = $('[name="user-selected"]').val();

            $.ajax({
                url: '{{ route('tasks.index') }}',
                method: 'GET',
                data: {
                    user_id: userId,
                    date: currentDate.format('YYYY-MM-DD'),
                },
                success: function (tasks) {
                    printTasks(tasks);
                },
                error: function () {
                    alert('Error al obtener las tareas.');
                }
            });
        }

        function printTasks(tasks) {
            $('#calendar .task').remove();

            tasks.forEach(task => {
                let startMoment = moment(task.start_time);
                let endMoment = moment(task.end_time);

                let durationInMinutes = endMoment.diff(startMoment, 'minutes');
                let numberOfBlocks = Math.ceil(durationInMinutes / 30);

                let height = 50;

                let taskElement = $(`
            <div class="task" style="height: ${height * numberOfBlocks}px; top: 0;">
                ${task.description}
            </div>`);

                $(`tr[data-date="${startMoment.format()}"]`).find('.task-slot').append(taskElement);
            });
        }

        function updateCurrentDayDisplay() {
            $('#current-day').text(currentDate.format('DD/MM/YYYY'));
        }

        function generateCalendar() {
            let calendarBody = $('#calendar tbody');
            calendarBody.empty();
            const today = currentDate.startOf('day').set('hour', 8);

            for (let i = 0; i <= 21; i++) {
                let currentTime = today.clone().add(i * 30, 'minutes');

                // Crear una fila para la tabla
                let row =
                    $(`<tr data-date="${currentTime.format()}">
                        <td>${currentTime.format('HH:mm')}</td>
                        <td class="task-slot" style="height: 50px;"></td>
                    </tr>`);

                calendarBody.append(row);
            }

            makeCalendarDroppable();
        }

        function makeProjectsDraggable(ele) {
            ele.each(function () {

                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        function makeCalendarDroppable() {
            $('.task-slot').droppable({
                accept: '.external-event',
                drop: function (event, ui) {
                    let projectElement = ui.helper.clone();
                    let taskSlot = $(this).closest('tr');
                    let taskDate = taskSlot.data('date');

                    let projectId = projectElement.data('project-id');
                    let project = projects.find((item) => item.id == projectId);

                    // Pasar la fecha completa al modal
                    openTaskModal(project, taskDate);
                }
            });
        }


        function openTaskModal(project, date) {
            let startDate = moment(date);
            let endDate = startDate.clone().add(1, 'hour'); // por defecto una hora después

            $('#project-id').val(project.id);
            $('#task-date-start').val(startDate.format('YYYY-MM-DDTHH:mm'));
            $('#task-date-end').val(endDate.format('YYYY-MM-DDTHH:mm'));

            $('#user-name-selected').html(users.find((user) => user.id == $('[name="user-selected"]').val())['name']);

            $('#modal-task .modal-title').html(`Añadir tarea en <b>"${project.title}"</b>`);
            $('#modal-task').modal('show');

            // Guardar la tarea cuando se presione el botón de guardar
            $('#save-task-button').off('click').click(() => saveTask(project.id));
        }


        function saveTask(projectId) {
            let description = $('#task-description').val();
            let startMoment = moment($('#task-date-start').val());
            let endMoment = moment($('#task-date-end').val());

            if (!description.trim()) {
                $('#task-description').addClass('is-invalid');
                return;
            }

            if (startMoment.hour() < 8 || startMoment.hour() > 18) {
                alert("La hora de inicio debe estar entre 08:00 y 18:30.");
                return;
            }

            $.ajax({
                url: '{{ route('tasks.store') }}',
                method: 'POST',
                data: {
                    description: description,
                    user_id: $('[name="user-selected"]').val(),
                    project_id: projectId,
                    start_time: startMoment.format('YYYY-MM-DD HH:mm:ss'),
                    end_time: endMoment.format('YYYY-MM-DD HH:mm:ss'),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $('#modal-task').modal('hide');
                    $('#task-description').val('');
                },
                error: function (xhr) {
                    alert('Error al guardar la tarea.');
                }
            });

            loadTasks();

            $('#modal-task').modal('hide');
            $('#task-description').val('');
        }


        function getProjects() {
            $.ajax({
                url: '{{ route('projects.index.api') }}',
                method: 'GET',
                success: function (res) {
                    // console.log(res);
                    projects = res;
                    printProjects();
                }
            })
        }

        function getUserList() {
            $.ajax({
                url: '{{ route('users.index.api') }}',
                method: 'GET',
                success: function (res) {
                    users = res.users;
                    printUsers();
                }
            })
        }

        function printUsers() {
            let select = $('[name="user-selected"]');
            let select2 = $('[name="user-selected-pdf"]');
            select.empty();

            users.forEach((user) => {
                let html = `<option value="${user.id}" ${user.id === {{ session()->get('user')['id'] }} ? 'selected' : ''}">${user.name} ${user.id === {{ session()->get('user')['id'] }} ? '(Tú)' : ''}</option>`;
                select.append(html);
                select2.append(html);
            })

            loadTasks();
        }

        function printProjects() {
            let card = $('.clone .project-card');

            $('#external-events').empty();

            $('[name="projects-available"]').empty();
            $('[name="projects-available"]').append('<option value="all" selected>Todos</option>');

            projects.forEach((project) => {
                let temp_card = card.clone();
                $(temp_card).attr('data-project-id', project.id);
                $(temp_card).find('.name-project').html(project.title);
                $(temp_card).find('.date-project').html(moment(project.created_at).format('DD/MM/YYYY HH:mm'));
                $(temp_card).find('.creator-project').html(`Creador: <span class="fw-bolder">${project.creator_name}</span>`);

                $('[name="projects-available"]').append(`<option value="${project.id}">${project.title}</option>`);

                // Añade la tarjeta clonada al contenedor
                $('#external-events').append(temp_card);
            })

            makeProjectsDraggable($('#external-events .external-event'))

        }

        function resetProjectForm() {
            $('[name="project-name"]').val('');
        }

        function saveProject() {
            let input = $('[name="project-name"]');
            let name = input.val();

            if (!name.trim())
                input.addClass('is-invalid');
            else
                $.ajax({
                    url: '{{ route('projects.store') }}',
                    data: {title: name},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function () {
                        $('#modal-project').modal('hide');
                        getProjects();
                    }
                })
        }
    </script>
@stop
