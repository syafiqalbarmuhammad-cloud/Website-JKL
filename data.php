<?php
$data = json_decode(file_get_contents('data.json'), true);
?>

<!DOCTYPE html>
<html>
<head>
<title>Data</title>
</head>
<body>

<h2>Data Mahasiswa</h2>

<table border="1">
<tr>
<th>Nama</th><th>NIM</th><th>Prodi</th><th>Semester</th><th>No HP</th>
</tr>

<?php foreach ($data as $d) { ?>
<tr>
<td><?= $d['nama'] ?></td>
<td><?= $d['nim'] ?></td>
<td><?= $d['prodi'] ?></td>
<td><?= $d['semester'] ?></td>
<td><?= $d['nohp'] ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="menu.php">⬅ Kembali</a>

</body>
</html>