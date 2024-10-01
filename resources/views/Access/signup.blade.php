@extends('Layout.access_layout')

@section('form')
    <div class="acceso">
        <form class="formulario" id="signup" method="POST" action="{{ route('user.store') }}">
            @csrf

            <h2 class="titulo">¡Regístrate! Es fácil :)</h2>
            <p class="subtitulo text-center">Rellena todos los campos para poder usar nuestra plataforma</p>

            <input type="checkbox" checked hidden name="redirect">
            <div class="grupo-formulario mt-5">
                <div class="grupo-input">
                    <input value="Jose" placeholder=" " type="text" name="name" id="name">
                    <label for="name">Tu nombre</label>
                </div>
            </div>

            <div class="grupo-formulario mt-3">
                <div class="grupo-input">
                    <input value="josejariza99@gmail.com" placeholder=" " type="text" name="email" id="email">
                    <label for="email">Tu correo electrónico</label>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="grupo-formulario">
                        <div class="grupo-input">
                            <input value="Seguridad123" placeholder=" " type="password" name="password" id="password">
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="grupo-formulario">
                        <div class="grupo-input">
                            <input value="Seguridad123" placeholder=" " type="password" name="password_confirmation" id="password_confirmation">
                            <label for="password_confirmation">Repite contraseña</label>
                        </div>
                    </div>
                </div>
            </div>

            <button id="submit-form" type="button">Registrar cuenta</button>
        </form>

        @if ($errors->any())
            <div class="error-container alert alert-danger mt-auto mb-auto">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="cambiar-formulario mt-auto text-center p-0">¿Ya tienes una cuenta? <a class="enlace"
                                                                                    href="{{ route('signin') }}">Inicia
                sesión ahora mismo</a></p>
    </div>
@endsection

@section('image')
    <div class="imagen fondo-azul">
        <div class="picture"> </div>
        <p class="pie-imagen">Este proyecto ha sido realizado por <span class="fw-bolder">José J Ariza Flores</span>
            para <span class="fw-bolder">Soluciones informáticas MJ</span></p>
    </div>
@endsection


@section('scripts')
    <script type="module">

        $(() => {
            $('#submit-form').click(registerUser);

            $('input').focus(function () {
                $(this).closest('.grupo-input').removeClass('error');

            })
        })

        /**
         * Registro de usuario
         * @param e
         */
        function registerUser(e) {
            e.preventDefault();

            // Gestión del estado del botón de cargando
            const buttonText = $(this).text();
            $(this).text('Cargando...').prop('disabled', true)

            // Comprobación previa de errores en el formulario
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

        /**
         * Detectar errores en el formulario. Devuelve si hay errores o no
         * @returns {boolean}
         */
        function checkHaveErrors() {
            $('.grupo-input.error').removeClass('error');
            let hasError = false;

            let inputName = $('[name="name"]');
            let inputNameVal = inputName.val();
            if (!inputNameVal.trim()) {
                inputName.closest('.grupo-input').addClass('error');
                hasError = true;
            }


            let inputEmail = $('[name="email"]');
            let inputEmailVal = inputEmail.val();
            if (!inputEmailVal.trim()) {
                inputEmail.closest('.grupo-input').addClass('error');
                hasError = true;
            }

            let inputPassword = $('[name="password"]');
            let inputPasswordVal = inputPassword.val();
            if (!inputPasswordVal.trim()) {
                inputPassword.closest('.grupo-input').addClass('error');
                hasError = true;
            }

            let inputPasswordConfirm = $('[name="password_confirmation"]');
            let inputPasswordConfirmVal = inputPasswordConfirm.val();
            if (!inputPasswordConfirmVal.trim()) {
                inputPasswordConfirm.closest('.grupo-input').addClass('error');
                hasError = true;
            }

            if (inputPasswordVal !== inputPasswordConfirmVal) {
                inputPasswordConfirm.closest('.grupo-input').addClass('error');
                hasError = true;
            }

            return hasError;
        }
    </script>
@endsection
