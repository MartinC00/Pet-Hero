
<h2> Modify your Keeper Data </h2>

<form action="<?php echo FRONT_ROOT ."Keeper/modifyProfile" ?>" method="post">

	<input type="text" name="petSize" placeholder=<?php $keeper->getPetSize(); ?>> <br>
	<input type="date" name="initialDate" placeholder=<?php $user->getInitialDate(); ?> > <br>
	<input type="date" name="endDate" placeholder=<?php $user->getEndDate(); ?> > <br>
	<input type="number" name="price" placeholder=<?php $user->getPrice(); ?> min="0" max="9999"> <br>

	<input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>

</form>