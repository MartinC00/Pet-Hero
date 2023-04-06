<?php
    include('header.php');
    if($_SESSION['loggedUser']->getUserType()->getId() == 1) include('owner-nav-bar.php');
    else include('keeper-nav-bar.php');
    require_once("validate-session.php");
?>
<h2> Complete Your Data </h2>

<?php if(isset($message)) echo $message; ?>

<form action="<?php echo FRONT_ROOT ."User/modifyProfile" ?>" method="post">
    <table>
        <thead>
            <tr>
                <th><label for="username">Username</label></th>
                <th><label for="password">Password</label></th>
                <th><label for="name">Name</label></th>
                <th><label for="lastname">Lastname</label></th>
                <th><label for="dni">DNI</label></th>
                <th><label for="phone">Phone #</label></th>
                <th><label for="email">Email</label></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="username" id="username" value="<?php echo $user->getUsername(); ?>" minlength="5"required></td>
                <td><input type="password" name="password" id="password" value="<?php echo $user->getPassword(); ?>" minlength="3" required></td>
                <td><input type="text" name="name" id="name" value="<?php echo $user->getName(); ?> "required></td>
                <td><input type="text" name="lastname" id="lastname" value="<?php echo $user->getLastname(); ?> "required></td>
                <td><input type="text" name="dni" id="dni" value="<?php echo $user->getDni(); ?>" required></td>
                <td><input type="number" name="phone" id="phone" value="<?php echo $user->getPhone(); ?>"required></td>
                <td><input type="email" name="email" id="email" value="<?php echo $user->getEmail(); ?>"required></td>
            </tr>
        </tbody>
    </table>
    <input type="submit" value="Modificar" style="background-color:#DC5E47;color:black;"/>
</form>