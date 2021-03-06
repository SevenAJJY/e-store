<div class="home-content">
    <div class="row">
            <h1 class="main-title text-center"><?= $text_header ;?></h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container fuser">
                <h4><?= $text_legend ?></h4>
                <form action="" class="appform row" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" name="Name" maxlength="20" value="<?= $this->showValue('Name', $product) ?>" required>
                            <label for=""><?= $text_label_Name ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" name="Quantity" min="1" step="1" value="<?= $this->showValue('Quantity', $product) ?>" required />
                            <label><?= $text_label_Quantity ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" name="BuyPrice" min="1" step="0.01" value="<?= $this->showValue('BuyPrice', $product) ?>" required />
                            <label><?= $text_label_BuyPrice ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" name="SellPrice" min="1" step="0.01" value="<?= $this->showValue('SellPrice', $product) ?>" required />
                            <label><?= $text_label_SellPrice ?></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                        <select class="form-select select-box" name="Unit" required>
                            <option value="" selected><?= $text_label_Unit ?></option>
                            <option value="1" <?= $this->seletedIf('Unit' , $product->Unit , $product);  ?>><?= $text_unit_1 ?></option>
                            <option value="2" <?= $this->seletedIf('Unit' , $product->Unit , $product);  ?>><?= $text_unit_2 ?></option>
                            <option value="3" <?= $this->seletedIf('Unit' , $product->Unit , $product);  ?>><?= $text_unit_3 ?></option>
                            <option value="4" <?= $this->seletedIf('Unit' , $product->Unit , $product);  ?>><?= $text_unit_4 ?></option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <select class="form-select select-box" name="CategoryId" required >
                                <option value="" selected><?= $text_label_CategoryId ?></option>
                                <?php if (false !== $categories): ?>
                                    <?php foreach ($categories as $category):?>
                                        <option value="<?= $category->CategoryId ?>" <?= $this->seletedIf('CategoryId' , $product->CategoryId , $product);  ?> ><?= $category->Name ?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div class=" col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-sm-12">
                        <div class="input-box">
                            <input type="file" accept="image/" spellcheck="false" id="file" name="image" accept="image/*" />
                            <label for="file"><i class="fa-solid fa-cloud-arrow-up"></i><span class="ms-4"><?= $text_label_Image ?></span></label>
                        </div>
                    </div>
                    <?Php if($product->Image !== null): ?>
                        <div class="input-box image-box mt-5">
                            <div class="image mt-5">
                                <img src="/uploads/images/<?= $product->Image ?>" class="" width="50%">
                            </div>
                        </div>
                    <?Php endif; ?>
                    <div class=" col-md-12 col-lg-12 col-sm-12 mt-3">
                        <div class="input-box mt-3">
                            <input type="submit" class="mt-3" name="submit" value="<?= $text_label_save ?>" maxlength="30" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
