<?php use Models\ePetSize; use Models\eDays; ?>

<h1> Keeper Information !</h1>
<h2> Please complete </h2>
<?php echo $message; ?>

<form action="<?php echo FRONT_ROOT ."Keeper/add" ?>" method="post">
	<input type="address" name="address"  required> <br>
	<select name="petSize">
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>
	<input type="date" name="initialDate"  required> <br>
	<input type="date" name="endDate"  required> <br>
	<select multiple name="days[]" >
		<option value="<?php echo eDays::Monday->name; ?>"> Monday </option>
		<option value="<?php echo eDays::Tuesday->name; ?>"> Tuesday </option>
		<option value="<?php echo eDays::Wednesday->name; ?>"> Wednesday </option>
		<option value="<?php echo eDays::Thursday->name; ?>"> Thursday </option>
		<option value="<?php echo eDays::Friday->name; ?>"> Friday </option>
		<option value="<?php echo eDays::Saturday->name; ?>"> Saturday </option>
		<option value="<?php echo eDays::Sunday->name; ?>"> Sunday </option>
	 </select> <br>
	<input type="number" name="price" placeholder="$XXXX" min="0" max="9999" required> <br>
	
	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>