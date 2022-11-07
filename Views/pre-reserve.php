<?php
require_once("validate-session.php");
include('header.php');
include('owner-nav-bar.php');
?>
<h2> Create a New Reservation!</h2>

<?php if(isset($message)) echo $message; ?>

<p>Selected Keeper: <?php echo $user->getName() . " " . $keeper->getPetSize() . " " . $keeper->getPrice()?></p>

<form action="<?php echo FRONT_ROOT ."Reserve/showAddView" ?>" method="post">

    <table style="text-align: center">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Specie</th>
            <th>Size</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($userPetList as $pet) { ?>
            <tr>
                <td><input type="checkbox" name="idPets[]" value="<?php echo $pet->getId()?>"></td>
                <td><?php echo $pet->getName()?></td>
                <td><?php echo $pet->getPetType()->getName()?></td>
                <td><?php echo $pet->getSize()?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <label for="startDate">From</label>
    <input type="date" name="startDate" id="startDate">
    <label for="endDate">To</label>
    <input type="date" name="endDate" id="endDate">
    <input type="hidden" name="idKeeper" value="<?php echo $keeper->getKeeperId()?>" readonly>
    <input type="hidden" name="price" value="<?php echo $keeper->getPrice()?>" readonly>

    <button type="submit">Preview Reservation</button>

</form>
