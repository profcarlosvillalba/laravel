@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex w-100  align-items-center">
                        <span>Vehiculos </span>
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-success btn-sm ms-auto"> <i class="fas fa-plus"> Nuevo</i></a>                            
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table" id="tablaDetalle">
                        <thead>
                            <tr>
                                <th>Patente</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->patente }}</td>
                                    <td>{{ $vehiculo->marca }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td>
                                        <a href="{{ route('tareas.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"> Editar</i></a>
                                        <form action="{{ route('tareas.destroy', $vehiculo->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro de eliminar esta tarea?')">
                                                <i class="fas fa-trash"> Eliminar</i>
                                            </button>   
                                        </form>     
                                    </td>                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> 

            </div>
        </div>
    </div>        
</div>


@endsection
@push('scripts')     
 
@endpush


