<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");

    use Models\ePetSize;
    use Models\PetType;
?>

<h2> MODIFY YOUR PET !</h2>

<?php if(isset($message)) echo $message ?>

<form action="<?php echo FRONT_ROOT ."Pet/modifyPet" ?>" method="post" enctype="multipart/form-data">
    <table style="text-align: center">
        <thead>
            <tr style="background-color: darkred">
                <th colspan="5">Pet Info</th>
            </tr>
            <tr>
                <th><label for="petName">Name</label></th>
                <th><label for="petSpecies">Species</label></th>
                <th><label for="petBreed">Breed</label></th>
                <th><label for="petSize">Size</label></th>
                <th><label for="petDesc">Description</label></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="name" id="petName" value="<?php echo $pet->getName() ?>" ></td>
                <td> <input type="text" id="petSpieces" value="<?php echo $pet->getPetType()->getName() ?>" disabled> </td>
                <td><input type="text"  id="petBreed" value="<?php echo $pet->getBreed() ?>" ></td>
                <td> <input type="text" id="petSize" value="<?php echo $pet->getSize() ?>" disabled></td>
                <td><input type="text" name="description" id="petDesc" value="<?php echo $pet->getDescription() ?>"></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
        <tr style="background-color: darkred">
            <th colspan="3">Media</th>
        </tr>
        <tr>
            <th><label for="photo">Photo</label></th>
            <th><label for="vaccines">Vaccines</label></th>
            <th><label for="video">Video</label></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                
                <td> <img src="<?php echo IMG_PATH.$pet->getPhoto(); ?>" height="100" width="100" > </td>
                <td><img src="<?php echo IMG_PATH.$pet->getVaccines(); ?>" height="100" width="100" ></td>
                <td><video width="320" controls><source src="<?php echo IMG_PATH.$pet->getVideo(); ?>" type="video/mp4">
                        Your browser does not support the video tag.</video></td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $pet->getId() ?>">
            <tr>
                <td><input type="file" name="photo" id="photo" ></td>
                <td><input type="file" name="vaccines" id="vaccines"></td>
                <td><input type="file" name="video" id="video"></td>            
            </tr>
        </tbody>
    </table>
	<button type="submit" style="background-color:#DC5E47;color:black;"> MODIFY </button>
</form>