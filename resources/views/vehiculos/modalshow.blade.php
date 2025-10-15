<div class="modal fade" id="modal-show-{{ $vehiculo->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel-{{ $vehiculo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            {{-- Cabecera del modal --}}
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalLabel-{{ $vehiculo->id }}">
                    <i class="fa fa-car"></i> Detalles del Vehículo
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Cuerpo del modal --}}
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Patente:</strong> {{ $vehiculo->patente }}</li>
                    <li class="list-group-item"><strong>Marca:</strong> {{ $vehiculo->modelo->marca->nombre }}</li>
                     <li class="list-group-item"><strong>Imagen:</strong> <img src="{{ asset($vehiculo->imagen) }}" alt="Imagen de {{ $vehiculo->patente }}" class="img-fluid"></li>
                    <li class="list-group-item"><strong>Modelo:</strong> {{ $vehiculo->modelo->nombre }}</li>
                    
                    <li class="list-group-item"><strong>Fecha de Alta:</strong> {{ $vehiculo->created_at->format('d/m/Y H:i') }}</li>
                </ul>
            </div>

            {{-- Pie del modal --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-close"></i> Cerrar
                </button>
            </div>

        </div>
    </div>
</div>
