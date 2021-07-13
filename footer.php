<?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    if ($curPageName!="index.php") { ?>
        <a href="index.php" class="new-btn new-btn-hipster btn-sm">< Back Home</a>
    <?php }
?>

</div>
</body>
<?php $conn->close() ?>
</html>
