<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtistaController extends Controller
{
    private $rules = [
        'nombre' => 'required|string|min:3|max:100',
        'genero' => 'required|string|min:3|max:100',
        'ciudad_origen' => 'required|string|min:3|max:100'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artistas = Artista::all();
        return view('artista.index', compact('artistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('artista.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return redirect()->route('artista.create')->withInput()->withErrors($errors);
        }
        $artista = Artista::create($request->all());
        session()->flash('message', 'Artista creado exitosamente');
        return redirect()->route('artista.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $artista = Artista::find($id);
        if($artista) //si existe
        {
            return view('artista.edit', compact('artista'));
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('artista.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return redirect()->route('artista.edit', $id)->withInput()->withErrors($errors);
        }
        
        $artista = Artista::find($id);
        if($artista) //si existe
        {
            $artista->update($request->all());
            session()->flash('message', 'Registro actualizado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('artista.index');
        }

        return redirect()->route('artista.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artista = Artista::find($id);
        if($artista) //si existe
        {
            $artista->delete();
            session()->flash('message', 'Registro eliminado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('artista.index');
        }
        
        return redirect()->route('artista.index');
    }
}
