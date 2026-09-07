<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Maestro;
use App\Models\Administrativo;
use App\Models\Tutor;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado de usuarios.
     */
    public function index(Request $request)
    {
        $query = User::with('roles');

        // Buscar usuario
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {

                $q->where('nombre', 'like', "%{$buscar}%")
                    ->orWhere(
                        'apellido_paterno',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'apellido_materno',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'identificacion',
                        'like',
                        "%{$buscar}%"
                    );
            });
        }

        // Filtrar por estado
        if ($request->filled('estado')) {

            $query->where(
                'activo',
                $request->estado === 'activo'
            );
        }

        // Filtrar por rol
        if ($request->filled('rol')) {

            $query->whereHas('roles', function ($q) use ($request) {

                $q->where(
                    'nombre',
                    $request->rol
                );
            });
        }

        $usuarios = $query
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        $roles = Rol::orderBy('nombre')->get();

        return view(
            'usuarios.index',
            compact(
                'usuarios',
                'roles'
            )
        );
    }


    /**
     * Mostrar formulario para crear usuario.
     */
    public function create()
    {
        $roles = Rol::orderBy('nombre')->get();

        return view(
            'usuarios.create',
            compact('roles')
        );
    }


    /**
     * Crear nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre' => [
                'required',
                'string',
                'max:255'
            ],

            'apellido_paterno' => [
                'required',
                'string',
                'max:255'
            ],

            'apellido_materno' => [
                'nullable',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20'
            ],

            'curp' => [
                'nullable',
                'string',
                'size:18',
                'unique:users,curp'
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date'
            ],

            'sexo' => [
                'nullable',
                'in:Masculino,Femenino,Otro'
            ],

            'identificacion' => [
                'nullable',
                'string',
                'max:30',
                'unique:users,identificacion'
            ],

            'roles' => [
                'required',
                'array',
                'min:1'
            ],

            'roles.*' => [
                'exists:roles,id'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Generar contraseña automáticamente
        |--------------------------------------------------------------------------
        */

        $password = $this->generarPassword();


        /*
        |--------------------------------------------------------------------------
        | Crear usuario y datos relacionados
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $request,
            $password
        ) {

            $usuario = User::create([

                'nombre' => $request->nombre,

                'apellido_paterno' =>
                    $request->apellido_paterno,

                'apellido_materno' =>
                    $request->apellido_materno,

                'email' =>
                    $request->email,

                'telefono' =>
                    $request->telefono,

                'curp' =>
                    $request->curp
                        ? strtoupper($request->curp)
                        : null,

                'fecha_nacimiento' =>
                    $request->fecha_nacimiento,

                'sexo' =>
                    $request->sexo,

                'identificacion' =>
                    $request->identificacion,

                'activo' => true,

                'password' => $password,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Asignar roles
            |--------------------------------------------------------------------------
            */

            $usuario->roles()->sync(
                $request->roles
            );


            /*
            |--------------------------------------------------------------------------
            | Guardar información específica de los roles
            |--------------------------------------------------------------------------
            */

            $this->guardarInformacionPorRoles(
                $usuario,
                $request
            );
        });


        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Usuario creado correctamente. Contraseña generada: '
                . $password
            );
    }


    /**
     * Mostrar información completa del usuario.
     */
    public function show(User $usuario)
    {
        $usuario->load([

            'roles',

            'maestro',

            'administrativo',

            'tutor',

            'alumno',

        ]);

        return view(
            'usuarios.show',
            compact('usuario')
        );
    }


    /**
     * Mostrar formulario de edición.
     */
    public function edit(User $usuario)
    {
        $usuario->load([

            'roles',

            'maestro',

            'administrativo',

            'tutor',

            'alumno',

        ]);

        $roles = Rol::orderBy('nombre')->get();

        return view(
            'usuarios.edit',
            compact(
                'usuario',
                'roles'
            )
        );
    }


    /**
     * Actualizar usuario.
     */
    public function update(
        Request $request,
        User $usuario
    ) {

        $request->validate([

            'nombre' => [
                'required',
                'string',
                'max:255'
            ],

            'apellido_paterno' => [
                'required',
                'string',
                'max:255'
            ],

            'apellido_materno' => [
                'nullable',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $usuario->getKey()
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20'
            ],

            'curp' => [
                'nullable',
                'string',
                'size:18',
                'unique:users,curp,' . $usuario->getKey()
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date'
            ],

            'sexo' => [
                'nullable',
                'in:Masculino,Femenino,Otro'
            ],

            'identificacion' => [
                'nullable',
                'string',
                'max:30',
                'unique:users,identificacion,' . $usuario->getKey()
            ],

            'roles' => [
                'required',
                'array',
                'min:1'
            ],

            'roles.*' => [
                'exists:roles,id'
            ],
        ]);


        DB::transaction(function () use (
            $request,
            $usuario
        ) {

            $usuario->update([

                'nombre' =>
                    $request->nombre,

                'apellido_paterno' =>
                    $request->apellido_paterno,

                'apellido_materno' =>
                    $request->apellido_materno,

                'email' =>
                    $request->email,

                'telefono' =>
                    $request->telefono,

                'curp' =>
                    $request->curp
                        ? strtoupper($request->curp)
                        : null,

                'fecha_nacimiento' =>
                    $request->fecha_nacimiento,

                'sexo' =>
                    $request->sexo,

                'identificacion' =>
                    $request->identificacion,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Actualizar roles
            |--------------------------------------------------------------------------
            */

            $usuario->roles()->sync(
                $request->roles
            );


            /*
            |--------------------------------------------------------------------------
            | Actualizar información específica de roles
            |--------------------------------------------------------------------------
            */

            $this->guardarInformacionPorRoles(
                $usuario,
                $request
            );
        });


        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Usuario actualizado correctamente.'
            );
    }


    /**
     * Activar / desactivar usuario.
     */
public function destroy(Request $request, User $usuario)
{
    if (
        $usuario->getKey() === $request->user()->getKey()
    ) {
        return back()->with(
            'error',
            'No puedes desactivar tu propia cuenta.'
        );
    }

    $usuario->update([
        'activo' => ! $usuario->activo
    ]);

    $mensaje = $usuario->activo
        ? 'Usuario activado correctamente.'
        : 'Usuario desactivado correctamente.';

    return back()->with(
        'success',
        $mensaje
    );
}


    /**
     * Generar nueva contraseña para un usuario.
     */
   public function regenerarPassword(Request $request, User $usuario)
{
    /*
    |--------------------------------------------------------------------------
    | Evitar cambiar la contraseña propia
    |--------------------------------------------------------------------------
    */

    if (
        $usuario->getKey() === $request->user()->getKey()
    ) {
        return back()->with(
            'error',
            'No puedes regenerar tu propia contraseña desde esta opción.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Generar nueva contraseña
    |--------------------------------------------------------------------------
    */

    $password = $this->generarPassword();

    /*
    |--------------------------------------------------------------------------
    | Guardar nueva contraseña
    |--------------------------------------------------------------------------
    */

    $usuario->update([
        'password' => $password
    ]);

    return back()->with(
        'success',
        'Nueva contraseña generada: ' . $password
    );
}


    /**
     * Generar contraseña automática.
     */
    private function generarPassword(): string
    {
        return 'SIGE-' . strtoupper(
            Str::random(8)
        );
    }


    /**
     * Guardar información específica dependiendo de los roles.
     */
    private function guardarInformacionPorRoles(
        User $usuario,
        Request $request
    ): void {

        $roles = Rol::whereIn(
            'id',
            $request->roles
        )->pluck('nombre');


        /*
        |--------------------------------------------------------------------------
        | MAESTRO
        |--------------------------------------------------------------------------
        */

        if ($roles->contains('Maestro')) {

            Maestro::updateOrCreate(

                [
                    'user_id' =>
                        $usuario->getKey()
                ],

                [

                    'numero_empleado' =>
                        $request->numero_empleado
                        ?: 'EMP-' . str_pad(
                            $usuario->getKey(),
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'especialidad' =>
                        $request->especialidad,

                    'cedula_profesional' =>
                        $request->cedula_profesional,

                    'fecha_ingreso' =>
                        $request->fecha_ingreso,

                    'tipo_contratacion' =>
                        $request->tipo_contratacion,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ADMINISTRATIVO
        |--------------------------------------------------------------------------
        */

        if ($roles->contains('Administrativo')) {

            Administrativo::updateOrCreate(

                [
                    'user_id' =>
                        $usuario->getKey()
                ],

                [

                    'numero_empleado' =>
                        $request->numero_empleado_admin
                        ?: 'ADM-' . str_pad(
                            $usuario->getKey(),
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'puesto' =>
                        $request->puesto,

                    'departamento' =>
                        $request->departamento,

                    'extension' =>
                        $request->extension,

                    'fecha_ingreso' =>
                        $request->fecha_ingreso_admin,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TUTOR
        |--------------------------------------------------------------------------
        */

        if ($roles->contains('Tutor')) {

            Tutor::updateOrCreate(

                [
                    'user_id' =>
                        $usuario->getKey()
                ],

                [

                    'ocupacion' =>
                        $request->ocupacion,

                    'parentesco_principal' =>
                        $request->parentesco_principal,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ALUMNO
        |--------------------------------------------------------------------------
        */

        if ($roles->contains('Alumno')) {

            Alumno::updateOrCreate(

                [
                    'user_id' =>
                        $usuario->getKey()
                ],

                [

                    'matricula' =>
                        $request->matricula
                        ?: 'ALU-' . str_pad(
                            $usuario->getKey(),
                            6,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'numero_seguro_social' =>
                        $request->numero_seguro_social,

                    'fecha_ingreso' =>
                        $request->fecha_ingreso_alumno,
                ]
            );
        }
    }
}