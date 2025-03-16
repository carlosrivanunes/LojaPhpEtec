$('#delete-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botão que acionou o modal
    var id = button.data('tablet'); // Extraindo o ID do data-tablet

    // Debugging: Verificando se o ID está correto
    console.log('ID do Tablet:', id);
    
    var modal = $(this);
    modal.find('.modal-title').text('Excluir Tablet #' + id); // Atualiza o título do modal
    modal.find('#delete-id').val(id); // Define o valor do campo oculto com o ID do tablet
});
