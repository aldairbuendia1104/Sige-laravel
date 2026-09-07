<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Información del usuario
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Consulta detallada de la cuenta.
                </p>

            </div>

            <a
                href="{{ route('usuarios.edit', $usuario) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md"
            >
                Editar
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">


            {{-- IDENTIDAD --}}

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $usuario->nombre }}
                    {{ $usuario->apellido_paterno }}
                    {{ $usuario->apellido_materno }}
                </h3>

                <p class="text-gray-500 mt-1">
                    {{ $usuario->email }}
                </p>

                <div class="mt-4 flex flex-wrap gap-2">

                    @foreach($usuario->roles as $rol)

                        <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm">
                            {{ $rol->nombre }}
                        </span>

                    @endforeach


                    @if($usuario->activo)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                            Activo
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm">
                            Inactivo
                        </span>

                    @endif

                </div>

            </div>


            {{-- DATOS PERSONALES --}}

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                <h3 class="text-lg font-semibold mb-6">
                    Datos personales
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <span class="text-sm text-gray-500">
                            Teléfono
                        </span>

                        <p>
                            {{ $usuario->telefono ?? 'No registrado' }}
                        </p>
                    </div>


                    <div>
                        <span class="text-sm text-gray-500">
                            CURP
                        </span>

                        <p>
                            {{ $usuario->curp ?? 'No registrada' }}
                        </p>
                    </div>


                    <div>
                        <span class="text-sm text-gray-500">
                            Fecha de nacimiento
                        </span>

                        <p>
                            {{ $usuario->fecha_nacimiento
                                ? $usuario->fecha_nacimiento->format('d/m/Y')
                                : 'No registrada'
                            }}
                        </p>
                    </div>


                    <div>
                        <span class="text-sm text-gray-500">
                            Sexo
                        </span>

                        <p>
                            {{ $usuario->sexo ?? 'No registrado' }}
                        </p>
                    </div>


                    <div>
                        <span class="text-sm text-gray-500">
                            Identificación
                        </span>

                        <p>
                            {{ $usuario->identificacion ?? 'No registrada' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- ACCESO --}}

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                <h3 class="text-lg font-semibold mb-6">
                    Información de acceso
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <span class="text-sm text-gray-500">
                            Correo
                        </span>

                        <p>{{ $usuario->email }}</p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500">
                            Último acceso
                        </span>

                        <p>
                            {{ $usuario->ultimo_acceso
                                ? $usuario->ultimo_acceso->format('d/m/Y H:i')
                                : 'Nunca'
                            }}
                        </p>
                    </div>

                </div>


                @if($usuario->id !== auth()->id())

                    <div class="mt-6 pt-6 border-t">

                        <form
                            method="POST"
                            action="{{ route('usuarios.regenerar-password', $usuario) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md"
                            >
                                Generar nueva contraseña
                            </button>

                        </form>

                    </div>

                @endif

            </div>


            {{-- MAESTRO --}}

            @if($usuario->maestro)

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                    <h3 class="text-lg font-semibold mb-6">
                        Información del maestro
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <span class="text-sm text-gray-500">
                                Número de empleado
                            </span>

                            <p>
                                {{ $usuario->maestro->numero_empleado }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Especialidad
                            </span>

                            <p>
                                {{ $usuario->maestro->especialidad ?? 'No registrada' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Cédula profesional
                            </span>

                            <p>
                                {{ $usuario->maestro->cedula_profesional ?? 'No registrada' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Fecha de ingreso
                            </span>

                            <p>
                                {{ $usuario->maestro->fecha_ingreso
                                    ? $usuario->maestro->fecha_ingreso->format('d/m/Y')
                                    : 'No registrada'
                                }}
                            </p>
                        </div>

                    </div>

                </div>

            @endif


            {{-- ADMINISTRATIVO --}}

            @if($usuario->administrativo)

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                    <h3 class="text-lg font-semibold mb-6">
                        Información administrativa
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <span class="text-sm text-gray-500">
                                Número de empleado
                            </span>

                            <p>
                                {{ $usuario->administrativo->numero_empleado }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Puesto
                            </span>

                            <p>
                                {{ $usuario->administrativo->puesto }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Departamento
                            </span>

                            <p>
                                {{ $usuario->administrativo->departamento ?? 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </div>

            @endif


            {{-- TUTOR --}}

            @if($usuario->tutor)

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                    <h3 class="text-lg font-semibold mb-6">
                        Información del tutor
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <span class="text-sm text-gray-500">
                                Ocupación
                            </span>

                            <p>
                                {{ $usuario->tutor->ocupacion ?? 'No registrada' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Parentesco principal
                            </span>

                            <p>
                                {{ $usuario->tutor->parentesco_principal ?? 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </div>

            @endif


            {{-- ALUMNO --}}

            @if($usuario->alumno)

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">

                    <h3 class="text-lg font-semibold mb-6">
                        Información del alumno
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <span class="text-sm text-gray-500">
                                Matrícula
                            </span>

                            <p>
                                {{ $usuario->alumno->matricula }}
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500">
                                Número de Seguro Social
                            </span>

                            <p>
                                {{ $usuario->alumno->numero_seguro_social ?? 'No registrado' }}
                            </p>
                        </div>

                    </div>

                </div>

            @endif


            <div>

                <a
                    href="{{ route('usuarios.index') }}"
                    class="text-indigo-600 hover:text-indigo-900"
                >
                    ← Regresar a usuarios
                </a>

            </div>

        </div>

    </div>

</x-app-layout>