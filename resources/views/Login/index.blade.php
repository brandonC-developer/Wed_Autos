@extends('layout.app')

@section('title', 'Inicio - Vehículos')

@section('content')
<main>
    <section class="vh-100 bg-white" style="background-size: cover; background-position: center;">
        <div class="container-fluid h-100 d-flex justify-content-center align-items-center p-0">
            <div class="row w-100 h-100">
                <!-- Columna para el formulario -->
                <div class="col-lg-6 col-md-12 text-black d-flex flex-column justify-content-center h-100">
                    <!-- <div class="px-5 ms-xl-4 text-center text-lg-start">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                    </div> -->

                    <div class="d-flex flex-column align-items-center h-custom-2 px-5 ">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('sesion') }}" method="POST" style="max-width: 23rem; width: 100%;">

                            @csrf
                            <h3 class="fw-normal mb-3 pb-3 text-center text-lg-start" style="letter-spacing: 1px;">Log
                                in</h3>

                            <!-- Campo de usuario -->
                            <div class="form-outline mb-4">
                                <input type="text" id="username" class="form-control form-control-lg" name="username"
                                    required />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <!-- Campo de contraseña -->
                            <div class="form-outline mb-4">
                                <input type="password" id="clave" class="form-control form-control-lg" name="clave"
                                    required />
                                <label class="form-label" for="clave">Password</label>
                            </div>

                            <!-- Botón de inicio de sesión -->
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block w-100" type="submit">Login</button>
                            </div>

                            <!-- Opciones adicionales -->
                            <p class="small mb-5 pb-lg-2 text-center">
                                <a class="text-muted" href="#!">Forgot password?</a>
                            </p>
                            <p class="text-center">
                                Don't have an account?
                                <a href="{{ route('login.submit') }}" class="link-info">Register here</a>
                            </p>
                        </form>

                    </div>
                </div>

                <!-- Columna para la imagen -->
                <div
                    class="col-lg-6 col-md-12 px-0 d-none d-lg-block d-flex justify-content-center align-items-center h-100">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                        alt="Login image" class="w-100 h-100" style="object-fit: cover; object-position: center;">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection