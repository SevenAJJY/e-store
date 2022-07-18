<!-- Start Sidebar -->
    <div class="sidebar close" style="direction:<?= ($_SESSION['lang'] == 'ar')? 'rtl' : 'ltr'; ?>">
        <div class="logo-details">
        <!-- <i class="fa-brands fa-shopify logo"></i> -->
        <div class="logo">
            <img src="/img/estoreLogo.png"  alt="">
        </div>
        <span class="logo_name"> eStore </span>
        </div>
        <i class="fa-solid fa-angle-right bx-menu"></i>
        <ul class="nav-links">
            <li class="<?= ($this->matchUrl('/')) === true ? ' selected' : '' ?>">
                <a href="/">
                    <i class="fa-solid fa-chart-column "></i>
                    <span class="link_name"><?php echo $text_general_statistics; ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#"><?php echo $text_general_statistics; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu(['purchses', 'sales'])) === true ? ' selected' : '' ?>">
                <div class="iocn-link">
                    <a href="javascript:;">
                        <i class="fa-solid fa-arrow-right-arrow-left "></i>
                        <span class="link_name"><?php echo $text_transactions; ?></span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="javascript:;"><?php echo $text_transactions; ?></a></li>
                    <li><a href="/purchases"><i class="fa-solid fa-gift sub-icons"></i><?php echo $text_transactions_purchases; ?></a></li>
                    <li><a href="/sales"><i class="fa-solid fa-bag-shopping sub-icons"></i><?php echo $text_transactions_sales; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu(['transactions', 'expensescategories', 'dailyexpenses'])) === true ? ' selected' : '' ?>">
                <div class="iocn-link">
                    <a href="javascript:;">
                        <i class="fa-solid fa-wallet "></i>
                        <span class="link_name"><?php echo $text_expences; ?></span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="/transactions" class="link_name"><?php echo $text_expences; ?></a></li>
                    <li><a href="/expensescategories"><i class="fa-solid fa-tags sub-icons"></i><?php echo $text_expences_categories; ?></a></li>
                    <li><a href="/dailyexpenses"><i class="fa-solid fa-circle-dollar-to-slot sub-icons"></i><?php echo $text_expences_daily_expences; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu(['productcategories', 'productlist'])) === true ? ' selected' : '' ?>">
                <div class="iocn-link">
                    <a href="javascript:;">
                        <i class="fa-solid fa-store "></i>
                        <span class="link_name"><?php echo $text_store; ?></span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#"><?php echo $text_store; ?></a></li>
                    <li><a href="/productcategories"><i class="fa-solid fa-sitemap sub-icons"></i><?= $text_store_categories ?></a></li>
                    <li><a href="/productlist"><i class="fa-solid fa-tags sub-icons"></i><?= $text_store_pruducts ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu('clients')) === true ? ' selected' : '' ?>">
                <a href="/clients">
                    <i class="fa-solid fa-user-tie "></i>
                    <span class="link_name"><?php echo $text_clients; ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/clients"><?php echo $text_clients; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu('suppliers')) === true ? ' selected' : '' ?>">
                <a href="/suppliers">
                    <i class="fa-solid fa-user-group"></i>
                    <span class="link_name"><?php echo $text_suppliers; ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/suppliers"><?php echo $text_suppliers; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu(['users', 'usersgroups', 'privileges'])) === true ? ' selected' : '' ?>">
                <div class="iocn-link">
                    <a href="javascript:;">
                    <i class="fa-solid fa-users"></i>
                        <span class="link_name"><?php echo $text_users  ; ?></span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li class=""><a class="link_name" href="#"><?php echo $text_users  ; ?></a></li>
                    <li><a href="/users"><i class="fa-solid fa-circle-user sub-icons"></i><?= $text_users_list  ?></a></li>
                    <li><a href="/usersgroups"><i class="fa-solid fa-users-gear sub-icons"></i><?= $text_users_groups  ?></a></li>
                    <li><a href="/privileges"><i class="fa-solid fa-key sub-icons"></i><?= $text_users_privileges  ?></a></li>
                </ul>
            </li>
            <!-- <li class="<?= ($this->highlightMenu('reports')) === true ? ' selected' : '' ?>">
                <a href="/reports">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span class="link_name"><?php echo $text_reports ; ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users"><?php echo $text_reports ; ?></a></li>
                </ul>
            </li> -->
            <li class="<?= ($this->highlightMenu('notifications')) === true ? ' selected' : '' ?>">
                <a href="/notifications">
                <i class="fa-regular fa-bell"></i>
                    <span class="link_name"><?php echo $text_notifications; ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/notifications"><?php echo $text_notifications; ?></a></li>
                </ul>
            </li>
            <li class="<?= ($this->highlightMenu('language')) === true ? ' selected' : '' ?>">
                <a href="/language">
                <i class="icon-language"></i>
                    <span class="link_name"><?= $_SESSION['lang'] == 'ar' ? 'En' : 'عربي' ?></span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/language"><?php echo $text_change_language; ?></a></li>
                </ul>
            </li>
            <li>
                <div class="mode">
                    <div class="moon-sun">
                        <i class="fa-regular fa-moon moon"></i>
                        <i class="fa-regular fa-sun sun"></i>
                    </div>
                    <span class="mode-text text <?= ($_SESSION['lang'] == 'ar')? 'me-3' : ''; ?>" >Dark Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                    
                </div>
            </li>
        
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <?php
                        
                            $imageProfile = !empty($this->session->u->profile->Image) ? $this->session->u->profile->Image : 'noImage.jpg';
                        ?>
                        <img src="/uploads/images/<?= $imageProfile ?>" class="image" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo $this->session->u->profile->FirstName ;?></div>
                        <div class="job"><?php echo $this->session->u->GroupName ;?></div>
                    </div>
                    <a href="/auth/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </li>
        </ul>
    </div>

    <!-- End Sidebar -->

