<?php
    include('header.php');
    include('owner-nav-bar.php');

    use Models\Chat;
?> 

<h2> My chats</h2>

<?php if(isset($message)) echo $message; ?>

    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Keeper</th>
                <th style="width: 170px;">Chat Status</th>
                <th style="width: 170px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($chatList as $chat) { ?>
                <tr>
                    <td><?php echo $chat["keeperName"] ?></td>
                    <td><?php if($chat["status"] == 1) echo "Accepted";
                        else if($chat["status"] == 2) echo "Pending";
                        else echo "Rejected"; ?>
                    </td>
                    <td>
                        <?php if($chat["status"] == 1) { ?>
                            <form action="<?php echo FRONT_ROOT."Chat/showChatView" ?>" method="post">
                                <input type="hidden" name="name" value="<?php echo $chat["keeperName"]; ?>">
                                <button type="submit" name="chatId" value="<?php echo $chat["id"]?>"> GO TO CHAT </button>
                            </form>
                        <?php } else echo "No actions"; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>