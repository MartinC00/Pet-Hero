<h1>PET HERO</h1>

<h2>LOGIN TO MANAGE</h2>

<form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post">
    <label for="username">Username</label>
    <input type="text" name="userName" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <button type="submit">Ingresar</button>
</form>

<h2>REGISTER</h2>
<a href="<?php echo FRONT_ROOT."Home/Register" ?>">Register</a>

<?php echo $message; ?>
