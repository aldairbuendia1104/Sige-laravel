<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Gestión de usuarios
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Administración de cuentas, roles y accesos del sistema.
                </p>
            </div>

            <a
                href="{{ route('usuarios.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
            >
                + Nuevo usuario
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- MENSAJES --}}

            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>

            @endif


            {{-- ERRORES --}}

            @if($errors->any())

                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FILTROS --}}

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6">

                <form
                    method="GET"
                    action="{{ route('usuarios.index') }}"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4"
                >

                    {{-- BUSCAR --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Buscar
                        </label>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Nombre, correo, identificación..."
                            class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                    </div>


                    {{-- ROL --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Rol
                        </label>

                        <select
                            name="rol"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                            <option value="">Todos los roles</option>

                            @foreach($roles as $rol)

                                <option
                                    value="{{ $rol->nombre }}"
                                    @selected(request('rol') === $rol->nombre)
                                >
                                    {{ $rol->nombre }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ESTADO --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Estado
                        </label>

                        <select
                            name="estado"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >

                            <option value="">Todos</option>

                            <option
                                value="activo"
                                @selected(request('estado') === 'activo')
                            >
                                Activos
                            </option>

                            <option
                                value="inactivo"
                                @selected(request('estado') === 'inactivo')
                            >
                                Inactivos
                            </option>

                        </select>

                    </div>


                    {{-- BOTÓN --}}

                    <div class="flex items-end">

                        <button
                            type="submit"
                            class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            Filtrar
                        </button>

                    </div>

                </form>

            </div>


            {{-- TABLA --}}

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                        <thead class="bg-gray-50 dark:bg-gray-700">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Usuario
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Identificación
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Correo
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Roles
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Estado
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Último acceso
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($usuarios as $usuario)

                                <tr>

                                    {{-- USUARIO --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="font-medium text-gray-900 dark:text-white">

                                            {{ $usuario->nombre }}
                                            {{ $usuario->apellido_paterno }}
                                            {{ $usuario->apellido_materno }}

                                        </div>

                                    </td>


                                    {{-- IDENTIFICACIÓN --}}

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">

                                        {{ $usuario->identificacion ?? '—' }}

                                    </td>


                                    {{-- CORREO --}}

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">

                                        {{ $usuario->email }}

                                    </td>


                                    {{-- ROLES --}}

                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap gap-1">

                                            @foreach($usuario->roles as $rol)

                                                <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800">

                                                    {{ $rol->nombre }}

                                                </span>

                                            @endforeach

                                        </div>

                                    </td>


                                    {{-- ESTADO --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if($usuario->activo)

                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                Activo
                                            </span>

                                        @else

                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                Inactivo
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ÚLTIMO ACCESO --}}

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">

                                        {{ $usuario->ultimo_acceso
                                            ? $usuario->ultimo_acceso->format('d/m/Y H:i')
                                            : 'Nunca'
                                        }}

                                    </td>


                                    {{-- ACCIONES --}}

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">

                                        <a
                                            href="{{ route('usuarios.show', $usuario) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('usuarios.edit', $usuario) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('usuarios.destroy', $usuario) }}"
                                            class="inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="{{ $usuario->activo
                                                    ? 'text-red-600 hover:text-red-900'
                                                    : 'text-green-600 hover:text-green-900'
                                                }}"
                                            >

                                                {{ $usuario->activo
                                                    ? 'Desactivar'
                                                    : 'Activar'
                                                }}

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-6 py-8 text-center text-gray-500"
                                    >
                                        No se encontraron usuarios.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINACIÓN --}}

                <div class="p-6">

                    {{ $usuarios->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>