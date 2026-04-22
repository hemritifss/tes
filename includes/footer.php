        </div><!-- /.container -->
    </main>

    <?php if (!isset($active_page) || $active_page !== 'index'): ?>
    <!-- Global Footer -->
    <footer class="global-footer">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <span class="footer-brand">UniClubs</span>
                <p>© 2024 UniClubs — Plateforme de gestion de clubs universitaires</p>
                <p>Fait avec ❤️ pour les étudiants</p>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url ?? '/' ?>js/global.js"></script>
</body>
</html>
