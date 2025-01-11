<?php
if ($pPageIsPublic && (ereg('(log(in|out)|user_password)\.php',$_SERVER['PHP_SELF']))) {
?>
</div>
<?php
} else {
?>
    <div id="footer" style="margin:30px;">
    <?php
    if (@is_dir('install')) {
        echo '<p class="tznError"><b>'.$GLOBALS['langMenu']['warning'].':</b> '.$GLOBALS['langMenu']['warning_install'].'</p>';
    }
    ?>
      
    </div>
</div>
<?php
}   
?>
</body>
</html>
