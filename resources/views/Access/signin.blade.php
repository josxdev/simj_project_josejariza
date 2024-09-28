@extends('Layout.access_layout')

@section('form')
    <div class="acceso">
        <form id="signin" class="formulario" method="POST" action="{{ route('user.auth') }}">
            @csrf
            <h2 class="titulo">¡Hola! Bienvenido :)</h2>
            <p class="subtitulo text-center">Introduce tu correo electrónico y contraseña que utilizaste al momento de
                registrarte</p>

            <div class="grupo-formulario mt-5">
                <div class="grupo-input">
                    <input value="josejariza99@gmail.com" placeholder=" " type="text" name="email" id="email">
                    <label for="email">Correo electrónico</label>
                </div>
            </div>

            <div class="grupo-formulario mt-3">
                <div class="grupo-input">
                    <input value="Seguridad123" placeholder=" " type="password" name="password" id="password">
                    <label for="password">Contraseña</label>
                </div>
            </div>

            <a class="enlace mt-3" href="#">¿Olvidaste la contraseña?</a>

            <button id="submit-form" type="button">Iniciar sesión</button>


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

        <p class="cambiar-formulario mt-auto text-center">¿No tienes cuenta? <a class="enlace" href="{{ route('signup') }}">Crea una nueva aquí mismo</a></p>
    </div>
@endsection

@section('image')
    <div class="imagen fondo-naranja">
        <div class="picture">
        </div>
        <p class="pie-imagen">Este proyecto ha sido realizado por <span class="fw-bolder">José J Ariza Flores</span> para <span class="fw-bolder">Soluciones informáticas MJ</span></p>
    </div>
@endsection

@section('scripts')
    <script type="module">
        $(() => {
            $('#submit-form').click(authUser);

            $('input').focus(function () {
                $(this).closest('.grupo-input').removeClass('error');

            })
        })

        function authUser(e) {
            e.preventDefault();

            const buttonText = $(this).text();
            $(this).text('Cargando...').prop('disabled', true)

            if (!checkHaveErrors()) {
                let user = {
                    email: $('[name="email"]').val(),
                    password: $('[name="password"]').val(),
                };

                $('#signin').submit();

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


            return hasError;
        }
    </script>
@endsection
