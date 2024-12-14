<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Registro;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function indexLogin()
    {
        return view("login.index");
    }
    public function indexRegister()
    {
        return view("login.register");
    }
    public function login(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'username' => 'required|string|min:3|max:50',
            'clave' => 'required|string|min:6',
        ]);

        // Buscar al usuario en la base de datos
        $usuario = Registro::where('username', $request->input('username'))->first();

        if ($usuario && $usuario->clave === $request->input('clave')) {
            // Guardar el usuario en la sesión
            session(['usuario' => $usuario]);

            // Crear una cookie con el usuario_id
            $cookie = cookie('usuario_id', $usuario->usuario_id, 60 * 24 * 7); // Duración: 7 días

            // Redirigir con la cookie adjunta
            return redirect()
                ->route('usuario')
                ->with('success', 'Inicio de sesión exitoso')
                ->cookie($cookie);
        }

        // Respuesta si las credenciales son incorrectas
        return back()->withErrors(['message' => 'Credenciales incorrectas.'])->withInput();
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|unique:usuario,username',
                'email' => 'required|email|unique:usuario,email',
                'clave' => 'required|string|min:6',
            ]);

            // Generar token aleatorio
            $token = Str::random(6);

            // Guardar datos temporalmente en la sesión
            session([
                'registro_temp' => [
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'clave' => $request->input('clave'),
                    'token' => $token,
                ],
            ]);

            // Enviar el correo directamente con el contenido del token
            Mail::raw("Tu token de verificación es: $token", function ($message) use ($request) {
                $message->to($request->input('email'));
                $message->subject('Tu token de verificación');
            });

            return response()->json(['message' => 'Token enviado al correo.', 'clave' => $request->input('clave'), 'email' => $request->input('email')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el registro.', 'error' => $e->getMessage()], 500);
        }
    }


    public function verifyToken(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
            ]);

            $registroTemp = session('registro_temp');

            if (!$registroTemp) {
                return response()->json(['message' => 'No se encontró una sesión temporal válida.'], 422);
            }

            if ($registroTemp['token'] !== $request->input('token')) {
                return response()->json(['message' => 'Token incorrecto.'], 422);
            }

            // Crear el registro
            $registro = Registro::create([
                'username' => $registroTemp['username'],
                'email' => $registroTemp['email'],
                'clave' => ($registroTemp['clave']), // Cifrado de la contraseña
            ]);

            // Limpiar la sesión temporal
            session()->forget('registro_temp');

            return response()->json(['message' => 'Registro exitoso.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación.', 'error' => $e->getMessage()], 500);
        }
    }

}
