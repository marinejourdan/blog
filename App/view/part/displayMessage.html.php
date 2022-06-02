<?php
if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
    include_once("./errorsMessage.php");
?>
    <div class="errors">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error) {?>
                <li>
                    <?php
                    if(isset($errorsMessage[$error])){
                        echo $errorsMessage[$error];
                    }else{
                        echo $error;
                    }
                    ?>
                </li>
            <?php }?>
        </ul>
    </div>
<?php
    unset($_SESSION['errors']);
}

if(isset($_SESSION['valid']) && count($_SESSION['valid']) > 0){
    include_once("./validMessage.php");
?>
    <div class="validation">
        <ul>
            <?php foreach ($_SESSION['valid'] as $valid) {?>
                <li>
                    <?php
                    if(isset($validMessage[$valid])){
                        echo $validMessage[$valid];
                    }else{
                        echo $valid;
                    }
                    ?>
                </li>
            <?php }?>
        </ul>
    </div>
<?php
    unset($_SESSION['valid']);
}
?>
