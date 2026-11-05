<h2>Pendaftaran Akun</h2>
<form method="POST" action="?menu=A">
    <p>Nama : <br /><input type="text" name="nama" /></p>
    <p>Telepon : <br /><input type="text" name="telepon" /></p>
    <p>Verifikasi : <br />
        <select name="verifikasi">
            <option value="">-- Pilih Verifikasi --</option>
            <option value="WhatsApp">WhatsApp</option>
            <option value="SMS">SMS</option>
        </select>
    </p>
    <button type="submit">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $tlp = $_POST['telepon'] ?? '';
    $verifikasi = $_POST['verifikasi'] ?? '';
    $message = array();

    if (empty($nama) || empty($tlp) || empty($verifikasi)) {
        $message[] = "Harap lengkapi semua data.";
    }

    if (!empty($nama) && !preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $message[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (!empty($tlp) && !preg_match("/^(\+62|08)[0-9]{9,11}$/", $tlp)) {
        $message[] = "Nomor telepon tidak valid (harus diawali +62 atau 08, dan 9-11 digit).";
    }

    if (!empty($message)) {
        foreach ($message as $msg) {
            echo "<p style='color:red;'>!! " . htmlspecialchars($msg) . " !!</p>";
        }
    } else {
        $lokasi = "";
        if ($verifikasi === "WhatsApp") {
            $lokasi = "WhatsApp";
        } else if ($verifikasi === "SMS") {
            $lokasi = "SMS";
        }

        echo "<h2>Informasi Pendaftaran</h2>";
        echo "<p>Nama: " . htmlspecialchars($nama) . "</p>";
        echo "<p>Telepon: " . htmlspecialchars($tlp) . "</p>";
        echo "<p>Verifikasi Kode OTP: " . htmlspecialchars($verifikasi) . "</p>";
        echo "<p>Pendaftaran akun Anda terkirim. Silahkan mengecek " . htmlspecialchars($lokasi) . " " . htmlspecialchars($tlp) . " untuk mendapatkan kode OTP verifikasi.</p>";
    }
} else {
    echo "Silahkan lengkapi formulir di atas.";
}
?>
