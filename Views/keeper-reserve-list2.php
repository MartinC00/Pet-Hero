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
        <?php foreach($reserveList as $row) { ?>
        <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["name"]?></td>
            <td><?php echo $row["petName"]?> </td>
            <td><?php echo $row["initialDate"]?></td>
            <td><?php echo $row["endDate"]?></td>
            <td><?php echo $row["totalPrice"]?></td>
            <td><?php if($row["reserveStatus"] == 2) echo "Pending"; 
                        else if($row["reserveStatus"] == 1) echo "Accepted";
                            else echo "Rejected" ?></td>
            <?php if($row["reserveStatus"] == 2) { ?>
                <td>
                    <form action="<?php echo FRONT_ROOT."Reserve/modifyStatus" ?>" method="post">
                        <input type="hidden" name="reserveId" value="<?php echo $row["reserveStatus"]?>">
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