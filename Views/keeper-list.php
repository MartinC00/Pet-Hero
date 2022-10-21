<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");
?>

<h2> KEEPERs LIST </h2>

<table style="text-align:center;">
            <thead>
              <tr>
                <th style="width: 100px;">Name</th>
                <th style="width: 170px;">Lastname</th>
                <th style="width: 110px;">Phone number</th>
                <th style="width: 110px;">Email</th>
                <th style="width: 400px;">Adress</th>
                <th style="width: 110px;">Pet Size</th>
                <th style="width: 110px;">Initial Date</th>
                <th style="width: 110px;">End Date</th>
                <th style="width: 110px;">Price</th>

                                
<!--                <th style="width: 120px;">Vaciness</th>-->
<!--                <th style="width: 120px;">Video</th>-->
              </tr>
            </thead>
            <tbody>
              <?php /// OJO CON ESTO: HAY QUE SOLUCIONAR EL TEMA DE FOTO Y VIDEO EN FORMULARIO DE CARGA
                    /// FALTA AGREGAR UN BOTON REMOVE QUE MANDE EL ID DE LA PET
                
                foreach($keeperList as $keeper)
                {
                    $user = $this->userDAO->getById($keeper->getUserId());
                  ?>
                    <tr>
                      <td><?php echo $user->getName() ?></td>
                      <td><?php echo $user->getLastname() ?></td>
                      <td><?php echo $user->getPhone() ?></td>
                      <td><?php echo $user->getEmail() ?></td>
                      <td><?php echo $keeper->getAddress() ?></td>
                      <td><?php echo $keeper->getPetSize() ?></td>
                      <td><?php echo $keeper->getInitialDate() ?></td>
                      <td><?php echo $keeper->getEndDate() ?></td>
                      <td><?php echo $keeper->getPrice() ?></td>
                    </tr>
                  <?php
                }
              ?>                           
            </tbody>
          </table>