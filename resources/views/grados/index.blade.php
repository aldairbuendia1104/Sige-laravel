<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Grados
            </h2>

            <a href="{{ route('grados.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + Nuevo grado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">

                <table class="w-full">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left">Orden</th>
                            <th class="px-6 py-3 text-left">Nombre</th>
                            <th class="px-6 py-3 text-left">Descripción</th>
                            <th class="px-6 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($grados as $grado)
                            <tr class="border-t dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $grado->orden }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {{ $grado->nombre }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $grado->descripcion ?? 'Sin descripción' }}
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">

                                    <a href="{{ route('grados.show', $grado) }}"
                                       class="text-blue-600 hover:underline">
                                        Ver
                                    </a>

                                    <a href="{{ route('grados.edit', $grado) }}"
                                       class="text-yellow-600 hover:underline">
                                        Editar
                                    </a>

                                    <form action="{{ route('grados.destroy', $grado) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar este grado?')"
                                                class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center">
                                    No hay grados registrados.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>