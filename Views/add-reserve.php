<?php
    require_once("validate-session.php");
    include('header.php');
    include('owner-nav-bar.php');
?>

<h2> Please check the reservation info</h2>

<form action="<?php echo FRONT_ROOT ."Reserve/add" ?>" method="post">

    <table style="text-align: center">
        <thead>
        <tr>
            <th>Name</th>
            <th>Pet Type</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($petList as $pet) { ?>
            <tr>
                <td><?php echo $pet->getName()?></td>
                <td><?php echo $pet->getPetType()->getName()?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <label for="startDate">From</label>
    <input type="date" name="startDate" id="startDate" value="<?php echo $startDate ?>" readonly>
    <label for="endDate">To</label>
    <input type="date" name="endDate" id="endDate" value="<?php echo $endDate ?>" readonly>

    <input type="hidden" name="idKeeper" value="<?php echo $idKeeper?>" readonly>
        <?php foreach($petList as $pet) 
            { ?>
                <input type="hidden" name="idPets[]" value="<?php echo $pet->getId() ?>">            
        <?php } ?>
    
    <input type="text" name="price" value="<?php echo $totalPrice; ?>" readonly>

    <button type="submit">Confirm Reservation</button>

</form>