<h2>Belanja Pulsa dan Paket Data</h2>
<p><strong>Tersedia</strong></p>
<form method="POST" action="?menu=B">
    <p>Pulsa : <br />
        <select name="pulsa">
            <option value="">-- Pilih Pulsa --</option>
            <option value="5000">5000</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
        </select>
    </p>
    <p>Paket Data : <br />
        <select name="paket_data">
            <option value="">-- Pilih Paket Data --</option>
            <option value="1 GB / 3 hari">1 GB / 3 hari</option>
            <option value="2GB / 5 hari">2GB / 5 hari</option>
            <option value="5GB / 7 hari">5GB / 7 hari</option>
        </select>
    </p>
    <button type="submit">Beli</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pulsa = $_POST['pulsa'] ?? '';
    $paket_data = $_POST['paket_data'] ?? '';
    $message = array();

    if (empty($pulsa) || empty($paket_data)) {
        $message[] = "Harap pilih pulsa dan paket data.";
    }

    if (!empty($message)) {
        foreach ($message as $msg) {
            echo "<p style='color:red;'>!! " . htmlspecialchars($msg) . " !!</p>";
        }
    } else {
        $hargaPulsa = 0;
        if ($pulsa == '5000') {
            $hargaPulsa = 6000;
        } else if ($pulsa == '10000') {
            $hargaPulsa = 11000;
        } else if ($pulsa == '20000') {
            $hargaPulsa = 21000;
        }

        $hargaPaket = 0;
        if ($paket_data === '1 GB / 3 hari' || $paket_data === '1GB / 3 hari') {
            $hargaPaket = 10000;
        } else if ($paket_data === '2GB / 5 hari' || $paket_data === '2 GB / 5 hari') {
            $hargaPaket = 15000;
        } else if ($paket_data === '5GB / 7 hari' || $paket_data === '5 GB / 7 hari') {
            $hargaPaket = 20000;
        }

        function infoKuota($kuota) {
            if ($kuota === '1 GB / 3 hari' || $kuota === '1GB / 3 hari') {
                return "1GB / 3 hari";
            } else if ($kuota === '2GB / 5 hari' || $kuota === '2 GB / 5 hari') {
                return "2GB / 5 hari";
            } else if ($kuota === '5GB / 7 hari' || $kuota === '5 GB / 7 hari') {
                return "5GB / 7 hari";
            }
            return $kuota;
        }

        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 25000) {
                return 0.20;
            } else {
                return 0;
            }
        }

        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }

        $totalBayar = $hargaPulsa + $hargaPaket;
        $diskon = dapatDiskon($totalBayar);
        $totalSetelahDiskon = totalHarga($diskon, $totalBayar);
        $kuotaInfo = infoKuota($paket_data);

        echo "<h2>Informasi Belanja</h2>";
        echo "<p>Pulsa : " . htmlspecialchars($pulsa) . "</p>";
        echo "<p>Paket Data : " . htmlspecialchars($kuotaInfo) . "</p>";
        echo "<p>Total Harga : Rp" . htmlspecialchars($totalSetelahDiskon) . "</p>";
        echo "<p>Diskon : " . htmlspecialchars($diskon) . "</p>";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " . (htmlspecialchars($diskon * 100)) . "%.</p>";
        }
    }
} else {
    echo "Silahkan pilih produk yang ingin dibeli.";
}
?>
