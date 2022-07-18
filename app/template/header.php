<div class="main-content">
        <section class="home-section">
            <!-- Start Navbar -->

        <header class="header-n">
        <div class="nav-n" id="navbar">
            <div class="menu-n">
                <div>
                    <?php
                        $imageProfile = !empty($this->session->u->profile->Image) ? $this->session->u->profile->Image : 'noImage.jpg';
                    ?>
                    <div class="info-n">
                        <img src="/uploads/images/<?= $imageProfile ?>" class="logo-n">
                    </div>
                    <span><?= $this->session->u->profile->FirstName ;?> <?= $this->session->u->profile->LastName ;?></span>
                    <ul class="profile-n">
                        <li><a href="/users/view">My Profile</a></li>
                        <li><a href="/users/editprofile">Edit Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>

                    <ul>
                        <li><a href="/"><?= $text_dashboard ; ?></a></li>
                        <li><a href="/language"><?= $_SESSION['lang'] == 'ar' ? 'En' : 'عربي' ?></a></li>
                        <!-- <li><a href="#">Store</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li> -->
                    </ul>
                    <ul class="social-media">
                        <li><a href="https://www.facebook.com/marwa.brada.39"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/yassine_elhajjy/?hl=fr"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/yassine-elhajjy-bab1ba233/"><i class="fa-brands fa-linkedin"></i></a></li>
                    </ul>
                    <!-- <form class="form-n" action="">
                        <div class="input-wrap">
                            <input type="search" name="" placeholder="Search..." />
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form> -->
                </div>
            </div>
            <div class="container-n">
                <span class="brand-n"><?php if (isset($title)) {
                        echo ' > ' . $title ;
                    } ?></span>
                <div class="container-inner">
                    <ul>
                        <li class="center"><a href="/"><?= $text_dashboard ; ?></a></li>
                        <li class="center"><a href="/language"><?= $_SESSION['lang'] == 'ar' ? 'En' : 'عربي' ?></a></li>
                    </ul>
                    <a  class="photo-name-n <?= ($this->matchUrl('/users/view')) === true ? 'active-n' : '' ?>" href="/users/view">
                        <div class="photo-n">
                            <img src="/uploads/images/<?= $imageProfile ?>" alt="">
                        </div>
                        <span class="name-n"><?= $this->session->u->profile->FirstName ;?></span>
                    </a>
                </div>
                <div class="menu-icon-n" id="menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>

        </section>

        
        <?php 
            $messages = $this->messenger->getMessages();
            if (!empty($messages))
            {
                foreach ($messages as $message) {
                    /**
                     * 
                     * @var array
                     */
                    $typeMsg = [];
                    switch ($message[1]) {
                        case 1:
                            $typeMsg['type'] = 'fa-regular fa-circle-check' ;
                            $typeMsg['msg'] = 'Success!' ;
                            break;
                        case 2:
                            $typeMsg['type'] = 'fa-solid fa-circle-exclamation' ;
                            $typeMsg['msg'] = 'Failed!' ;
                            break;
                        case 3:
                            $typeMsg['type'] = 'fa-solid fa-circle-info' ;
                            $typeMsg['msg'] = 'Info!' ;
                            break;
                        case 4:
                            $typeMsg['type'] = 'fa-solid fa-triangle-exclamation' ;
                            $typeMsg['msg'] = 'Warning!' ;
                            break;
                    }
                    echo '<div class="d-flex justify-content-center">
                            <div class="my-alert-2 message t'.$message[1].'">
                                <div class="my-alert-2-content ">
                                <i class="'.$typeMsg['type'].' check _icon-message t'.$message[1].'"></i>
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
        
    <!-- End Navbar -->