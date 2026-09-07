<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar grado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('grados.update', $grado) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            value="{{ old('nombre', $grado->nombre) }}"
                            required
                            class="w-full rounded-md border-gray-300"
                        >

                        @error('nombre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            Orden
                        </label>

                        <input
                            type="number"
                            name="orden"
                            value="{{ old('orden', $grado->orden) }}"
                            required
                            min="1"
                            class="w-full rounded-md border-gray-300"
                        >

                        @error('orden')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            rows="4"
                            class="w-full rounded-md border-gray-300"
                        >{{ old('descripcion', $grado->descripcion) }}</textarea>

                        @error('descripcion')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">

                        <a href="{{ route('grados.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-md">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md">
                            Actualizar grado
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>