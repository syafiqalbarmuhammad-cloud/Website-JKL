<?php
$file = 'data.json';
if (!file_exists($file)) file_put_contents($file, '[]');

$data = json_decode(file_get_contents($file), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data[] = $_POST;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: input.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Input Data</title>
<style>
body {
    font-family: 'Segoe UI';
    background: #0f172a;
    color: white;
    text-align: center;
}
form {
    max-width: 350px;
    margin: auto;
}
input, select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}
button {
    padding: 10px;
    width: 100%;
    background: #3b82f6;
    border: none;
    color: white;
}
</style>
</head>
<body>

<h2>Input Data Mahasiswa</h2>

<form method="POST">
<input name="nama" placeholder="Nama" required>
<input name="nim" placeholder="NIM" required>

<select name="prodi">
<option>Sarjana Terapan Keselamatan dan Kesehatan Kerja</option>
<option>Sarjana Terapan Sanitasi Lingkungan</option>
<option>Diploma 3 Sanitasi</option>
</select>

<select name="semester">
<?php for($i=1;$i<=8;$i++) echo "<option>$i</option>"; ?>
</select>

<input name="nohp" placeholder="No HP">

<button>Simpan</button>
</form>

<br>
<a href="menu.php" style="color:white;">⬅ Kembali</a>

</body>
</html>