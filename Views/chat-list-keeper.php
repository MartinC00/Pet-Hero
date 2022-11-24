<?php
    require_once("validate-session.php");
    include('header.php');
    include('keeper-nav-bar.php');

    use Models\Chat;
?> 

<h2> My chats</h2>

<?php if(isset($message)) echo $message; ?>

    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Owner</th>
                <th style="width: 170px;">Chat Status</th>
                <th style="width: 170px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($chatList as $chat) { ?>
                <tr>
                    <td><?php echo $chat["ownerName"] ?></td>

                    <?php if($chat["status"] == 1) { ?>
                      <td>Accepted</td>
                        <form action="<?php echo FRONT_ROOT."Chat/showChatView" ?>" method="post">
                            <input type="hidden" name="ownerName" value="<?php echo $chat["ownerName"] ?>">
                            <td><button type="submit" value="<?php echo $chat["id"]?>"> GO TO CHAT </button></td>
                        </form>
                    <?php } else if($chat["status"] == 2) { ?>
                      <td>Pending</td>
                        <td>
                            <form action="<?php echo FRONT_ROOT."Chat/modifyStatus" ?>" method="post">
                                <input type="hidden" name="chatId" value="<?php echo $chat["id"]?>">
                                <button type="submit" name="status" value="1"> ACCEPT </button>
                                <button type="submit" name="status" value="0"> REJECT </button>
                            </form>
                        </td>
                    <?php } else { ?> <td> Rejected </td> <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>