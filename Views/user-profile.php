<?php
    include('header.php');
    if($_SESSION['loggedUser']->getUserType() == "Owner") include('owner-nav-bar.php');
    else include('keeper-nav-bar.php');
    require_once("validate-session.php");
?>

<form action="<?php echo FRONT_ROOT."User/showModifyUserProfile" ?> " method="post">
    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Username</th>
                <th style="width: 100px;">Nombre</th>
                <th style="width: 150px;">Apellido</th>
                <th style="width: 150px;">DNI</th>
                <th style="width: 150px;">Phone Number</th>
                <th style="width: 250px;">email</th>
                <th style="width: 150px;">User Type</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $user->getUsername() ?></td>
                <td><?php echo $user->getName() ?></td>
                <td><?php echo $user->getLastName() ?></td>
                <td><?php echo $user->getDNI() ?></td>
                <td><?php echo $user->getPhone() ?></td>
                <td><?php echo $user->getEmail() ?></td>
                <td><?php echo $user->getUserType() ?></td>
                <td><button type="submit"> Change my profile </button></td>
            </tr>
        </tbody>
    </table>
</form>
