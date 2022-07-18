<div class="home-content login-box">

    <div class="row d-flex justify-content-center align-items-center flex-column h-100">
    <?php 
        $messages = $this->messenger->getMessages();
        if (!empty($messages))
        {
            foreach ($messages as $message) {
                $typeMsg = [];
                if ($message[1] == 1) {
                    $typeMsg['type'] = '<i class="fa-solid fa-circle-check check icon-message t'.$message[1].'"></i>' ;
                    $typeMsg['msg'] = 'Success!' ;
                }
                elseif ($message[1] == 2) {
                    $typeMsg['type'] = '<i class="fa-solid fa-circle-exclamation check icon-message t'.$message[1].'"></i>' ;
                    $typeMsg['msg'] = 'Failed!' ;
                }
                elseif ($message[1] == 3) {
                    $typeMsg['type'] = '<i class="fa-solid fa-circle-info check icon-message t'.$message[1].'"></i>' ;
                    $typeMsg['msg'] = 'Info!' ;
                }
                elseif ($message[1] == 4) {
                    $typeMsg['type'] = '<i class="fa-solid fa-triangle-exclamation check icon-message t'.$message[1].'"></i>' ;
                    $typeMsg['msg'] = 'Warning!' ;
                }
                echo '<div class="d-flex justify-content-center align-items-center mb-5">
                        <div class="my-alert-2 message t'.$message[1].'">
                            <div class="my-alert-2-content ">
                                '.$typeMsg['type'].'
                                <div class="message_content">
                                    <span class="text-alert text-1"><strong>'.$typeMsg['msg'].'</strong></span>
                                    <span class="text-alert text-2">'. $message[0].'</span>
                                </div>
                            </div>
                        </div>
                    </div>' ;
            }
        }
    ?>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $login_header ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Username"  name="ucname" required>
                        <label for="Username"><?php echo $login_ucname ?></label>
                    </div>
                    <div class="input-box">
                        <input type="password" spellcheck="false" id="Password"  name="ucpwd" required>
                        <label for="Password"><?php echo $login_ucpwd ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="login" value="<?php echo $login_button ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="image">
        <img src="/img/login_image1.svg" alt="loginImage">
    </div> -->
</div>