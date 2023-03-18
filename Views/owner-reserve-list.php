<?php
    require_once("validate-session.php");
    include('header.php');
    include('owner-nav-bar.php');

    use Models\Reserve;
?>

<?php if(isset($message)) echo $message ?>

<table style="text-align: center">
    <thead>
        <tr>
            <th><label for="">Reservation #</label></th>
            <th><label for="">Keeper Name</label></th>
            <th><label for="">Pets</label></th>
            <th><label for="">From</label></th>
            <th><label for="">To</label></th>
            <th><label for="">Total Amount</label></th>
            <th><label for="">Status</label></th>
            <th><label for="">Payment</label></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reserveList as $row) { ?>
        <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["keeperName"]?></td>
            <td><?php foreach ($row["petNameList"] as $petName) echo $petName?> </td>
            <td><?php echo $row["initialDate"]?></td>
            <td><?php echo $row["endDate"]?></td>
            <td><?php echo $row["totalPrice"]?></td>
            <td><?php if($row["reserveStatus"] == 2) echo "Pending"; 
                        else if($row["reserveStatus"] == 1) echo "Accepted";
                            else echo "Rejected" ?></td>
            <td><?php if($row["paymentStatus"] == 2) echo "Payed"; 
                        else if($row["paymentStatus"] == 1) echo "Signed";
                            else echo "Unpayed" ?> </td>       
        </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<h4>PAYMENT</h4>
<table>
    <thead>
        <tr>
            <th><label for="">Reservation #</label></th>
            <th><label for="">Coupon Code</label></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form action="<?php echo FRONT_ROOT . "Reserve/payReserveSign" ?>">
                <td><input type="number" name="id" required> </td>
                <td><input type="text" name="code" required></td>
                <td><button type="submit" >PAY RESERVE</button></td>
            </form>
        </tr>
    </tbody>
</table>