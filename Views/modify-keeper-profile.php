<?php
    require_once("validate-session.php");
    include('header.php');
    include('keeper-nav-bar.php');
	use Models\ePetSize; use Models\eDays; ?>
	
<h2> Modify your Keeper Data </h2>

<?php if(isset($message)) echo $message;?>

<form action="<?php echo FRONT_ROOT ."Keeper/modifyProfile" ?>" method="post">

	Street <input type="text" name="addressStreet" value="<?php echo $keeper->getAddressStreet(); ?>" maxlength="20"> <br>
	
	Street Number <input type="text" name="addressNumber" value="<?php echo $keeper->getAddressNumber(); ?> " minlength="1" maxlength="6" > <br>
	
	Pet Size <select name="petSize">
		<option value="<?php echo $keeper->getPetSize();?>" selected hidden><?php echo $keeper->getPetSize();?></option>
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>

	<h3> DISPONIBILITY</h3>
	
	Initial Date <input type="date" name="initialDate" value="<?php echo $keeper->getInitialDate(); ?>" > <br>
	End Date <input type="date" name="endDate" value="<?php echo $keeper->getEndDate(); ?>" > <br>
	
	Days of week <br> <select multiple="multiple" name="days[]" required="1" >
		<option value="<?php echo eDays::Monday->name; ?>"> Monday </option>
		<option value="<?php echo eDays::Tuesday->name; ?>"> Tuesday </option>
		<option value="<?php echo eDays::Wednesday->name; ?>"> Wednesday </option>
		<option value="<?php echo eDays::Thursday->name; ?>"> Thursday </option>
		<option value="<?php echo eDays::Friday->name; ?>"> Friday </option>
		<option value="<?php echo eDays::Saturday->name; ?>"> Saturday </option>
		<option value="<?php echo eDays::Sunday->name; ?>"> Sunday </option>
	 </select> <br> <br>
	Price per Day <input type="number" name="price" value="<?php echo $keeper->getPrice(); ?>" min="0" max="9999"> <br>

	<input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>

</form>