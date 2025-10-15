@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex w-100 align-items-center">
                        <span>Vehículos</span>
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-success btn-sm ms-auto">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>  
                        
                                                
                       


                    </div>
                </div>


                

                <div class="card-body">
                    @include('vehiculos.busqueda')
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover" id="tablaDetalle">
                        <thead>
                            <tr>
                                <th>Patente</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Fecha de Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->patente }}</td>
                                    <td>{{ $vehiculo->modelo->marca->nombre }}</td>
                                    <td>{{ $vehiculo->modelo->nombre }}</td>
                                    <td>{{ $vehiculo->created_at->format('d/m/Y') }}</td>
                                    <td>
                               
                                        {{-- Botón Ver Detalle --}}
                                        <button 
                                            type="button" 
                                            class="btn btn-info btn-sm"
                                            title="Ver detalle"
                                            data-toggle="modal"
                                            data-target="#modal-show-{{ $vehiculo->id }}">
                                            <i class="fa fa-eye"></i> Ver detalle
                                        </button>


                                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                      
                                        <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#modal-delete-{{ $vehiculo->id }}">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>

                                    </td>                                    
                                </tr>
                                @include('vehiculos.modalshow')
                                @include('vehiculos.modaldelete')
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
<script>
    $(document).ready(function() {
        console.log("jQuery listo!");

        $('#tablaDetalle').DataTable({
            "language":{
                "info":"_TOTAL_ registros",
                "search": "Buscar",
                "paginate": {
                    "next":"Siguiente",
                    "previous":"Anterior"
                },
                "lengthMenu":'Mostrar <select>'+
                    '<option value="5">5</option>'+
                    '<option value="10">10</option>'+
                    '<select> registros',
                "loadingRecords":"Cargando...",
                "processing":"Procesando...",
                "emptyTable":"No hay datos",
                "zeroRecords":"No hay coincidencias",
                "infoEmpty":"",
                "infoFiltered":""
            }
        });
    });
</script>
@endpush

