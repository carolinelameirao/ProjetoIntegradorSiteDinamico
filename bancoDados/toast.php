<?php if (isset($_GET['status']) && $_GET['status'] != NULL) : ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast bg-primary">
            <div class="toast-header">
                <strong class="me-auto">Cadastro</strong>
                <small>Cliente</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Cadastro com sucesso
            </div>
        </div>
    </div>

    <!-- arrow function -->
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl)
        });

        toastList.forEach(toast => toast.show());
    </script>

<?php endif; ?>