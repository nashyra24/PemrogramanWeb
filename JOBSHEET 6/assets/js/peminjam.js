async function muatDaftarPeminjam() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/peminjam.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarPeminjam = await res.json();

        daftarPeminjam.forEach(function (peminjam) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + peminjam.nim + "</td>" +
                "<td>" + peminjam.nama + "</td>" +
                "<td>" + peminjam.oki + "</td>" +
                "<td>" + peminjam.no_hp + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarPeminjam);
