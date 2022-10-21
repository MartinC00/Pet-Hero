<?php use Models\ePetSize; ?>
<h1> Keeper Information !</h1>
<h2> Please complete </h2>
<?php echo $message; ?>

<form action="<?php echo FRONT_ROOT ."Keeper/add" ?>" method="post">
	<select name="petSize">
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>
	<input type="date" name="initialDate"  required> <br>
	<input type="date" name="endDate"  required> <br>
	<input type="number" name="price" placeholder="$XXXX" min="0" max="9999" required> <br>
	
	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>