<?php use Models\ePetSize;

    include('header.php');
    include('keeper-nav-bar.php');
    require_once("validate-session.php");
?> 
        <form action="<?php echo FRONT_ROOT."Keeper/showModifyKeeperProfile" ?>"method="post">
          <table style="text-align:center;">
            <thead>
              <tr>
                <th style="width: 100px;">Address</th>
                <th style="width: 100px;">Pet Size</th>
                <th style="width: 170px;">Initial Date</th>
                <th style="width: 120px;">End Date</th>
                <th style="width: 100px;">Your Price</th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                      <td><?php echo $keeper->getAddress() ?></td>
                      <td><?php echo $keeper->getPetSize() ?></td>
                      <td><?php echo $keeper->getInitialDate() ?></td>
                      <td><?php echo $keeper->getEndDate() ?></td>
                      <td><?php echo $keeper->getPrice() ?></td>
                    </tr>                        
            </tbody>
          </table>
          <input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>
          </form>