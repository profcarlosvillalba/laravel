@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex w-100  align-items-center">
                        <span>Tareas </span>
                        @can('crear tareas')
                            <a href="{{ route('tareas.create') }}" class="btn btn-success btn-sm ms-auto"> <i class="fas fa-plus"> Nuevo</i></a>                            
                        @endcan
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
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->id }}</td>
                                    <td>{{ $tarea->nombre }}</td>
                                    <td>
                                        @can('editar tareas')
                                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"> Editar</i></a>
                                        @endcan
                                        @can('borrar tareas')
                                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro de eliminar esta tarea?')">
                                                    <i class="fas fa-trash"> Eliminar</i>
                                                </button>   
                                            </form>   
                                        @endcan
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
  <script>
    $(document).ready(function() {
      console.log("jQuery listo!");
    });


    $(document).ready(function() {
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
        } );
</script>
@endpush


