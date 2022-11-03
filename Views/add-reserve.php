
<?php use Models\eUserType; ?>

<h1> Create a New Reserve !</h1>
<h2> Complete Your Data </h2>

<?php if(isset($message)) echo $message ?>

<form action="<?php echo FRONT_ROOT ."User/add" ?>" method="post">

	<input type="text" name="username" placeholder="Username" required> <br>
	<input type="password" name="password" placeholder="Password" required> <br>
	<input type="text" name="name" placeholder="John" required> <br>
	<input type="text" name="lastname" placeholder="Doe" required> <br>
	<input type="text" name="dni" placeholder="12345678" maxlength="8" minlength="7" required>  <br>
	<input type="number" name="phone" placeholder="223012345" required> <br>
	<input type="email" name="email" placeholder="example@mail.com" required> <br>

	<select name="userType">
		<option value="<?php echo eUserType::Owner->name; ?>"> Owner </option>
		<option value="<?php echo eUserType::Keeper->name; ?>"> Keeper </option>
	</select>
	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>


</form>