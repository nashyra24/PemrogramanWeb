<?php
// Menyesuaikan jalur asset JS secara dinamis
$base_url = (basename(dirname($_SERVER['PHP_SELF'])) == 'barang' || basename(dirname($_SERVER['PHP_SELF'])) == 'peminjam') ? '../' : './';
?>
    <footer>
        <p>© <?php echo date('Y'); ?> SITARIS HMTI — Jobsheet 7</p>
    </footer>

    <!-- Script JS -->
    <script src="<?php echo $base_url; ?>assets/js/app.js"></script>
</body>
</html>