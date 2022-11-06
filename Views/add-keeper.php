<?php use Models\ePetSize; use Models\eDays; ?>

<h2> <?php echo $message . " now..."; ?> </h2>

<h1> Keeper Information !</h1>
<h2> Please complete </h2>


<form action="<?php echo FRONT_ROOT ."Keeper/add" ?>" method="post">
	Street <input type="text" name="addressStreet"  required maxlength="20"> <br>
	Street Number <input type="number" name="addressNumber" minlength="1" required> <br>
	Pet Size <select name="petSize">
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>
	<h3> DISPONIBILITY</h3>
	Initial Date<input type="date" name="initialDate"  required> <br>
	End Date <input type="date" name="endDate"  required> <br> <br>
	Days of week <br> <select multiple="multiple" name="days[]" required="1" >
		<option value="<?php echo eDays::Monday->name; ?>"> Monday </option>
		<option value="<?php echo eDays::Tuesday->name; ?>"> Tuesday </option>
		<option value="<?php echo eDays::Wednesday->name; ?>"> Wednesday </option>
		<option value="<?php echo eDays::Thursday->name; ?>"> Thursday </option>
		<option value="<?php echo eDays::Friday->name; ?>"> Friday </option>
		<option value="<?php echo eDays::Saturday->name; ?>"> Saturday </option>
		<option value="<?php echo eDays::Sunday->name; ?>"> Sunday </option>
	 </select> <br> <br>
	Price per day <input type="number" name="price" placeholder="$XXXX" min="0" max="9999" required> <br>
	
	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>