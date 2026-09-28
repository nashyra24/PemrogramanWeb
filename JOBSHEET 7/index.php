<?php
$page_title = "SITARIS HMTI | Daftar Peminjam";
include '../header.php';

$peminjamList = $_SESSION['peminjam'] ?? [];
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<main>
    <section>
        <h2>Daftar Peminjam</h2>

        <?php if ($flash): ?>
            <div class="alert alert-<?php echo htmlspecialchars($flash['type']); ?>">
                <p><?php echo htmlspecialchars($flash['pesan']); ?></p>
            </div>
        <?php endif; ?>

        <?php if (empty($peminjamList)): ?>
            <p>Belum ada data peminjam yang tersimpan.</p>
        <?php else: ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>OKI</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peminjamList as $index => $item): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($item['nim'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['nama'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['oki'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['no_hp'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include '../footer.php'; ?>