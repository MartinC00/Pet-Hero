<?php use Models\ePetSize; ?>
<h2> Modify your Keeper Data </h2>
<?php echo $message; ?>
<form action="<?php echo FRONT_ROOT ."Keeper/modifyProfile" ?>" method="post">

	<input type="text" name="adress" value="<?php echo $keeper->getAddress(); ?>"> <br>
	
	<select name="petSize">

		<option value="<?php echo $keeper->getPetSize();?>" selected hidden><?php echo $keeper->getPetSize();?></option>

		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>
	
	<input type="date" name="initialDate" value="<?php echo $keeper->getInitialDate(); ?>" > <br>
	<input type="date" name="endDate" value="<?php echo $keeper->getEndDate(); ?>" > <br>
	<input type="number" name="price" value="<?php echo $keeper->getPrice(); ?>" min="0" max="9999"> <br>

	<input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>

</form>