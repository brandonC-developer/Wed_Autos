@extends('layout.app')

@section('title', 'Inicio - Vehículos')

@section('content')
<main>
    <section class="vh-100"
        style="background-image: url('ruta/a/tu/imagen.png'); background-size: cover; background-position: center;">
        <div class="container-fluid h-100 d-flex justify-content-center align-items-center p-0">
            <div class="row w-100 h-100">
                <!-- Columna para el formulario -->
                <div class="bg-white col-lg-6 col-md-12 text-black d-flex flex-column justify-content-center h-100">
                    <!-- <div class="px-5 ms-xl-4 text-center text-lg-start">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                    </div> -->

                    <div class="d-flex flex-column align-items-center h-custom-2 px-5 ">
                        <form id="registerForm" style="width: 23rem;">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up</h3>
                            @csrf
                            <div class="form-outline mb-4">
                                <input type="text" id="formName" class="form-control form-control-lg" name="username" />
                                <label class="form-label" for="formName">Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="formEmail" class="form-control form-control-lg" name="email" />
                                <label class="form-label" for="formEmail">Email Address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="formPassword" class="form-control form-control-lg"
                                    name="clave" />
                                <label class="form-label" for="formPassword">Password</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="formConfirmPassword" class="form-control form-control-lg"
                                    name="claveConfirm" />
                                <label class="form-label" for="formConfirmPassword">Confirm Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="button"
                                    id="registerBtn">Register</button>
                            </div>

                            <p>Already have an account? <a href="{{ route('login')}}" class="link-info">Log in
                                    here</a></p>

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
<script>
    document.getElementById('registerBtn').addEventListener('click', function () {
        const form = document.getElementById('registerForm');
        const formData = new FormData(form);

        // Enviar solicitud para registrar y generar token
        fetch("{{ route('register') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.message) {
                    // Solicitar token en un prompt
                    const token = prompt("Introduce el token enviado a tu correo:");

                    if (token) {
                        // Enviar el token para validación
                        fetch("{{ route('verify.token') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            },
                            body: JSON.stringify({ token }),
                        })
                            .then(response => response.json())
                            .then(result => {
                                if (result.message === "Registro exitoso.") {
                                    alert(result.message);
                                    window.location.href = "{{ route('login') }}";
                                } else {
                                    alert(result.message || "Error al verificar el token.");
                                }
                            });
                    }
                }
            })
            .catch(error => {
                alert("Ocurrió un error. Por favor, inténtalo de nuevo.");
                console.error(error);
            });
    });
</script>
@endsection