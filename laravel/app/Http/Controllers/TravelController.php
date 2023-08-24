<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travels = Travel::all();

        return view('index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Agrega validación para la imagen
            'description' => 'required'
        ]); 
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Guarda la imagen en la carpeta public/images
            $imagePath = 'images/' . $imageName;
        }
    
        Travel::create([
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imagePath ?? null, // Si hay una imagen, guarda la ruta en la base de datos
            'description' => $request->description
        ]);
    
        return redirect()->route('happy_travel.index')->with('success', '¡Destino agregado exitosamente!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $travel = Travel::findOrFail($id);
    return view('show', compact('travel'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
{
    // Verifica si el usuario actual es el propietario de la tarjeta
    if ($travel->user_id === auth()->user()->id) {
        return view('edit', compact('travel'));
    } else {
        return redirect()->route('travel.show', $travel->id)->with('error', 'No tienes permiso para editar esta tarjeta.');
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $travel = Travel::findOrFail($id)->delete();

    return redirect()->route('happy_travel.index')->with('success', '¡Destino eliminado exitosamente!');
}
}
