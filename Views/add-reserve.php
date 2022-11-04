
<?php use Models\eUserType; ?>

<h2> Create a New Reserve!</h2>

<form action="<?php echo FRONT_ROOT ."Reserve/add" ?>" method="post">

	<input type="text" name="idUserOwner" placeholder="Username" required> <br>
	<input type="password" name="idKeeper" placeholder="Password" required> <br>
		
	<input type="text" name="lastname" placeholder="Doe" required> <br>
	<input type="text" name="dni" placeholder="12345678" maxlength="8" minlength="7" required>  <br>
	<input type="number" name="phone" placeholder="223012345" required> <br>
	<input type="email" name="email" placeholder="example@mail.com" required> <br>

	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>