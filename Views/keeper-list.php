<?php
    require_once("validate-session.php");
    include('header.php');
    include('owner-nav-bar.php');
?>

  <table style="text-align:center;">
    <thead>
      <tr>
        <?php if(!empty($keeperList)) { ?>
          <th style="width: 100px;">Name</th>
          <th style="width: 170px;">Lastname</th>
          <th style="width: 110px;">Phone number</th>
          <th style="width: 110px;">Email</th>
          <th style="width: 400px;">Street</th>
          <th style="width: 400px;">Street Number</th>
          <th style="width: 110px;">Pet Size</th>
          <th style="width: 110px;">Initial Date</th>
          <th style="width: 110px;">End Date</th>
          <th style="width: 110px;">Days</th>
          <th style="width: 110px;">Price</th>
          <th style="width: 110px;">Hire!</th>
          <th style="width: 110px;">Chat</th>
        <?php } ?>
      </tr>
    </thead>

      <tbody>
        <h3>Filter Disponibily Dates!</h3>

        <form action="<?php echo FRONT_ROOT . "Keeper/showFilterListView" ?>" method="get"> 
            Initial Date Disponibily <input type="Date" name="initialDate"  required> <br>
            End Date Disponibily <input type="Date" name="endDate" required> <br>
            <input type="submit" value="FILTER">
        </form> <br>

        <form action="<?php echo FRONT_ROOT . "Keeper/showListView" ?>" method="get"> <input type="submit" value="Reset"></form> 

        <?php if(isset($message)) echo$message; ?>

        <h2> KEEPERs LIST </h2>

        <?php foreach($keeperList as $keeper)  {  ?>
          <form action="<?php echo FRONT_ROOT . "Reserve/showPreReserve" ?>" method="post">
                <tr>
                  <td><?php echo $keeper["name"] ?></td>
                  <td><?php echo $keeper["lastname"] ?></td>
                  <td><?php echo $keeper["phone"] ?></td>
                  <td><?php echo $keeper["email"] ?></td>
                  <td><?php echo $keeper["addressStreet"] ?></td>
                  <td><?php echo $keeper["addressNumber"] ?></td>
                  <td><?php echo $keeper["petSize"] ?></td>
                  <td><?php echo $keeper["initialDate"] ?></td>
                  <td><?php echo $keeper["endDate"] ?></td>
                  <td><?php echo $keeper["days"]?></td>
                  <td><?php echo $keeper["price"] ?></td>
                  <td> <button type="submit" name="keeperId" value="<?php echo $keeper["keeperId"] ?>"> Hire keeper </button> </td>
                  </form>
                
                <?php if(is_null($keeper["chat"])){ ?> 
                  <form action="<?php echo FRONT_ROOT . "Chat/add" ?>" method="post">
                    <td><button type="submit" name="idUserKeeper" value="<?php echo $keeper["userId"] ?>"> Send chat request </button></td> <?php //LA IDEA DE ESTE BOTON ES CREAR EL CHAT CON EL STATUS 2 OSEA PENDIENTE DE ACEPTACION (el keeper debe aceptarlo) ?>
                  </form> <?php } 
              
                else if($keeper["chat"]["status"]==0){  ?> <td>Rejected</td> <?php } 
                else if($keeper["chat"]["status"]==1){  ?> <td>Accepted</td> <?php }
                else { ?> <td>Pending</td> <?php } ?>
              </tr>
            <?php } ?>                           
      </tbody>
</table>