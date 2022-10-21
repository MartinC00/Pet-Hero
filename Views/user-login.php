<?php 
    include_once('header.php');
?>

<h1>PET HERO</h1>

<h2>LOGIN TO MANAGE</h2>

<form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post">
    <input type="text" name="userName" placeholder="asd" required>
    <input type="password" name="password" placeholder="123" required>
    <button type="submit">Ingresar</button>
</form>

<h2>REGISTER</h2>
<a href="<?php echo FRONT_ROOT."Home/Register" ?>">Register</a>

<?php echo $message; ?>
