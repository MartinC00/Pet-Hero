<?php
include('header.php');
include('owner-nav-bar.php');
require_once("validate-session.php");
?>

<h1> list of pets!</h1>



<table style="text-align:center;">
            <thead>
              <tr>
                <th style="width: 100px;">Name</th>
                <th style="width: 170px;">Breed</th>
                <th style="width: 120px;">Size</th>
                <th style="width: 400px;">Descripcion</th>
                <th style="width: 110px;">Photo</th>                
                <th style="width: 120px;">Vaciness</th>
                <th style="width: 120px;">Video</th>
              </tr>
            </thead>
            <tbody>
              <?php /// OJO CON ESTO: HAY QUE SOLUCIONAR EL TEMA DE FOTO Y VIDEO EN FORMULARIO DE CARGA
              	    /// FALTA AGREGAR UN BOTON REMOVE QUE MANDE EL ID DE LA PET

                foreach($userPetsList as $pet)
                {
                  ?>
                    <tr>
                      <td><?php echo $pet->getName() ?></td>
                      <td><?php echo $pet->getBreed() ?></td>
                      <td><?php echo $pet->getSize() ?></td>
                      <td><?php echo $pet->getDescription() ?></td>
                      <td><?php echo $pet->getPhoto() ?></td>
                      <td><?php echo $pet->getVaciness() ?></td>
                      <td><?php echo $pet->getVideo() ?></td>
                    </tr>
                  <?php
                }
              ?>                           
            </tbody>
          </table>