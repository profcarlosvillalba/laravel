<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Modelo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CarController extends Controller
{
    
    public function exportPDF(Request $request)
{
    $desde = $request->input('desde');
    $hasta = $request->input('hasta');
    $modelo_id = $request->input('modelo_id');
    $query = Car::with('modelo.marca');
    if ($desde && $hasta) {
        $query->whereDate('created_at', '>=', $desde)
              ->whereDate('created_at', '<=', $hasta);
    }
    if ($modelo_id) {
        $query->where('modelo_id', $modelo_id);
        $modelo = Modelo::find($modelo_id);
    }
    else{
        $modelo = null;
    }
    $vehiculos = $query->orderBy('created_at', 'desc')->get();
    $pdf = Pdf::loadView('vehiculos.pdf', compact('vehiculos', 'modelo', 'desde', 'hasta'))
              ->setPaper('a4', 'landscape');
    return $pdf->download('vehiculos.pdf');
}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
{
    $modelos = Modelo::all();
    $vehiculos = Car::with('modelo.marca');
    if ($request->filled('modelo_id')) {
        $vehiculos = $vehiculos->where('modelo_id', $request->modelo_id);
    }
    if ($request->filled('desde')) {
        $vehiculos = $vehiculos->whereDate('created_at', '>=', $request->desde);
    }
    if ($request->filled('hasta')) {
        $vehiculos = $vehiculos->whereDate('created_at', '<=', $request->hasta);
    }
    $vehiculos = $vehiculos->orderBy('created_at', 'desc')->get();
    if ($request->has('pdf')) {
        return $this->exportPDF($request);
    }
    return view('vehiculos.index', [
        'vehiculos' => $vehiculos,
        'modelos' => $modelos,
        'modelo_id' => $request->modelo_id,
        'desde' => $request->desde,
        'hasta' => $request->hasta,
    ]);
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
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');

    }
}                     
