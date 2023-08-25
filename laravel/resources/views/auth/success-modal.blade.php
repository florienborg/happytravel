<div class="modal" id="success-modal">
    <link href="{{ asset('css/modal.blade.css') }}" rel="stylesheet">
    <div class="text-modal">Registro correctamente</div>
    <button class="btn btn-primary" id="modalAceptarBtn">Aceptar</button>
    <button class="btn btn-secondary" id="showSuccessModalBtn" data-dismiss="modal" href="{{ route('register.custom') }}" >Cancelar</button>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalAceptarBtn = document.getElementById('modalAceptarBtn');

        modalAceptarBtn.addEventListener('click', function () {
            $('#success-modal').modal('hide'); 
        });

        const showSuccessModalBtn = document.getElementById('showSuccessModalBtn');

        showSuccessModalBtn.addEventListener('click', function () {
            $('#success-modal').modal('show'); 
        });
    });
</script>