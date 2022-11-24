<?php
    include('header.php');
    if($_SESSION['loggedUser']->getUserType()->getId() == 1)
        include('owner-nav-bar.php');
    else
        include('keeper-nav-bar.php');
?>

<?php if(isset($viewMessage)) echo $viewMessage; ?>

<h2> CHAT WITH <?php echo $name ?></h2>

    <table style="text-align:center;">
        
        <tbody>
            <?php foreach($messageList as $message) { ?>
                <tr>
                    <td><?php $message ?>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>