@extends('Layout.app_layout')

@section('content_header')
    <h1>Listado usuarios</h1>
@stop

@section('content')
    <div>
        @can('manage-users')
            <p>El usuario tiene acceso para gestionar usuarios.</p>
        @endcan

        <p>Gestiona a los usuarios de la aplicación. Estos podrán acceder a la aplicación con la información que le
            hayas facilitado. Más adelante, una vez dentro, podrán cambiar la información asignada.</p>
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Añadir nuevo</a>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Administrador</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr data-index="{{ $index }}">
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['is_admin'] ? 'Sí' : 'No' }}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('user.show', ['id' => $user['id']]) }}" class="editUser btn btn-sm btn-light"><i class="fas fa-pen"></i></a>
                                <button class="deleteUser btn btn-sm btn-light"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    @if(count($users) === 0)
                        <tr>
                            <td colspan="5" class="text-center py-4">¡Aún no hay más usuarios en la aplicación!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                {{--                <ul class="pagination pagination-sm m-0 float-right">--}}
                {{--                    <li class="page-item"><a class="page-link" href="#">«</a></li>--}}
                {{--                    <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                {{--                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                {{--                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                {{--                    <li class="page-item"><a class="page-link" href="#">»</a></li>--}}
                {{--                </ul>--}}
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        const users = {{ Js::from($users) }};

        $(() => {
            $('.deleteUser').click(destroyUser);

        })


        function destroyUser() {
            let index = $(this).closest('tr').data('index');
            const user = users[index];

            Swal.fire({
                title: '¿Estás seguro?',
                icon: 'warning',
                html: `Estás a punto de eliminar a <b>"${ user.name }"</b> y esta acción no tiene retorno. ¿Estás seguro de ello?`,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Sí, lo estoy',
                cancelButtonText: 'Mejor no'
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.delete(`/api/user/${user.id}`).then(() => {
                        location.reload();
                    })
                }
            })
        }

    </script>
@stop
