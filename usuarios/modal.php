<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="deleteModalLabel">Confirmação de Exclusão</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-body-text">Tem certeza que deseja excluir este item?</p>
            </div>
            <div class="modal-footer">
                <form id="delete-form" action="delete.php" method="GET">
                    <input type="hidden" name="id" id="delete-id" value="">
                    <button type="submit" class="btn btn-outline-dark btn-lg mt-3 btn-color me-4">
                        <i class="fa-solid fa-trash"></i> Excluir
                    </button>
                    <button type="button" class="btn btn-outline-dark btn-lg mt-3 btn-color me-4" data-bs-dismiss="modal">
                        <i class="fa-solid fa-arrow-left"></i> Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para configurar o modal com os dados do item a ser excluído
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('delete-modal');
        var deleteIdInput = document.getElementById('delete-id');
        var modalBodyText = document.getElementById('modal-body-text');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var itemId = button.getAttribute('data-id'); // ID do item
            var itemType = button.getAttribute('data-type'); // Tipo de item: cliente, usuário, livro

            // Define o texto do corpo do modal dinamicamente com base no tipo de item
            modalBodyText.textContent = `Deseja mesmo excluir este ${itemType.toLowerCase()} (${itemId})?`;
            deleteIdInput.value = itemId;
        });
    });
</script>