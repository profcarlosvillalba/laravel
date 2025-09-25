@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Nuevo Vehiculo') }}</div>

                <div class="card-body">
                    <form action="{{ route('vehiculos.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Patente</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Marca</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Modelo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Imagen</label>
                            <input type="file" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Vehiculo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
