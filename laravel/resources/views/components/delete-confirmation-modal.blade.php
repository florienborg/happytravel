<div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                ¿Quieres eliminar este elemento?
            </div>
            <div class="modal-footer">
            <form id="deleteForm" action="{{ route('happy_travel.destroy', $travel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger accept-button">Aceptar</button>
                </form>
                <button type="button" class="btn btn-secondary cancel-button" data-dismiss="modal">Cancelar</button>
                
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const deleteLink = document.getElementById('deleteLink');
    const deleteForm = document.getElementById('deleteForm');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    deleteLink.addEventListener('click', function(event) {
        event.preventDefault();

        
        const travelId = deleteLink.getAttribute('data-travel-id');
        console.log('travelId:', travelId);
        
        deleteModal.show();
        
        
        const actionUrl = `{{ route('happy_travel.destroy', ':id') }}`.replace(':id', travelId);
        deleteForm.setAttribute('action', actionUrl);


    });

    deleteForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const action = deleteForm.getAttribute('action');

        console.log('action:', action);
        fetch(action, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('happy_travel.index') }}";
            } else {
                console.error('Error al eliminar');
            }
        })
        .catch(error => {
            console.error('Error de red:', error);
            console.error(error.message)
        });
    });

    const cancelDeleteButton = document.querySelector('#deleteModal .btn-secondary');
    cancelDeleteButton.addEventListener('click', function() {
        window.location.href = "{{ route('happy_travel.show', $travel) }}";
    });
});

</script>
</div>