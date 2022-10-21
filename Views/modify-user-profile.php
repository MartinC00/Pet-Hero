<?php
include('header.php');
include('owner-nav-bar.php');
require_once("validate-session.php");
?>

<h2> Complete Your Data </h2>

<form action="<?php echo FRONT_ROOT ."User/modifyProfile" ?>" method="post">

	<input type="text" name="username" value="<?php echo $user->getUsername(); ?>"> <br>
	<input type="password" name="password" value="<?php echo $user->getPassword(); ?>" > <br>
	<input type="text" name="name" value="<?php echo $user->getName(); ?> "> <br>
	<input type="text" name="lastname" value="<?php echo $user->getLastname(); ?> "> <br>
	<input type="text" name="dni" value="<?php echo $user->getDni(); ?>" > <br>
	<input type="text" name="phone" value="<?php echo $user->getPhone(); ?>"> <br>
	<input type="email" name="email" value="<?php echo $user->getEmail(); ?>" > <br>

	<input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>

</form>