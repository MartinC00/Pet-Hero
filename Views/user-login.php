<?php
    include('header.php');
    include('guest-nav-bar.php');
?>

<div class="login-wrapper">
    <h3 style="margin-bottom: 30px; margin-top: 5px">LOGIN TO MANAGE</h3>

    <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="userName" id="username" required> <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required> <br>
        <button type="submit">Ingresar</button>
    </form>

    <h3>Not a member yet?</h3>
    <form action="<?php echo FRONT_ROOT."User/showAddView" ?>" method="get">
        <button type="submit">Register</button>
    </form>

    <?php echo $message; ?>
</div>
