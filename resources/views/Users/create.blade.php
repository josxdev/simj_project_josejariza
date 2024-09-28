@extends('Layout.app_layout')

@section('content_header')
    <h1>Añadir usuario</h1>
@stop

@section('content')
    <div class="mt-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Rellena el siguiente formulario</h3>
            </div>

            <form id="signup" method="POST" action="{{ route('user.store2') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Introduce nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Introduce el email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Escribe una contraseña">
                    </div>
                    <div class="form-group">
                        <label for="password">Repite contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation" placeholder="Repite la contraseña">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="isAdmin" class="form-check-input" id="isAdmin">
                        <label class="form-check-label" for="isAdmin">Seleccióname si quieres que este usuario sea <b>administrador</b></label>
                    </div>
                </div>

                <div class="card-footer d-flex">
                    <button type="submit" id="submit-form" class="btn btn-primary ml-auto">Registrar usuario</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script type="module">

        $(() => {
            $('#submit-form').click(registerUser);

            $('input').focus(function () {
                $(this).removeClass('is-invalid');

            })
        })

        function registerUser(e) {
            e.preventDefault();

            const buttonText = $(this).text();
            $(this).text('Cargando...').prop('disabled', true)

            if (!checkHaveErrors()) {
                $('#signup').submit();

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Vaya... qué mal',
                    text: 'Parece que hay algo que no está bien en el formulario. Revísalo de nuevo.'
                })
            }
            $(this).text(buttonText).prop('disabled', false)


        }

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

            let inputPassword = $('[name="password"]');
            let inputPasswordVal = inputPassword.val();
            if (!inputPasswordVal.trim()) {
                inputPassword.addClass('is-invalid');
                hasError = true;
            }

            let inputPasswordConfirm = $('[name="password_confirmation"]');
            let inputPasswordConfirmVal = inputPasswordConfirm.val();
            if (!inputPasswordConfirmVal.trim()) {
                inputPasswordConfirm.addClass('is-invalid');
                hasError = true;
            }

            if (inputPasswordVal !== inputPasswordConfirmVal) {
                inputPasswordConfirm.addClass('is-invalid');
                hasError = true;
            }

            return hasError;


        }
    </script>
@stop
