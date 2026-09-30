    </main>

    <footer>
        <p>© <?php echo date('Y'); ?> SITARIS HMTI — Jobsheet 7</p>
    </footer>
    <script src="<?php echo $base; ?>assets/js/app.js"></script>
    <?php
    // =================================================================
    // [BUG LAMA DIPERBAIKI + DIAMBIL DARI REFERENSI] Versi lama:
    // barang/list.php menyetel $extraScripts tetapi footer tidak pernah
    // mencetaknya, sehingga barang.js tidak dimuat dan tabel selalu
    // kosong. Footer referensi memiliki loop $extra_scripts ini, jadi
    // kini ditiru. Variabel $base tersedia karena footer di-include
    // setelah header pada halaman yang sama.
    // =================================================================
    if (!empty($extra_scripts)):
        foreach ($extra_scripts as $src): ?>
    <script src="<?php echo $src; ?>"></script>
        <?php endforeach;
    endif; ?>
</body>
</html>
