<?php use Models\eUserType; ?>

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
                <td><select name="userType" id="usertype">
                        <option value="<?php echo eUserType::Owner->name; ?>"> Owner </option>
                        <option value="<?php echo eUserType::Keeper->name; ?>"> Keeper </option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>

	<input type="submit" value="Agregar" style="background-color:#DC5E47;color:black;"/>
</form>