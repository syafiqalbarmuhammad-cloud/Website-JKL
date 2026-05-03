<?php
$data = json_decode(file_get_contents('data.json'), true);

$total = count($data);
$prodi = [];
$semester = [];

foreach ($data as $d) {
    $prodi[$d['prodi']] = ($prodi[$d['prodi']] ?? 0) + 1;
    $semester[$d['semester']] = ($semester[$d['semester']] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Jumlah</title>
</head>
<body>

<h2>Total Mahasiswa: <?= $total ?></h2>

<h3>Per Prodi</h3>
<?php foreach ($prodi as $k => $v) echo "$k : $v <br>"; ?>

<h3>Per Semester</h3>
<?php foreach ($semester as $k => $v) echo "Semester $k : $v <br>"; ?>

<br>
<a href="menu.php">⬅ Kembali</a>

</body>
</html>