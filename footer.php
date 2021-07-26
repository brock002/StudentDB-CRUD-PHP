<hr>
<?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    if ($curPageName!="index.php") { ?>
        <div class="new-title mt-3">
            <a href="index.php" class="new-title new-btn new-btn-hipster btn-sm">
                <i class="bi bi-house-fill"></i>
            </a>
        </div>
    <?php }
?>

</div>
<!-- local js -->
<script src="index.js"></script>
</body>
<?php $conn->close() ?>
</html>
