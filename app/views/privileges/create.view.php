<div class="home-content">
    <div class="row">
            <h1 class="main-title text-center"><?php echo $text_header ;?></h1>

        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container">
                <h4><?php echo $text_legend ?></h4>
                <form action="" class="appform" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="PrivilegeTitle" maxlength="50" required>
                        <label for=""><?php echo $text_label_privilege_title ?></label>
                    </div>
                    <div class="input-box">
                        <input type="text" spellcheck="false" name="Privilege" maxlength="50" required>
                        <label for=""><?php echo $text_label_privilege_url ?></label>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="save" value="<?php echo $text_label_save ?>" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>