
<h2> Complete Your Data </h2>

<form action="<?php echo FRONT_ROOT ."User/modifyProfile" ?>" method="post">

	<input type="text" name="username" placeholder="<?php $user->getUsername(); ?>"> <br>
	<input type="password" name="password" placeholder="<?php $user->getPassword(); ?>" > <br>
	<input type="text" name="name" placeholder="<?php $user->getName(); ?> "> <br>
	<input type="text" name="lastname" placeholder="<?php $user->getLastname(); ?> "> <br>
	<input type="text" name="dni" placeholder="<?php $user->getDni(); ?>" > <br>
	<input type="text" name="phone" placeholder="<?php $user->getPhone(); ?>"> <br>
	<input type="email" name="email" placeholder="<?php $user->getEmail(); ?>" > <br>

	<input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>

</form>