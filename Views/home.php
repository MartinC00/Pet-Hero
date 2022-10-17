<?php 
    include_once('header.php');
?>

<h1>PET HERO</h1>

<h2>LOGIN TO MANAGE</h2>

<form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post">
    <input class="input-login" type="text" name="userName" placeholder="asd" required>
    <input class="input-login" type="password" name="password" placeholder="123" required >
    <button class="btn-login btn" type="submit">Ingresar</button>
</form>

