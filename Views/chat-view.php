<?php
    include('header.php');
    if($logged->getUserType()->getId() == 1)
        include('owner-nav-bar.php');
    else
        include('keeper-nav-bar.php');
?>

<?php if(isset($viewMessage)) echo $viewMessage; ?>

<h2 style="text-align: center"> Chat with <?php echo $name; ?></h2>

<div class="chat-box">
    <?php foreach($messageList as $message) {
        if($message->getIdSender() == $logged->getId()) { ?>
            <p data-time="<?php echo $message->getDate() ?>" class="msg sent"><?php echo $message->getMessage(); ?></p>
        <?php } else { ?>
            <p class="msg rcvd"><?php echo $message->getMessage() ?></p>
    <?php } } ?>
</div>
<div class="chat-input">
    <form action="<?php echo FRONT_ROOT."ChatMessage/add" ?>" method="post">
        <input type="text" id="newMessage" name="newMessage" maxlength="100" required>
        <input type="hidden" name="name" value="<?php echo $name; ?>" readonly>
        <button type="submit" name="chatId" value="<?php echo $chatId; ?>" style="width: available">ENVIAR</button>
    </form>
</div>
