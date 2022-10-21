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
                <th style="width: 120px;">Vaccines</th>
<!--                <th style="width: 120px;">Video</th>-->
              </tr>
            </thead>
            <tbody>
              <?php foreach($userPetsList as $pet) { ?>
                    <tr>
                      <td><?php echo $pet->getName(); ?></td>
                      <td><?php echo $pet->getBreed(); ?></td>
                      <td><?php echo $pet->getSize(); ?></td>
                      <td><?php echo $pet->getDescription(); ?></td>
                      <td><img src="<?php echo IMG_PATH.$pet->getPhoto(); ?>" height="100" width="100" ></td>
                      <td><img src="<?php echo IMG_PATH.$pet->getVaccines(); ?>" height="100" width="100" ></td>
<!--                      <td>--><?php //echo $pet->getVideo() ?><!--</td>-->
                    </tr>
                <?php } ?>
            </tbody>
          </table>