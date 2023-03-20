<?php
require_once("validate-session.php");
include('header.php');
include('owner-nav-bar.php');
?>
<h2> Create a New Reservation!</h2>

<?php if(isset($message)) echo $message; ?>

<p>Selected Keeper:</p>
<table>
    <thead>
        <tr>
            <th style="width: 110px;">Keeper Name</th>
            <th style="width: 110px;">Pet Size</th>
            <th style="width: 110px;">Price</th>
            <th style="width: 110px;">Initial Date</th>
            <th style="width: 110px;">End Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> <?php echo $user->getName() ?> </td>
            <td> <?php echo $keeper->getPetSize() ?> </td>
            <td> <?php echo $keeper->getPrice() ?> </td>
            <td> <?php echo $keeper->getInitialDate() ?> </td>
            <td> <?php echo $keeper->getEndDate() ?> </td>
        </tr>
    </tbody>
</table>
<br>
<?php if(!empty($userPetList)) { ?>
<form action="<?php echo FRONT_ROOT ."Reserve/showAddView" ?>" method="post">
    <tr>
        <td colspan="2">
            <label for="startDate">From</label>
            <input type="date" name="startDate" id="startDate" required>
        </td>
        <td colspan="2">
            <label for="endDate">To</label>
            <input type="date" name="endDate" id="endDate" required> 
        </td>
        <br>
    </tr>
    <input type="hidden" name="idKeeper" value="<?php echo $keeper->getKeeperId()?>" readonly> <br>
    <input type="hidden" name="price" value="<?php echo $keeper->getPrice()?>" readonly>
    <table style="text-align: center">
        <thead>
        <tr>
            <th style="width: 50px" >Select</th>
            <th>Name</th>
            <th>Specie</th>
            <th>Size</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($userPetList as $pet) { ?>
            <tr>
                <td style="width: 50px" ><input type="checkbox" name="idPets[]" value="<?php echo $pet->getId()?>"></td>
                <td><?php echo $pet->getName()?></td>
                <td><?php echo $pet->getPetType()->getName()?></td>
                <td><?php echo $pet->getSize()?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


        <button type="submit">Preview Reservation</button>
</form>
<?php } else echo "Oh.. seems like you don't have pets registered, add at least 1 before hire a keeper."; ?>
