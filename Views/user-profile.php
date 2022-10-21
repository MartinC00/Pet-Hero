<?php
    include('header.php');
    include('owner-nav-bar.php');
    require_once("validate-session.php");
?>
<h2> MOSTRAMOS EL PERFIL Y AGREGAMOS BOTON "CHANGE MY PROFILE" QUE REDIRIJA A User/ShowModifyUserProfile (controladora de User, metodo ModifyUserProfile) </h2>

<form action="<?php echo FRONT_ROOT."User/showModifyUserProfile" ?>">
    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Nombre</th>
                <th style="width: 170px;">Apellido</th>
                <th style="width: 120px;">DNI</th>
                <th style="width: 400px;">Phone Number</th>
                <th style="width: 110px;">email</th>
                <th style="width: 120px;">User Type</th>
                <th style="width: 120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($userList as $user) { ?>
            <tr>
                <td><?php echo $user->getName() ?></td>
                <td><?php echo $user->getLastName() ?></td>
                <td><?php echo $user->getDNI() ?></td>
                <td><?php echo $user->getPhone() ?></td>
                <td><?php echo $user->getEmail() ?></td>
                <td><?php echo $user->getUserType() ?></td>
                <td><button type="submit" name="id" value="<?php echo $user->getId() ?>"> Change my profile </button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</form>
