<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Mostrar todos los grados.
     */
    public function index()
    {
        $grados = Grado::orderBy('orden')->get();

        return view('grados.index', compact('grados'));
    }

    /**
     * Mostrar formulario para crear un grado.
     */
    public function create()
    {
        return view('grados.create');
    }

    /**
     * Guardar un nuevo grado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:20|unique:grados,nombre',
            'orden' => 'required|integer|min:1|unique:grados,orden',
            'descripcion' => 'nullable|string',
        ]);

        Grado::create([
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('grados.index')
            ->with('success', 'Grado creado correctamente.');
    }

    /**
     * Mostrar un grado.
     */
    public function show(Grado $grado)
    {
        return view('grados.show', compact('grado'));
    }

    /**
     * Mostrar formulario para editar.
     */
    public function edit(Grado $grado)
    {
        return view('grados.edit', compact('grado'));
    }

    /**
     * Actualizar un grado.
     */
    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            'nombre' => 'required|string|max:20|unique:grados,nombre,' . $grado->id,
            'orden' => 'required|integer|min:1|unique:grados,orden,' . $grado->id,
            'descripcion' => 'nullable|string',
        ]);

        $grado->update([
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('grados.index')
            ->with('success', 'Grado actualizado correctamente.');
    }

    /**
     * Eliminar un grado.
     */
    public function destroy(Grado $grado)
    {
        $grado->delete();

        return redirect()
            ->route('grados.index')
            ->with('success', 'Grado eliminado correctamente.');
    }
}