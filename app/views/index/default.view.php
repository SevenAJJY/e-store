<?php $this->matchUrl('/');?>

<div class="home-content"  style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
    <div class=" analytics row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an1">
                <i class="fa-solid fa-people-carry-box"></i>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_users ?></h4>
                    <h1><?= $users  ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_suppliers ?></h4>
                    <h1><?= $suppliers  ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an3">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="analytic-info ">
                    <h4><?= $text_total_clients ?></h4>
                    <h1><?= $clients  ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                        <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                        <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_products ?></h4>
                    <h1><?=$products ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_expences ?></h4>
                    <h1><?= $dailyExpences ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_privileges ?></h4>
                    <h1><?=$privileges ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an7">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_sales ?></h4>
                    <h1><?=$sales ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="analytic">
                <div class="analytic-icon an8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                    </svg>
                </div>
                <div class="analytic-info">
                    <h4><?= $text_total_purchases ?></h4>
                    <h1><?=$purchases ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 g-3">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                        # <?= $text_latest_products ?>
                    </button>
                    </h2>
                    <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php if(false !== $latest_products): foreach($latest_products as $product): ?>
                            <div class="products">
                                <div class="product-img <?= ($_SESSION['lang'] == 'ar')? 'ms-5' : 'me-5'; ?>">
                                    <img src="/uploads/images/<?= $product->Image ?>" alt="">
                                </div>
                                <div class="puduct-info">
                                    <p class="product-name"><?= $text_product_name ?> <?= $product->Name ?></p>
                                    <span class="product-quantity"><?= $text_product_quantity ?>  <?= $product->Quantity ?></span>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        # <?= $text_latest_sales; ?>
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php if(false !== $invoices_sales): foreach($invoices_sales as $sale): ?>
                                <div class="transactions">
                                    <div class="c-name">
                                        <p class="product-name">
                                        <?= $sale->ClientName ?> <i class="fa-solid fa-angle-right"></i></p>
                                    </div>
                                    <div class="trans-info ">
                                        <p class="product-quantity mb-1"><?= $text_invoice_total; ?> <?=  round($sale->total,2) ?>  $</p>
                                        <span class="product-quantity"><?= $text_invoice_delivery; ?> <span class="added-to-store added-<?= $sale->ProductsDelivery ?>"> <?= ${'text_product_delivry_' . $sale->ProductsDelivery}; ?> </span> </span>
                                        <p class="product-name mt-1"><?= $text_invoice_created; ?><?= (new DateTime($sale->Created))->format("Y/m/d") ?></p>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne2">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                        # <?= $text_latest_purchases; ?>
                    </button>
                    </h2>
                    <div id="collapseOne2" class="accordion-collapse collapse show" aria-labelledby="headingOne2" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php if(false !== $invoices_purchases): foreach($invoices_purchases as $purchase): ?>
                                <div class="transactions">
                                    <div class="c-name">
                                        <p class="product-name">
                                        <?= $purchase->supplier ?> <i class="fa-solid fa-angle-right"></i></p>
                                    </div>
                                    <div class="trans-info ">
                                        <p class="product-quantity mb-1"><?= $text_invoice_total; ?> <?=  round($purchase->total,2) ?>  DH</p>
                                        <span class="product-quantity"><?= $text_invoice_delivery; ?> <span class="added-to-store added-<?= $purchase->AddedToStore ?>"> <?= ${'text_added_to_store_' . $purchase->AddedToStore}; ?> </span> </span>
                                        <p class="product-name mt-1"><?= $text_invoice_created; ?><?= (new DateTime($purchase->Created))->format("Y/m/d") ?></p>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne4">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne">
                        # <?= $text_latest_daily_expences; ?>
                    </button>
                    </h2>
                    <div id="collapseOne4" class="accordion-collapse collapse show" aria-labelledby="headingOne4" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php if(false !== $latest_expences): foreach($latest_expences as $expence): ?>
                                <div class="transactions">
                                    <div class="trans-info ">
                                        <span class="ex-category fw-bold"><?= $text_category_label; ?>  <?=$expence->Name ?> </span>
                                        <p class="product-quantity mb-1 ms-3"><?= $text_table_price; ?> <?=  round($expence->Payment,2) ?>  DH</p>
                                        <p class="product-name mt-1 ms-3"><?= $text_table_created; ?> <?=$expence->Created ?></p>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


