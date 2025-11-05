<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Area;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Mostrar listado de áreas (tarjetas de acceso a libros por área).
     */
    public function index()
    {
        $areas = Area::orderBy('nombre')->get();
        return view('libros.index', compact('areas'));
    }

    /**
     * Mostrar los libros de un área en particular (separados por grados si aplica).
     */
    public function porArea($id)
    {
        $area = Area::with('libros')->findOrFail($id);

        // Libros agrupados por grado (1° a 5° de secundaria)
        $librosPorGrado = [];
        for ($i = 1; $i <= 5; $i++) {
            $librosPorGrado[$i] = Libro::where('area_id', $id)
                ->where('grado', $i)
                ->orderBy('titulo')
                ->get();
        }

        // Libros sin división por grado
        $otrosLibros = Libro::where('area_id', $id)
            ->whereNull('grado')
            ->orderBy('titulo')
            ->get();

        return view('libros.por_area', compact('area', 'librosPorGrado', 'otrosLibros'));
    }

    /**
     * Formulario crear libro.
     */
    public function create()
    {

        $areas = Area::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre_categoria')->get();

        return view('libros.create', compact('areas', 'categorias'));
    }

    /**
     * Guardar libro nuevo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'autor'         => 'required|string|max:255',
            'codigo_libro'  => 'required|string|max:255|unique:libros,codigo_libro',
            'editorial'     => 'nullable|string|max:255',
            'categoria_id'  => 'nullable|exists:categorias,id',
            'estado'        => 'required|in:disponible,prestado,dañado',
            'ubicacion'     => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'anio'          => 'nullable|digits:4',
            'grado'         => 'nullable|string|max:50',
            'area_id'       => 'required|exists:areas,id',
            'pdf'           => 'nullable|file|mimes:pdf|max:20480', // 20MB
        ]);

        $data = $request->except('pdf');

        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('libros', 'public');
        }

        Libro::create($data);

        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }

    /**
     * Ver detalle de un libro.
     */
    public function show(Libro $libro)
    {
        $libro->load(['area', 'categoria']);
        return view('libros.show', compact('libro'));
    }

    /**
     * Descargar o abrir PDF de un libro.
     */
    public function descargarPDF(Libro $libro)
    {
        if (!$libro->pdf || !Storage::disk('public')->exists($libro->pdf)) {
            return back()->with('error', 'El archivo PDF no está disponible.');
        }

        return response()->file(storage_path('app/public/' . $libro->pdf));
        // return Storage::disk('public')->download($libro->pdf);
    }

    /**
     * Formulario edición de libro.
     */
    public function edit(Libro $libro)
    {
        $areas = Area::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre_categoria')->get();

        return view('libros.edit', compact('libro', 'areas', 'categorias'));
    }

    /**
     * Actualizar libro existente.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'autor'         => 'required|string|max:255',
            'codigo_libro'  => 'required|string|max:255|unique:libros,codigo_libro,' . $libro->id,
            'editorial'     => 'nullable|string|max:255',
            'categoria_id'  => 'nullable|exists:categorias,id',
            'estado'        => 'required|in:disponible,prestado,dañado',
            'ubicacion'     => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'anio'          => 'nullable|digits:4',
            'grado'         => 'nullable|string|max:50',
            'area_id'       => 'required|exists:areas,id',
            'pdf'           => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $data = $request->except('pdf');

        if ($request->hasFile('pdf')) {
            if ($libro->pdf && Storage::disk('public')->exists($libro->pdf)) {
                Storage::disk('public')->delete($libro->pdf);
            }
            $data['pdf'] = $request->file('pdf')->store('libros', 'public');
        }

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Eliminar libro.
     */
    public function destroy(Libro $libro)
    {
        // Eliminar PDF si existe
        if ($libro->pdf && Storage::disk('public')->exists($libro->pdf)) {
            Storage::disk('public')->delete($libro->pdf);
        }

        $libro->delete();

        return redirect()->back()->with('success', 'Libro eliminado correctamente.');
    }
}
