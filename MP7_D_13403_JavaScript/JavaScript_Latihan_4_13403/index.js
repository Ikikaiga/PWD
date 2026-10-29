function fn_ValForm() {
    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umurStr = document.getElementById("umur").value.trim();
    var kategori = document.getElementById("kategori").value.trim();

    var sMsg = "";

    if (nama === "") {
        sMsg += "\n* Anda belum mengisikan nama";
    }
    if (email === "") {
        sMsg += "\n* Anda belum mengisikan email";
    }
    if (umurStr === "") {
        sMsg += "\n* Anda belum mengisikan umur";
    }
    if (kategori === "") {
        sMsg += "\n* Anda belum memilih jenis acara";
    }
    if (sMsg !== "") {
        alert("Peringatan:\n" + sMsg);
        return false;
    }

    var umur = parseInt(umurStr, 10);
    var info = "";
    if (umur < 15 || umur > 60) {
        sMsg += "\n* Umur harus berupa angka di antara 15 sampai 60 tahun";
    } else if (umur <= 25) {
        info = "PesertaMahasiswa";
    } else {
        info = "Peserta Umum";
    }
    if (sMsg !== "") {
        alert("Peringatan:\n" + sMsg);
        return false;
    }

    var pilihan = "";
    switch (kategori) {
        case "W":
            pilihan = "Workshop";
            break;
        case "S":
            pilihan = "Seminar";
            break;
        case "L":
            pilihan = "Lomba Coding";
            break;
    }

    alert("Terima kasih " + nama + "! Anda terdaftar di acara " + pilihan + " (" + info + ").");
    return true;
}