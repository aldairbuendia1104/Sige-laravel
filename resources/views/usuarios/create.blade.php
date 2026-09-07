<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Crear usuario
        </h2>

    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('usuarios.store') }}"
                class="space-y-6"
            >

                @csrf


                {{-- DATOS PERSONALES --}}

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        Datos personales
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium">Nombre *</label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium">Apellido paterno *</label>

                            <input
                                type="text"
                                name="apellido_paterno"
                                value="{{ old('apellido_paterno') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('apellido_paterno')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium">Apellido materno</label>

                            <input
                                type="text"
                                name="apellido_materno"
                                value="{{ old('apellido_materno') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label class="block text-sm font-medium">Correo electrónico *</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium">Teléfono</label>

                            <input
                                type="text"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label class="block text-sm font-medium">CURP</label>

                            <input
                                type="text"
                                name="curp"
                                value="{{ old('curp') }}"
                                maxlength="18"
                                class="mt-1 block w-full rounded-md border-gray-300 uppercase"
                            >
                        </div>


                        <div>
                            <label class="block text-sm font-medium">
                                Fecha de nacimiento
                            </label>

                            <input
                                type="date"
                                name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>


                        <div>
                            <label class="block text-sm font-medium">
                                Sexo
                            </label>

                            <select
                                name="sexo"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                                <option value="">Seleccionar</option>

                                <option value="Masculino">Masculino</option>

                                <option value="Femenino">Femenino</option>

                                <option value="Otro">Otro</option>

                            </select>

                        </div>


                        <div>
                            <label class="block text-sm font-medium">
                                Identificación / matrícula
                            </label>

                            <input
                                type="text"
                                name="identificacion"
                                value="{{ old('identificacion') }}"
                                placeholder="Ej. EMP-00001"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>

                </div>


                {{-- ROLES --}}

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Roles y permisos
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Un usuario puede tener uno o varios roles.
                    </p>


                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        @foreach($roles as $rol)

                            <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer hover:bg-gray-50">

                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $rol->id }}"
                                    class="rounded border-gray-300 text-indigo-600"
                                    onchange="mostrarCamposRoles()"
                                    {{ in_array($rol->id, old('roles', [])) ? 'checked' : '' }}
                                >

                                <span class="font-medium">
                                    {{ $rol->nombre }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                    @error('roles')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror

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
                                value="{{ old('numero_empleado') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Especialidad</label>

                            <input
                                type="text"
                                name="especialidad"
                                value="{{ old('especialidad') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Cédula profesional</label>

                            <input
                                type="text"
                                name="cedula_profesional"
                                value="{{ old('cedula_profesional') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Fecha de ingreso</label>

                            <input
                                type="date"
                                name="fecha_ingreso"
                                value="{{ old('fecha_ingreso') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Tipo de contratación</label>

                            <input
                                type="text"
                                name="tipo_contratacion"
                                value="{{ old('tipo_contratacion') }}"
                                placeholder="Ej. Base, Interino..."
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
                                value="{{ old('numero_empleado_admin') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Puesto *</label>

                            <input
                                type="text"
                                name="puesto"
                                value="{{ old('puesto') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Departamento</label>

                            <input
                                type="text"
                                name="departamento"
                                value="{{ old('departamento') }}"
                                placeholder="Control escolar..."
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Extensión</label>

                            <input
                                type="text"
                                name="extension"
                                value="{{ old('extension') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Fecha de ingreso</label>

                            <input
                                type="date"
                                name="fecha_ingreso_admin"
                                value="{{ old('fecha_ingreso_admin') }}"
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
                                value="{{ old('ocupacion') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Parentesco principal</label>

                            <input
                                type="text"
                                name="parentesco_principal"
                                value="{{ old('parentesco_principal') }}"
                                placeholder="Padre, Madre, Tutor legal..."
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
                                value="{{ old('matricula') }}"
                                placeholder="Ej. ALU-000001"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Número de Seguro Social</label>

                            <input
                                type="text"
                                name="numero_seguro_social"
                                value="{{ old('numero_seguro_social') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label>Fecha de ingreso</label>

                            <input
                                type="date"
                                name="fecha_ingreso_alumno"
                                value="{{ old('fecha_ingreso_alumno') }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>

                </div>


                {{-- CONTRASEÑA --}}

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">

                    <h3 class="font-semibold text-blue-900">
                        Contraseña de acceso
                    </h3>

                    <p class="text-sm text-blue-800 mt-2">
                        SIGE generará automáticamente una contraseña segura.
                        El Director podrá verla después de crear la cuenta.
                        El usuario no podrá modificarla.
                    </p>

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
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                    >
                        Crear usuario
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- JAVASCRIPT --}}

    <script>

        function mostrarCamposRoles()
        {
            const checkboxes = document.querySelectorAll(
                'input[name="roles[]"]:checked'
            );

            const roles = Array.from(checkboxes)
                .map(checkbox => checkbox.value);

            const nombresRoles = @json(
                $roles->pluck('nombre', 'id')
            );

            document
                .getElementById('campos-maestro')
                .classList
                .add('hidden');

            document
                .getElementById('campos-administrativo')
                .classList
                .add('hidden');

            document
                .getElementById('campos-tutor')
                .classList
                .add('hidden');

            document
                .getElementById('campos-alumno')
                .classList
                .add('hidden');


            roles.forEach(id => {

                const nombre = nombresRoles[id];

                if (nombre === 'Maestro') {
                    document
                        .getElementById('campos-maestro')
                        .classList
                        .remove('hidden');
                }

                if (nombre === 'Administrativo') {
                    document
                        .getElementById('campos-administrativo')
                        .classList
                        .remove('hidden');
                }

                if (nombre === 'Tutor') {
                    document
                        .getElementById('campos-tutor')
                        .classList
                        .remove('hidden');
                }

                if (nombre === 'Alumno') {
                    document
                        .getElementById('campos-alumno')
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