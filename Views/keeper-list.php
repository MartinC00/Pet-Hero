<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");
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
              <?php } ?>
              </tr>
            </thead>

            <tbody>
              <h3>Filter Disponibily Dates!</h3>

              <form action="<?php echo FRONT_ROOT . "Keeper/showFilterListView" ?>" method="get"> 
                  Initial Date Disponibily <input type="Date" name="initialDate" value="<?php echo $initialDate?>" required> <br>
                  End Date Disponibily <input type="Date" name="endDate" value="<?php echo $endDate?>" required> <br>
                  <input type="submit" value="FILTER">
              </form> <br>

              <form action="<?php echo FRONT_ROOT . "Keeper/showListView" ?>" method="get"> <input type="submit" value="Reset"></form> 

              <?php if(isset($message1)) echo$message1; ?>

              <h2> KEEPERs LIST </h2>

              <?php if(isset($message)) echo $message; ?>

              <form action="<?php echo FRONT_ROOT . "Reserve/showAddView" ?>" method="post">
              <?php foreach($keeperList as $keeper)
                {
                    $user = $this->userController->UserDAO->getById($keeper->getUserId());
                  ?>
                    <tr>
                      <td><?php echo $user->getName() ?></td>
                      <td><?php echo $user->getLastname() ?></td>
                      <td><?php echo $user->getPhone() ?></td>
                      <td><?php echo $user->getEmail() ?></td>
                      <td><?php echo $keeper->getAddressStreet() ?></td>
                      <td><?php echo $keeper->getAddressNumber() ?></td>
                      <td><?php echo $keeper->getPetSize() ?></td>
                      <td><?php echo $keeper->getInitialDate() ?></td>
                      <td><?php echo $keeper->getEndDate() ?></td>
                      <td><?php foreach($keeper->getDays() as $day) echo $day ?></td>
                      <td><?php echo $keeper->getPrice() ?></td>
                      <td><button type="submit" name="keeperId" value="<?php echo $keeper->getKeeperId() ?>">Hire keeper </button></td>
                    </tr>
                  <?php
                }
              ?>                           
              </form>
            </tbody>
          </table>