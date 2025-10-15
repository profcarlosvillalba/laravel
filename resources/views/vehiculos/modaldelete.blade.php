<div class="modal fade" id="modal-delete-{{ $vehiculo->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel-{{ $vehiculo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalDeleteLabel-{{ $vehiculo->id }}">
                    <i class="fa fa-exclamation-triangle"></i> Confirmar eliminación
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el vehículo <strong>{{ $vehiculo->patente }}</strong>?</p>
                <p class="text-muted mb-0"><small>Esta acción no se puede deshacer.</small></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-close"></i> Cancelar
                </button>
                
                <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>