@extends('layouts.app')

@section('content')
    <div id="spacer" style="height: 1rem"></div>
    <div class="container" style="margin-top: auto;">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body card text-center fondo-blanco">
                        <h3 class="texto-guinda">Iniciar sesión</h3><br><br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col" style="display: contents">
                                    <em class="far fa-user texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col">
                                    <input id="username" placeholder="Usuario" type="text"
                                        class="form-control w-100 @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col" style="display: contents">
                                    <em class="fas fa-lock texto-guinda" style="padding-top: 10px;padding-left: 10px;"></em>
                                </div>
                                <div class="col">
                                    <div class="input-group w-100">
                                        <input id="password" placeholder="Contraseña" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @php
                                            $userAgent = $_SERVER['HTTP_USER_AGENT'];
                                        @endphp
                                        @if(!str_contains($userAgent,'Edg'))
                                            <button id="togglePassword" class="btn btn-outline-secondary" type="button"><em class="fas fa-eye"></em></button>
                                        @endif
                                    </div>
                                    @error('password')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div>
                                    <button type="submit" class="btn btn-primary"><em class="fas fa-sign-in-alt"></em>
                                        {{ __('Ingresar') }}
                                    </button>
                                    <?php /*
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                    */
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        toggleButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerHTML = '<em class="fas fa-eye-slash"></em>';
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = '<em class="fas fa-eye"></em>';
            }
        });
    </script>
@endsection
