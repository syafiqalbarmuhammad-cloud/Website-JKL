<?php
// Redirect jika tombol diklik
if (isset($_GET['masuk'])) {
    header("Location: menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Landing Page</title>

<style>
body {
    font-family: 'Segoe UI';
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    color: white;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 600px;
}

h1 {
    font-size: 26px;
    line-height: 1.5;
}

p {
    opacity: 0.8;
    margin-top: 10px;
}

button {
    margin-top: 25px;
    padding: 14px 30px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    transform: scale(1.05);
}
</style>
</head>

<body>

<div class="container">
    <h1>
        DATA MAHASISWA<br>
        JURUSAN KESEHATAN LINGKUNGAN<br>
        POLTEKKES KEMENKES PONTIANAK
    </h1>

    <p>Aplikasi Input Data Mahasiswa Digital</p>

    <!-- CARA 1: LINK -->
    <a href="menu.php">
        <button>MASUK</button>
    </a>

    <!-- CARA 2: BACKUP JS -->
    <br><br>
    <button onclick="window.location.href='menu.php'">
        MASUK (ALT)
    </button>

    <!-- CARA 3: BACKUP PHP -->
    <br><br>
    <a href="?masuk=1" style="color:white;">Masuk jika tombol error</a>
</div>

</body>
</html>