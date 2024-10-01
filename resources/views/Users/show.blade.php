@extends('Layout.app_layout')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
    <div class="mt-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Rellena el siguiente formulario</h3>
            </div>

            <form id="update" method="POST" action="{{ route('user.update', ['id' => $user['id']]) }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input value="{{ $user['name'] }}" type="text" class="form-control" name="name" id="name" placeholder="Introduce nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{ $user['email'] }}" type="email" class="form-control" name="email" id="email"
                               placeholder="Introduce el email">
                    </div>

                    <div class="form-check">
                        <input {{ $user['is_admin'] ? 'checked' : '' }} type="checkbox" name="isAdmin" class="form-check-input" id="isAdmin">
                        <label class="form-check-label" for="isAdmin">Seleccióname si quieres que este usuario sea <b>administrador</b></label>
                    </div>
                </div>

                <div class="card-footer d-flex">
                    <button type="submit" id="submit-form" class="btn btn-primary ml-auto">Actualizar usuario</button>
                </div>
            </form>
        </div>

        @if ($errors->any())
            <div class="error-container alert alert-danger mt-4 mb-auto">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@stop

@section('js')
    <script type="module">

        $(() => {
            $('#submit-form').click(updateUser);

            $('input').focus(function () {
                $(this).removeClass('is-invalid');

            })
        })

        /**
         * Envío información al backend para editar un usario.
         * @param e
         */
        function updateUser(e) {
            e.preventDefault();

            const buttonText = $(this).text();
            $(this).text('Cargando...').prop('disabled', true)

            if (!checkHaveErrors()) {
                $('#update').submit();

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Vaya... qué mal',
                    text: 'Parece que hay algo que no está bien en el formulario. Revísalo de nuevo.'
                })
            }
            $(this).text(buttonText).prop('disabled', false)


        }

        /**
         * Comprobación de errores
         * @returns {boolean}
         */
        function checkHaveErrors() {
            $('.grupo-input.error').removeClass('error');
            let hasError = false;

            let inputName = $('[name="name"]');
            let inputNameVal = inputName.val();
            if (!inputNameVal.trim()) {
                inputName.addClass('is-invalid');
                hasError = true;
            }

            let inputEmail = $('[name="email"]');
            let inputEmailVal = inputEmail.val();
            if (!inputEmailVal.trim()) {
                inputEmail.addClass('is-invalid');
                hasError = true;
            }

            return hasError;
        }
    </script>
@stop
