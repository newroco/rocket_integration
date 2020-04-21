<?php
script('rocket_integration', 'chat');
style('rocket_integration', 'style');
?>

<?php if ($_['new'] === '1') { ?>
    <div class="messenger--add-members-info"> Add members to discussion by clicking the members button. </div>
<?php } ?>

<iframe id="rocket-chat-iframe" src="<?php p($_['url']); ?>" allowfullscreen></iframe>
