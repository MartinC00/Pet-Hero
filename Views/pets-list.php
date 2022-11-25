<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");
?>

<h1> List of your pets!</h1>

<?php if(isset($message)) echo $message ?>

<form action="<?php echo FRONT_ROOT . "Pet/showModifyPetView" ?>" method="post">
    <table style="text-align:center;">
        <thead>
            <tr>
            <th style="width: 100px;">PetType</th>
            <th style="width: 100px;">Name</th>
            <th style="width: 170px;">Breed</th>
            <th style="width: 120px;">Size</th>
            <th style="width: 400px;">Description</th>
            <th style="width: 110px;">Photo</th>
            <th style="width: 120px;">Vaccines</th>
            <th style="width: 120px;">Video</th>
            <th style="width: 120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($userPetsList as $pet) { ?>
                <tr>
                    <td><?php echo $pet->getPetType()->getName(); ?></td>
                    <td><?php echo $pet->getName(); ?></td>
                    <td><?php echo $pet->getBreed(); ?></td>
                    <td><?php echo $pet->getSize(); ?></td>
                    <td><?php echo $pet->getDescription(); ?></td>
                    <td> <img src="<?php echo IMG_PATH.$pet->getPhoto(); ?>" height="100" width="100" > </td>
                    <td><img src="<?php echo IMG_PATH.$pet->getVaccines(); ?>" height="100" width="100" ></td>
                    <td><video width="320" controls><source src="<?php echo IMG_PATH.$pet->getVideo(); ?>" type="video/mp4">
                     Your browser does not support the video tag.</video>
                    </td>
                    <td>
                        <button type="submit" value="<?php echo $pet->getId() ?>" name="id"> Modify </button>
                        <button type="submit" value="<?php echo $pet->getId() ?>" name="id" formaction="<?php echo FRONT_ROOT . "Pet/remove" ?>"> Delete </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</form>



<?php /*            include_once "db_empresa.php";
                    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
                    $query="SELECT photo FROM pets ";
                    $res = mysqli_connect($con,$query); */
                    ?>