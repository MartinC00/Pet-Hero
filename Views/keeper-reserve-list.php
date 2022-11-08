<?php
    require_once("validate-session.php");
    include('header.php');
    include('keeper-nav-bar.php');

    use Models\Reserve;
?>

<?php if(isset($message)) echo $message ?>

<table style="text-align: center">
    <thead>
        <tr>
            <th><label for="">Reservation #</label></th>
            <th><label for="">Owner Name</label></th>
            <th><label for="">Pets</label></th>
            <th><label for="">From</label></th>
            <th><label for="">To</label></th>
            <th><label for="">Total Amount</label></th>
            <th><label for="">Status</label></th>
            <th><label for="">Actions</label></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reserveList as $reserve) { ?>
        <tr>
            <td><?php echo $reserve->getId()?></td>
            <td><?php echo $ownerList[$i]->getName()?></td>
            <td>
                <?php foreach($petListArray[$i++] as $pet) {
                    echo $pet->getName();
                } ?>
            </td>
            <td><?php echo $reserve->getInitialDate()?></td>
            <td><?php echo $reserve->getEndDate()?></td>
            <td><?php echo $reserve->getTotalPrice()?></td>
            <td><?php echo $reserve->getReserveStatus()?></td>
            <?php if($reserve->getReserveStatus() == "Pending") { ?>
                <td>
                    <form action="<?php echo FRONT_ROOT."Reserve/modifyStatus" ?>" method="post">
                        <input type="hidden" name="reserveId" value="<?php echo $reserve->getId() ?>">
                        <button type="submit" name="status" value="1"> ACCEPT </button>
                        <button type="submit" name="status" value="0"> REJECT </button>
                    </form>
                </td>
            <?php } else { ?>
                <td> No actions </td>
            <?php }?>
        </tr>
        <?php } ?>
    </tbody>
</table>