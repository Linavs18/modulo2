<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocalidadController extends Controller
{
    private $rules = [
        'nombre' => 'required|string|min:3|max:100',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $localidades = Localidad::all();
        return view('localidad.index', compact('localidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('localidad.create');
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
            return redirect()->route('localidad.create')->withInput()->withErrors($errors);
        }
        
        Localidad::create($request->only(['nombre']));
        session()->flash('message', 'Localidad creada exitosamente');
        return redirect()->route('localidad.index');
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
         $localidad = Localidad::find($id);
        if($localidad) //si existe
        {
            return view('localidad.edit', compact('localidad'));
        }
        else
        {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
            return redirect()->route('localidad.index');
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
            return redirect()->route('localidad.edit', $id)->withInput()->withErrors($errors);
        }
        
        $localidad = Localidad::find($id);
        if($localidad) //si existe
        {
            $localidad->update($request->only(['nombre']));
            session()->flash('message', 'Localidad actualizada exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
            return redirect()->route('localidad.index');
        }

        return redirect()->route('localidad.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $localidad = Localidad::find($id);
        if($localidad) //si existe
        {
            $localidad->delete();
            session()->flash('message', 'Localidad eliminada exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra la localidad solicitada');
            return redirect()->route('localidad.index');
        }
        
        return redirect()->route('localidad.index');
    }
}
