<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Información del grado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <div class="mb-4">
                    <p class="text-sm text-gray-500">
                        Nombre
                    </p>

                    <p class="text-lg font-semibold">
                        {{ $grado->nombre }}
                    </p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">
                        Orden
                    </p>

                    <p class="text-lg">
                        {{ $grado->orden }}
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500">
                        Descripción
                    </p>

                    <p>
                        {{ $grado->descripcion ?? 'Sin descripción' }}
                    </p>
                </div>

                <div class="flex gap-3">

                    <a href="{{ route('grados.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded-md">
                        Volver
                    </a>

                    <a href="{{ route('grados.edit', $grado) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-md">
                        Editar
                    </a>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>