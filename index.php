<?php
session_start();

// Generate CSRF Token
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        die("Invalid CSRF Token");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh login sederhana
    if ($username == "admin" && $password == "admin123") {

        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Aesthetic</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(-45deg,#667eea,#764ba2,#6dd5ed,#2193b0);
background-size:400% 400%;
animation:gradient 12s ease infinite;
overflow:hidden;
}

@keyframes gradient{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.container{
width:100%;
max-width:420px;
padding:20px;
}

.card{
background:rgba(255,255,255,0.15);
backdrop-filter:blur(15px);
border:1px solid rgba(255,255,255,0.2);
border-radius:25px;
padding:40px;
box-shadow:0 8px 32px rgba(0,0,0,.2);
animation:fadeIn 1s ease;
}

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(30px);
}
to{
opacity:1;
transform:translateY(0);
}
}

.logo{
text-align:center;
font-size:50px;
margin-bottom:15px;
}

h2{
color:white;
text-align:center;
margin-bottom:25px;
}

.input-group{
margin-bottom:20px;
}

.input-group input{
width:100%;
padding:15px;
border:none;
outline:none;
border-radius:12px;
background:rgba(255,255,255,.2);
color:white;
font-size:15px;
}

.input-group input::placeholder{
color:#eee;
}

.btn{
width:100%;
padding:15px;
border:none;
border-radius:12px;
background:#ffffff;
color:#333;
font-size:16px;
font-weight:bold;
cursor:pointer;
transition:.3s;
}

.btn:hover{
transform:translateY(-2px);
background:#f5f5f5;
}

.error{
background:#ff4d4d;
padding:10px;
border-radius:8px;
color:white;
margin-bottom:15px;
text-align:center;
}

.footer{
text-align:center;
margin-top:15px;
color:white;
font-size:14px;
}

@media(max-width:480px){

.card{
padding:30px 20px;
}

.logo{
font-size:40px;
}

}

</style>

</head>
<body>

<div class="container">

<div class="card">

<div class="logo">🔐</div>

<h2>Welcome Back</h2>

<?php if($error!=""){ ?>
<div class="error"><?= $error ?></div>
<?php } ?>

<form method="POST">

<input type="hidden" name="token"
value="<?= $_SESSION['token']; ?>">

<div class="input-group">
<input type="text"
name="username"
placeholder="Username"
required>
</div>

<div class="input-group">
<input type="password"
name="password"
placeholder="Password"
required>
</div>

<button class="btn" type="submit">
Login
</button>

</form>

<div class="footer">
Secure Login System
</div>

</div>

</div>

</body>
</html>
