<?php

namespace App\Http\Controllers;


use App\Models\Evento;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
     private $rules = [
        'nombre' => 'required|string|max:100',
        'descripcion' => 'required|string|max:250',
        'municipio' => 'nullable|string|max:100',
        'departamento' => 'nullable|string|max:100',
        'id_artista' => 'nullable|integer|exists:artista,id',
    ];

    public function index()
    {
        $eventos = Evento::with('Artista')->get();
        return view('evento.index', compact('eventos'));
    }

    public function create()
    {
        $artistas = Artista::all();
        return view('evento.create', compact('artistas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return redirect()->route('evento.create')->withInput()->withErrors($validator->errors());
        }

        Evento::create($request->only([
            'nombre','descripcion','fecha_inicio','fecha_fin','municipio','departamento','id_artista'
        ]));

        session()->flash('message', 'Evento creado exitosamente');
        return redirect()->route('evento.index');
    }

    public function edit(string $id)
    {
        $evento = Evento::find($id);
        if (! $evento) {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('evento.index');
        }
        $artistas = Artista::all();
        return view('evento.edit', compact('evento','artistas'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return redirect()->route('evento.edit', $id)->withInput()->withErrors($validator->errors());
        }

        $evento = Evento::find($id);
        if (! $evento) {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('evento.index');
        }

        $evento->update($request->only([
            'nombre','descripcion','fecha_inicio','fecha_fin','municipio','departamento','id_artista'
        ]));

        session()->flash('message', 'Registro actualizado exitosamente');
        return redirect()->route('evento.index');
    }

    public function destroy(string $id)
    {
        $evento = Evento::find($id);
        if ($evento) {
            $evento->delete();
            session()->flash('message', 'Registro eliminado exitosamente');
        } else {
            session()->flash('warning', 'No se encuentra el registro solicitado');
        }
        return redirect()->route('evento.index');
    }
}
