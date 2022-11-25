<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");

    use Models\ePetSize;
    use Models\PetType;
?>

<h2> ADD A NEW PET !</h2>

<?php if(isset($message)) echo $message ?>

<form action="<?php echo FRONT_ROOT ."Pet/add" ?>" method="post" enctype="multipart/form-data">
    <table style="text-align: center">
        <thead>
            <tr style="background-color: rgba(139,0,0,0.5)">
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
                <td><input type="text" name="name" id="petName" placeholder="Name" required></td>
                <td><select name="petTypeId" id="petSpecies" required>
                        <?php foreach($petTypeList as $petType) { ?>
                            <option value="<?php echo $petType->getId() ?>"><?php echo $petType->getName() ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" name="breed" id="petBreed" placeholder="Breed" required></td>
                <td><select name="size" id="petSize" required>
                        <option value="<?php echo ePetSize::Small->name; ?>"> Small </option>
                        <option value="<?php echo ePetSize::Medium->name; ?>"> Medium </option>
                        <option value="<?php echo ePetSize::Big->name; ?>"> Big </option>
                    </select>
                </td>
                <td><input type="text" name="description" id="petDesc" placeholder="Description"></td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
        <tr style="background-color: rgba(139,0,0,0.5)">
            <th colspan="3">Media</th>
        </tr>
        <tr>
            <th><label for="photo">Photo</label></th>
            <th><label for="vaccines">Vaccines</label></th>
            <th><label for="video">Video</label></th>
        </tr>
        </thead>
        <tbody>
            <td><input type="file" name="photo" id="photo"></td>

            <td><input type="file" name="vaccines" id="vaccines"></td>
            <td><input type="file" name="video" id="video"></td>
        </tbody>
    </table>

	<input type="submit" value="Submit pet!" style="background-color:#DC5E47;color:black;"/>
</form>