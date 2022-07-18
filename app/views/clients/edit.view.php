<div class="home-content">
    <div class="row">
            <h1 class="main-title text-center"><?php echo $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Name"  name="Name" maxlength="50" value="<?php echo $this->showValue('Name',$supplier) ?>"  required>
                        <label for="Name"><?php echo $text_label_Name ?></label>
                    </div>
                    <div class="input-box">
                        <input type="email" spellcheck="false" id="Email"  name="Email" maxlength="40" value="<?php echo $this->showValue('Email',$supplier) ?>"  required>
                        <label for="Email"><?php echo $text_label_Email ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Number"  name="PhoneNumber" maxlength="15" value="<?php echo $this->showValue('PhoneNumber',$supplier) ?>"  required>
                        <label for="Number"><?php echo $text_label_PhoneNumber ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" id="Address"  name="Address" maxlength="50" value="<?php echo $this->showValue('Address',$supplier) ?>"  required>
                        <label for="Address"><?php echo $text_label_Address ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="submit" value="<?php echo $text_label_save ?>" maxlength="30" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>