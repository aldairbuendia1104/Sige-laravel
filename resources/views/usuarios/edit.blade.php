<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar usuario
        </h2>

    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('usuarios.update', $usuario) }}"
                class="space-y-6"
            >

                @csrf

                @method('PUT')


                {{-- DATOS PERSONALES --}}

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">

                    <h3 class="text-lg font-semibold mb-6">
                        Datos personales
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label>Nombre *</label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre', $usuario->nombre) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Apellido paterno *</label>

                            <input
                                type="text"
                                name="apellido_paterno"
                                value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Apellido materno</label>

                            <input
                                type="text"
                                name="apellido_materno"
                                value="{{ old('apellido_materno', $usuario->apellido_materno) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Correo electrónico *</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $usuario->email) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Teléfono</label>

                            <input
                                type="text"
                                name="telefono"
                                value="{{ old('telefono', $usuario->telefono) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>CURP</label>

                            <input
                                type="text"
                                name="curp"
                                value="{{ old('curp', $usuario->curp) }}"
                                maxlength="18"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Fecha de nacimiento</label>

                            <input
                                type="date"
                                name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', optional($usuario->fecha_nacimiento)->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label>Sexo</label>

                            <select
                                name="sexo"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                                <option value="">Seleccionar</option>

                                <option
                                    value="Masculino"
                                    @selected($usuario->sexo === 'Masculino')
                                >
                                    Masculino
                                </option>

                                <option
                                    value="Femenino"
                                    @selected($usuario->sexo === 'Femenino')
                                >
                                    Femenino
                                </option>

                                <option
                                    value="Otro"
                                    @selected($usuario->sexo === 'Otro')
                                >
                                    Otro
                                </option>

                            </select>

                        </div>


                        <div>
                            <label>Identificación</label>

                            <input
                                type="text"
                                name="identificacion"
                                value="{{ old('identificacion', $usuario->identificacion) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>

                </div>


                {{-- ROLES --}}

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">

                    <h3 class="text-lg font-semibold mb-2">
                        Roles
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Puedes asignar varios roles al mismo usuario.
                    </p>


                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        @foreach($roles as $rol)

                            <label class="flex items-center gap-3 p-4 border rounded-lg">

                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $rol->id }}"
                                    onchange="mostrarCamposRoles()"
                                    @checked($usuario->roles->contains('id', $rol->id))
                                >

                                <span>
                                    {{ $rol->nombre }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                </div>


                {{-- MAESTRO --}}

                <div
                    id="campos-maestro"
                    class="hidden bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6"
                >

                    <h3 class="text-lg font-semibold mb-6">
                        Información del maestro
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label>Número de empleado</label>

                            <input
                                type="text"
                                name="numero_empleado"
                                value="{{ old('numero_empleado', optional($usuario->maestro)->numero_empleado) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Especialidad</label>

                            <input
                                type="text"
                                name="especialidad"
                                value="{{ old('especialidad', optional($usuario->maestro)->especialidad) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Cédula profesional</label>

                            <input
                                type="text"
                                name="cedula_profesional"
                                value="{{ old('cedula_profesional', optional($usuario->maestro)->cedula_profesional) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Fecha de ingreso</label>

                            <input
                                type="date"
                                name="fecha_ingreso"
                                value="{{ old('fecha_ingreso', optional($usuario->maestro?->fecha_ingreso)->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Tipo de contratación</label>

                            <input
                                type="text"
                                name="tipo_contratacion"
                                value="{{ old('tipo_contratacion', optional($usuario->maestro)->tipo_contratacion) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                    </div>

                </div>


                {{-- ADMINISTRATIVO --}}

                <div
                    id="campos-administrativo"
                    class="hidden bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6"
                >

                    <h3 class="text-lg font-semibold mb-6">
                        Información administrativa
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label>Número de empleado</label>

                            <input
                                type="text"
                                name="numero_empleado_admin"
                                value="{{ old('numero_empleado_admin', optional($usuario->administrativo)->numero_empleado) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Puesto</label>

                            <input
                                type="text"
                                name="puesto"
                                value="{{ old('puesto', optional($usuario->administrativo)->puesto) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Departamento</label>

                            <input
                                type="text"
                                name="departamento"
                                value="{{ old('departamento', optional($usuario->administrativo)->departamento) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Extensión</label>

                            <input
                                type="text"
                                name="extension"
                                value="{{ old('extension', optional($usuario->administrativo)->extension) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                    </div>

                </div>


                {{-- TUTOR --}}

                <div
                    id="campos-tutor"
                    class="hidden bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6"
                >

                    <h3 class="text-lg font-semibold mb-6">
                        Información del tutor
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label>Ocupación</label>

                            <input
                                type="text"
                                name="ocupacion"
                                value="{{ old('ocupacion', optional($usuario->tutor)->ocupacion) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Parentesco principal</label>

                            <input
                                type="text"
                                name="parentesco_principal"
                                value="{{ old('parentesco_principal', optional($usuario->tutor)->parentesco_principal) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                    </div>

                </div>


                {{-- ALUMNO --}}

                <div
                    id="campos-alumno"
                    class="hidden bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6"
                >

                    <h3 class="text-lg font-semibold mb-6">
                        Información del alumno
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label>Matrícula</label>

                            <input
                                type="text"
                                name="matricula"
                                value="{{ old('matricula', optional($usuario->alumno)->matricula) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>


                        <div>

                            <label>Número de Seguro Social</label>

                            <input
                                type="text"
                                name="numero_seguro_social"
                                value="{{ old('numero_seguro_social', optional($usuario->alumno)->numero_seguro_social) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                    </div>

                </div>


                {{-- BOTONES --}}

                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('usuarios.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-md"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md"
                    >
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>


    <script>

        function mostrarCamposRoles()
        {
            const roles = Array.from(
                document.querySelectorAll(
                    'input[name="roles[]"]:checked'
                )
            ).map(
                checkbox => checkbox.value
            );

            const nombresRoles = @json(
                $roles->pluck('nombre', 'id')
            );


            [
                'maestro',
                'administrativo',
                'tutor',
                'alumno'
            ].forEach(nombre => {

                document
                    .getElementById('campos-' + nombre)
                    .classList
                    .add('hidden');

            });


            roles.forEach(id => {

                const nombre = nombresRoles[id];

                if (
                    [
                        'Maestro',
                        'Administrativo',
                        'Tutor',
                        'Alumno'
                    ].includes(nombre)
                ) {

                    document
                        .getElementById(
                            'campos-' + nombre.toLowerCase()
                        )
                        .classList
                        .remove('hidden');

                }

            });
        }


        document.addEventListener(
            'DOMContentLoaded',
            mostrarCamposRoles
        );

    </script>

</x-app-layout>