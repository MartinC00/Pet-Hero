<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");

    use Models\ePetSize;
?>

<h2> ADD A NEW PET !</h2>

<form action="<?php echo FRONT_ROOT ."Pet/add" ?>" method="post" enctype="multipart/form-data">
	<select name="petTypeId" required>
                    <?php
                      foreach($petTypeList as $petType)
                      {
                        ?>
                           <option value="<?php echo $petType->getId() ?>"><?php echo $petType->getName() ?></option>
                        <?php
                      }
                    ?>                                
                  </select>
	<input type="text" name="name" placeholder="Name" required> <br>
	<input type="text" name="breed" placeholder="Breed" required> <br>
	<select name="size">
		<option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
		<option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
		<option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
    </select> <br>
	<input type="text" name="description" placeholder="Description" required>  <br>
    Foto <input type="file" name="photo" id="photo"> <br>
    Vacunas <input type="file" name="vaccines" id="vaccines"> <br>
    Video <input type="file" name="video" id="video">

	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>