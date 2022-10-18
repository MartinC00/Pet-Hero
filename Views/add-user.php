<h1> Welcome !</h1>
<h2> Complete Your Data </h2>

<form action="<?php echo FRONT_ROOT ."User/add" ?>" method="post">
	<input type="text" name="username" placeholder="Username" required>
	<input type="text" name="password" placeholder="Password" required>
	
	<select name="usertypeId">
		<option value= 1> Owner </option>
		<option value= 2> Keeper </option>

	</select>


</form>