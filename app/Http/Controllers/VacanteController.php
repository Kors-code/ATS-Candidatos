<?php
namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VacanteController extends Controller
{
    public function index()
    {
        $vacantes = Vacante::all();
        return view('vacantes.index', compact('vacantes'));
    }


    public function create()
    {
        return view('vacantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255|unique:vacantes,titulo',
            'descripcion' => 'required|string',
            'palabras_clave' => 'required|string',
        ]);

        Vacante::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'palabras_clave' => $request->palabras_clave,
            'slug' => Str::slug($request->titulo),
        ]);

        return redirect()->route('vacantes.index')->with('success', 'Vacante creada correctamente.');
    }

    public function show($slug)
    {
        $vacante = Vacante::where('slug', $slug)->firstOrFail();
        return view('vacantes.show', compact('vacante'));
    }
    public function edit($slug)
    {
        $vacante = Vacante::where('slug', $slug)->firstOrFail();
        return view('vacantes.edit', compact('vacante'));
    }
    public function update(Request $request, $slug)
    {
        $vacante = Vacante::where('slug', $slug)->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'palabras_clave' => 'required|string',
        ]);

        $vacante->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'palabras_clave' => $request->palabras_clave,
            'slug' => Str::slug($request->titulo),
        ]);

        return redirect()->route('vacantes.index')->with('success', 'Vacante actualizada correctamente.');
    }
    public function destroy($slug)
    {
        $vacante = Vacante::where('slug', $slug)->firstOrFail();
        $vacante->delete();

        return redirect()->route('vacantes.index')->with('success', 'Vacante eliminada correctamente.');
    }
}
