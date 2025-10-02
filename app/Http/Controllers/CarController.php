<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Modelo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $modelos = Modelo::all();
    $desde = $request->desde;
    $hasta = $request->hasta;
    $modelo_id = $request->modelo_id;
    if(count($request->all()) > 0) {
        $sql = Car::with('modelo.marca');
        if($modelo_id) {
            $sql = $sql->where('modelo_id', $modelo_id);
        }
        if($desde) {
            $sql = $sql->whereDate('created_at', '>=', $desde);
        }
        if($hasta) {
            $sql = $sql->whereDate('created_at', '<=', $hasta);
        }
        $vehiculos = $sql
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $vehiculos = Car::with('modelo.marca')
            ->orderBy('created_at', 'desc')
            ->get();
        $modelo_id = null;
        $desde = null;
        $hasta = null;
    }
    return view('vehiculos.index', compact('vehiculos',
     'modelos',
     'modelo_id',
     'desde',
     'hasta'
    ));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $vehiculo = new Car;
        $vehiculo->patente = $request->input('patente');
        $vehiculo->marca = $request->input('marca');
        $vehiculo->modelo = $request->input('modelo');
        $vehiculo->imagen = ''; 

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');
            $vehiculo->imagen = '/storage/' . $filePath;
            $vehiculo->save();
        }

        return redirect()->route('vehiculos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
