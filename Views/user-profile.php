<?php
    include('header.php');
    if($_SESSION['loggedUser']->getUserType()->getId() == 1) include('owner-nav-bar.php');
    else include('keeper-nav-bar.php');
    require_once("validate-session.php");
?>

<form action="<?php echo FRONT_ROOT."User/showModifyUserProfile" ?> " method="post">
    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Username</th>
                <th style="width: 100px;">Name</th>
                <th style="width: 150px;">Lastname</th>
                <th style="width: 150px;">DNI</th>
                <th style="width: 150px;">Phone Number</th>
                <th style="width: 250px;">Email</th>
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
                <td><?php echo $user->getUserType()->getNameType() ?></td>
                <td><button type="submit"> Change my profile </button></td>
            </tr>
        </tbody>
    </table>
</form>
