<?php
    include('header.php');
    include('guest-nav-bar.php');
    use Models\UserType;
?>

<h1> Welcome !</h1>
<h2> Complete Your Data </h2>

<?php echo $message; ?>

<form action="<?php echo FRONT_ROOT ."User/add" ?>" method="post">
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
                <th><label for="usertype">Type</label></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="username" id="username" required></td>
                <td><input type="password" name="password" id="password" required></td>
                <td><input type="text" name="name" id="name" required></td>
                <td><input type="text" name="lastname" id="lastname" required></td>
                <td><input type="text" name="dni" id="dni" maxlength="8" minlength="7" required></td>
                <td><input type="number" name="phone" id="phone" required></td>
                <td><input type="email" name="email" id="email" required></td>
                <td><select name="userTypeId" required>
                        <?php foreach($userTypeList as $userType) { ?>
                            <option value="<?php echo $userType->getId() ?>"><?php echo $userType->getNameType() ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>

	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>
<form action="<?php echo FRONT_ROOT ."Home/Index" ?>" method="get">
    <input type="submit" value="Return">
</form>