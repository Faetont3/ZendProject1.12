function Modal() {
    $('#modal').modal('show');
    $('#modal').on('shown.bs.modal', function () {
        $('#nome').focus();
    });
}


