function remover(id, handler) {
    $(document).ready(function () {
        var tr = $(handler).closest('tr');
        if (confirm("Realmente quer excluir ??") == true) {
            $.ajax({
                url: 'remover',
                type: 'POST',
                data: {id: id},
                dataType: "json",
                success: function (result) {
                    alert(result['mensagem']);
                    tr.fadeOut(400, function () {
                        tr.remove();
                    });
                    return false;
                }
            });
        } else {
        }
    });
}



