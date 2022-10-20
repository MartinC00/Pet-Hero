<h2> ADD A NEW PET !</h2>

<form action="<?php echo FRONT_ROOT ."Pet/add" ?>" method="post">

	<input type="text" name="name" placeholder="Name" required> <br>
	<input type="text" name="breed" placeholder="Breed" required> <br>
	<select name="petSize">
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
	 </select> <br>
	<input type="text" name="description" placeholder="description" required>  <br>
	
	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>

 <?php // FALTAN ESTAS 3: $photo (foto del perro), $vaccines(foto carnet vacunas), $video (del puto perro) ?>
</form>