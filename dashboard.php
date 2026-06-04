<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
body{
font-family:Segoe UI;
background:#f4f6f9;
padding:50px;
}
.card{
background:white;
padding:30px;
border-radius:15px;
max-width:500px;
margin:auto;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}
a{
text-decoration:none;
background:#dc3545;
color:white;
padding:10px 15px;
border-radius:5px;
}
</style>
</head>
<body>

<div class="card">
<h2>Dashboard</h2>

<p>
Selamat datang,
<b><?= $_SESSION['username']; ?></b>
</p>

<br>

<a href="logout.php">
Logout
</a>

</div>

</body>
</html>
