$('#delete-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que abriu o modal
    var id = button.data('customer'); // Extraindo o ID do data attribute
    
    var modal = $(this);
    modal.find('.modal-title').text('Excluir Cliente #' + id); // Atualiza o título do modal
    modal.find('#delete-id').val(id); // Preenche o campo oculto com o ID
});
