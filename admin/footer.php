<?php if (!empty($_SESSION['current_user'])) { ?>
    <div class="clear-both"></div>
    </div>
    </div>
    <div id="admin-footer">
        <div class="container">
            <div class="right-panel">
                © Copyright 2022 - Fahasa
            </div>
            
            <div class="clear-both"></div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="box-content">
            The account has not been set-up yet. Please return to sign-in <a href="index.php">Click-here</a>
        </div>
    </div>
<?php } ?>
</body>
</html>