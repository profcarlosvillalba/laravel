<form action="{{ route('vehiculos.index') }}" method="GET" autocomplete="on" role="search">
    <div class="form-row mb-3">
        <div class="form-group col-md-3">
            <label for="desde">Desde</label>
            <input type="date" name="desde" id="desde" class="form-control" value="{{ request('desde') }}">
        </div>

        <div class="form-group col-md-3">
            <label for="hasta">Hasta</label>
            <input type="date" name="hasta" id="hasta" class="form-control" value="{{ request('hasta') }}">
        </div>

        <div class="form-group col-md-3">
            <label for="modelo_id">Modelo</label>
            <select name="modelo_id" id="modelo_id" class="form-control">
                <option value="">-- Todos los modelos --</option>
                @foreach ($modelos as $modelo)
                    <option value="{{ $modelo->id }}" {{ request('modelo_id') == $modelo->id ? 'selected' : '' }}>
                        {{ $modelo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-3 d-flex align-items-end">
            <div class="btn-group" role="group" aria-label="Acciones">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>

                <a href="{{ route('vehiculos.exportPdf', [], false)
                    . '?desde=' . request('desde')
                    . '&hasta=' . request('hasta')
                    . '&modelo_id=' . request('modelo_id') }}"
                    class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>

                <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-eraser"></i> Limpiar
                </a>
            </div>
        </div>
    </div>
</form>
