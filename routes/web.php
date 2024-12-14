<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    HomeController,
    CatalogoController,
    VehiculoController,
    CompraController,
    UserController
};
use App\Http\Middleware\VerifyRole;

// Ruta Principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de Login (solo para invitados)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'indexLogin'])->name('login');
    Route::post('/iniciarSesion', [LoginController::class, 'login'])->name('sesion');


    // Ruta de Rehgistro
    Route::get('/register', [LoginController::class, 'indexRegister'])->name('login.submit');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/verify-token', [LoginController::class, 'verifyToken'])->name('verify.token');

});

// Rutas de Vehículos
Route::prefix('vehiculo')->group(function () {
    Route::get('/buscar', [CatalogoController::class, 'index'])->name('vehiculo.catalogo');
    // Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/vender', [VehiculoController::class, 'index'])->name('vehiculo.vender');
    // Route::post('/vender', [VehiculoController::class, 'store'])->name('vehiculo.store');
    Route::get('/descripcion/{id}', [VehiculoController::class, 'show'])->name('vehiculo.show');

    // });
});

// Ruta de Usuario (solo administradores)
// Route::middleware(['auth', 'role:user'])->group(function () {
Route::get('/usuario', [UserController::class, 'index'])->name('usuario');
Route::get('/usuarioCatalogo', [UserController::class, 'indexCatalogo'])->name('usuario_catalogo');
Route::get('/usuarioVehiculo/{id}', [UserController::class, 'descripcion'])->name('usuario_vehiculo');
Route::get('/comprar/{id}', [UserController::class, 'comprarShow'])->name('usuario_comprar');

Route::get('/favoritosUsuario', [UserController::class, 'favoritos'])->name('usuario_favoritos');
Route::post('/favoritos_agregar/{placa}', [UserController::class, 'agregarFavorito'])->name('usuario_agregarfavorito');
Route::delete('/favoritos_eliminar/{placa}', [UserController::class, 'eliminarFavorito'])->name('usuario_eliminarfavorito');



Route::get('/vender', [UserController::class, 'indexVender'])->name('vehiculo.vender');
Route::post('/vender', [UserController::class, 'store'])->name('vehiculo.store');

// });



// Ruta de Compra
Route::get('/compra/{id}', [CompraController::class, 'simulate'])->name('compra.simulate');

