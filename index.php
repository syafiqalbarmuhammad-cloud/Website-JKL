<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = 'data.json';
if (!file_exists($file)) file_put_contents($file, '[]');

$data = json_decode(file_get_contents($file), true);

// SIMPAN
if (isset($_POST['simpan'])) {
    $data[] = [
        "nama" => $_POST['nama'],
        "nim" => $_POST['nim'],
        "prodi" => $_POST['prodi'],
        "semester" => $_POST['semester'],
        "nohp" => $_POST['nohp']
    ];
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: index.php?page=input");
    exit;
}

// HITUNG
$total = count($data);
$perProdi = [];
$perSemester = [];

foreach ($data as $d) {
    $perProdi[$d['prodi']] = ($perProdi[$d['prodi']] ?? 0) + 1;
    $perSemester[$d['semester']] = ($perSemester[$d['semester']] ?? 0) + 1;
}

for ($i = 1; $i <= 8; $i++) {
    $perSemester[$i] = $perSemester[$i] ?? 0;
}
ksort($perSemester);

$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Mahasiswa</title>

<style>
body {
    font-family: 'Segoe UI';
    background: linear-gradient(135deg, #0f172a, #1e40af, #2563eb);
    color: white;
    margin: 0;
}

.container {
    max-width: 1000px;
    margin: auto;
    padding: 20px;
    text-align: center;
}

.card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 25px;
    margin-top: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.5);
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
    gap: 15px;
}

.stat {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 15px;
}

.stat .num {
    font-size: 30px;
    font-weight: bold;
    color: #93c5fd;
}

button {
    padding: 12px 20px;
    margin: 8px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
    color: white;
    cursor: pointer;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 6px 0;
    border-radius: 10px;
    border: none;
}

table {
    width: 100%;
    margin-top: 15px;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}
</style>

</head>

<body>
<div class="container">

<?php if ($page == 'home') { ?>

<div class="card">
<h1>DATA MAHASISWA<br>JURUSAN KESEHATAN LINGKUNGAN<br>POLTEKKES KEMENKES PONTIANAK</h1>
<p>Aplikasi Input Data Mahasiswa<br>By Muhammad Syafiq Albar</p>
<a href="?page=menu"><button>MASUK</button></a>
</div>

<?php } elseif ($page == 'menu') { ?>

<div class="card">
<h2>Menu Utama</h2>

<!-- JAM -->
<p id="jam"></p>

<!-- TOTAL -->
<div class="stat">
<h3>Total Mahasiswa</h3>
<div class="num"><?= $total ?></div>
</div>

<!-- MENU -->
<div class="grid">
<a href="?page=input"><button>Input Data</button></a>
<a href="?page=data"><button>Data Mahasiswa</button></a>
<a href="?page=jumlah"><button>Statistik</button></a>
</div>

<!-- QUICK SEARCH -->
<h3>Cari Cepat</h3>
<input type="text" placeholder="Cari nama / NIM..." onkeyup="quickSearch(this.value)">

<table>
<tbody id="quickTable">
<?php foreach ($data as $d) { ?>
<tr>
<td><?= $d['nama'] ?> - <?= $d['nim'] ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<br>
<a href="?page=home"><button style="background:red;">Keluar</button></a>
</div>

<?php } elseif ($page == 'input') { ?>

<div class="card">
<h2>Input Data</h2>

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

<button name="simpan">Simpan</button>
</form>

<a href="?page=menu"><button>Kembali</button></a>
</div>

<?php } elseif ($page == 'data') { ?>

<div class="card">
<h2>Data Mahasiswa</h2>

<input type="text" id="search" placeholder="Cari mahasiswa..." onkeyup="searchData()">

<select id="filterProdi" onchange="filterProdi()">
<option value="">-- Semua Prodi --</option>
<option>Sarjana Terapan Keselamatan dan Kesehatan Kerja</option>
<option>Sarjana Terapan Sanitasi Lingkungan</option>
<option>Diploma 3 Sanitasi</option>
</select>

<table>
<tr>
<th>Nama</th><th>NIM</th><th>Prodi</th><th>Semester</th><th>No HP</th>
</tr>

<tbody id="tableBody">
<?php foreach ($data as $d) { ?>
<tr>
<td><?= $d['nama'] ?></td>
<td><?= $d['nim'] ?></td>
<td class="prodi"><?= $d['prodi'] ?></td>
<td><?= $d['semester'] ?></td>
<td><?= $d['nohp'] ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="?page=menu"><button>Kembali</button></a>
</div>

<?php } elseif ($page == 'jumlah') { ?>

<div class="card">
<h2>Total Mahasiswa</h2>
<div class="stat"><div class="num"><?= $total ?></div></div>

<h3>Jumlah Mahasiswa Prodi</h3>
<div class="grid">
<?php foreach ($perProdi as $k => $v) { ?>
<div class="stat">
<?= $k ?><br><div class="num"><?= $v ?></div>
</div>
<?php } ?>
</div>

<h3>Jumlah Mahasiswa Semester</h3>
<div class="grid">
<?php foreach ($perSemester as $k => $v) { ?>
<div class="stat">
Semester <?= $k ?><br><div class="num"><?= $v ?></div>
</div>
<?php } ?>
</div>

<a href="?page=menu"><button>Kembali</button></a>
</div>

<?php } ?>

</div>

<!-- SCRIPT -->
<script>
// SEARCH DATA
function searchData() {
    let input = document.getElementById("search").value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
    });
}

// FILTER PRODI
function filterProdi() {
    let selected = document.getElementById("filterProdi").value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        let prodi = row.querySelector(".prodi").innerText.toLowerCase();
        row.style.display = (selected === "" || prodi.includes(selected)) ? "" : "none";
    });
}

// QUICK SEARCH MENU
function quickSearch(value) {
    let input = value.toLowerCase();
    let rows = document.querySelectorAll("#quickTable tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
    });
}

// JAM REALTIME
function updateTime() {
    let now = new Date();
    document.getElementById("jam").innerText = now.toLocaleTimeString();
}
setInterval(updateTime, 1000);
</script>

</body>
</html>