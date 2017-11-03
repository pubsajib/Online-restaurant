<?php require_once "view/base/customer/header.php"?>

<?php
$banner_data = json_decode($bannerData->banner, true);
$banner_text = $banner_data['home_banner_text'];
?>

    <!-- Slide -->
    <section id="main-slider" data-background="assets/customer/img/main.jpg" class="parallax-window" style="background-image: url(assets/customer/img/main.jpg); background-position: 50% 0px;">
        <div class="section-slogan">
            <img src="assets/customer/img/logo.png" alt="">
            <h2><?php echo $banner_text?></h2>
            <h3>Fine Food + Drinks</h3>
        </div>
        <span class="scoll-down">Scroll Down</span>
    </section>
    <!-- End Slide -->

    <!-- Section Special Offers -->
    <section id="special-offers" class="padd-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="offer-left">
                        <span class="section-suptitle">From The Menu</span>
                        <h2 class="section-title">Special Offers</h2>
                        <?php if (!empty($offers)) foreach ($offers as $offer) {?>
                        <div class="offer-item">
                            <?php if (isset($offer->image_name) && $offer->image_name != '') {?>
                                <img src="<?= BASE_URL.'/assets/img/products/'.$offer->image_name ?>" alt="" class="img-responsive">
                            <?php } else {?>
                                <img src="<?= BASE_URL.'/assets/img/products/no_img.png' ?>" alt="" class="img-responsive">
                            <?php }?>

                            <div>
                                <h3><?= $offer->name ?></h3>
                                <p>
                                    <?= $offer->description ?>
                                </p>
                            </div>
                            <span class="offer-price">£<?= number_format($offer->offer_price, 2, '.', '') ?></span>
                        </div>
                        <?php } else {?>
                            <div class="offer-item">
                                <div>
                                    <h3>N/A</h3>
                                </div>
                            </div>
                        <?php } ?>
                        <!--<div class="offer-item">
                            <img src="assets/customer/img/23.jpg" alt="" class="img-responsive">
                            <div>
                                <h3>Cheese /Bacon,Coleslaw</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                                </p>
                            </div>
                            <span class="offer-price">£14</span>
                        </div>
                        <div class="offer-item">
                            <img src="assets/customer/img/24.jpg" alt="" class="img-responsive">
                            <div>
                                <h3>Croissant (Plain)</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                                </p>
                            </div>
                            <span class="offer-price">£12</span>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class="offer-right">
                        <img src="assets/customer/img/01.jpg" alt="" class="img-responsive">
                        <a href=#>
                            Explore
                            <span>The menu</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Special Offers -->



    <!-- Section Delas -->
    <section id="delas" class="padd-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <span class="section-suptitle text-center">Delas Today</span>
                    <h2 class="section-title sep-type-2 text-center">
                        Today Special Dish
                    </h2>
                    <div class="delas-carousel">
                        <div class="delas-item">
                            <img src="assets/customer/img/02.jpg" alt="" class="img-responsive">
                            <h4>Pring Veg & Pasta</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                            </p>
                            <span>Only £<?php echo number_format(25, 2, '.', '')?></span>
                        </div>
                        <div class="delas-item">
                            <img src="assets/customer/img/03.jpg" alt="" class="img-responsive">
                            <h4>Pring Veg & Pasta</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                            </p>
                            <span>Only £<?php echo number_format(25, 2, '.', '')?></span>
                        </div>
                        <div class="delas-item">
                            <img src="assets/customer/img/16.jpg" alt="" class="img-responsive">
                            <h4>Pring Veg & Pasta</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                            </p>
                            <span>Only £<?php echo number_format(25, 2, '.', '')?></span>
                        </div>
                        <div class="delas-item">
                            <img src="assets/customer/img/02.jpg" alt="" class="img-responsive">
                            <h4>Pring Veg & Pasta</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                            </p>
                            <span>Only £<?php echo number_format(25, 2, '.', '')?></span>
                        </div>
                        <div class="delas-item">
                            <img src="assets/customer/img/03.jpg" alt="" class="img-responsive">
                            <h4>Pring Veg & Pasta</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur Vesti bulum vel ipsum ullamcorper.
                            </p>
                            <span>Only £<?php echo number_format(25, 2, '.', '')?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Delas -->

    <!-- Section Restaurant Menu -->
    <section id="restaurant-menu" class="padd-100">
        <span class="section-suptitle text-center">Food Lover</span>
        <h2 class="section-title sep-type-2 text-center">
            resturant menu
        </h2>

        <div class="container">
            <div class="row">
                <ul class="restaurant-filter">
                    <li><a href="" class="current" data-filter="">All dishes</a></li>
                    <li><a href="" data-filter="dinner">dinner</a></li>
                    <li><a href="" data-filter="lunch">lunch</a></li>
                    <li><a href="" data-filter="drinks">drinks</a></li>
                    <li><a href="" data-filter="starters">starters</a></li>
                </ul>
                <div class="restaurant-list">
                    <div class="grid-sizer col-sm-6 col-md-4"></div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="drinks">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/04.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="drinks">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/05.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="dinner">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/06.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="lunch">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/07.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="lunch">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/08.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="drinks">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/11.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="lunch">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/12.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="starters">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/13.jpg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 grid-item" data-filter="dinner">
                        <div>
                            <a href="#" target="_blank"><img src="assets/customer/img/14.jpg" alt=""></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Restaurant Menu -->

    <!-- Section Testimonials -->
    <section id="testimonials" class="padd-100 parallax-window" data-background="assets/customer/img/main2.jpg">
			<span class="section-suptitle text-center">
				Food Lover
			</span>
        <h2 class="section-title white-font sep-type-2 text-center">
            customer feedback
        </h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 no-padd">
                    <ul class="testimonial-list">
                        <li>
                            <div>
                                <p>
                                    Nunc ullamcorper augue nec accumsan
                                    porta. Ut lacinia fgiat viverra. Ut dictum
                                    turpis in ipsum sagittis finibus.
                                </p>
                                <span>Anna Van</span>
                            </div>
                            <img src="http://placehold.it/95x95" alt="" class="img-responsive">
                        </li>
                        <li>
                            <div>
                                <p>
                                    Nunc ullamcorper augue nec accumsan
                                    porta. Ut lacinia fgiat viverra. Ut dictum
                                    turpis in ipsum sagittis finibus.
                                </p>
                                <span>Frinton Van</span>
                            </div>
                            <img src="http://placehold.it/95x95" alt="" class="img-responsive">
                        </li>
                        <li>
                            <div>
                                <p>
                                    Nunc ullamcorper augue nec accumsan
                                    porta. Ut lacinia fgiat viverra. Ut dictum
                                    turpis in ipsum sagittis finibus.
                                </p>
                                <span>Filipe Van</span>
                            </div>
                            <img src="http://placehold.it/95x95" alt="" class="img-responsive">
                        </li>
                        <li>
                            <div>
                                <p>
                                    Nunc ullamcorper augue nec accumsan
                                    porta. Ut lacinia fgiat viverra. Ut dictum
                                    turpis in ipsum sagittis finibus.
                                </p>
                                <span>Frinton Van</span>
                            </div>
                            <img src="http://placehold.it/95x95" alt="" class="img-responsive">
                        </li>
                        <li>
                            <div>
                                <p>
                                    Nunc ullamcorper augue nec accumsan
                                    porta. Ut lacinia fgiat viverra. Ut dictum
                                    turpis in ipsum sagittis finibus.
                                </p>
                                <span>Frinton Van</span>
                            </div>
                            <img src="http://placehold.it/95x95" alt="" class="img-responsive">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Testimonials -->






    <!-- Section Vision -->

    <!-- End Section Vision -->

    <!-- Section From The Menu -->
    <section id="from-menu" class="padd-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="f-menu-list">
                        <div class="f-menu-item">
                            <div class="item-left">
                                <img src="assets/customer/img/17.jpg" alt="">
                            </div>
                            <div class="item-right">
                                <span class="section-suptitle">Food Lover</span>
                                <h3 class="section-title">
                                    Offer Dishes
                                </h3>
                                <span class="price">Only £<?php echo number_format(25, 2, '.', '')?> <samp>£<?php echo number_format(45, 2, '.', '')?></samp></span>
                                <h4>Chicken and Cashews</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscinit. Vestibulum vel sum ullamcorper, suscipit eros quis, pellentesqsapien. Sed ventis nisl a auris laoreet, at tincidunt lectus volutpat. Etiam semper ligula sollicitudi ante vehicula pellentesqsapien.
                                </p>
                                <a href="">About More</a>
                            </div>
                        </div>
                        <div class="f-menu-item">
                            <div class="item-left">
                                <img src="assets/customer/img/18.jpg" alt="">
                            </div>
                            <div class="item-right">
                                <span class="section-suptitle">Food Lover</span>
                                <h3 class="section-title">
                                    Offer Dishes
                                </h3>
                                <span class="price">Only £<?php echo number_format(30, 2, '.', '')?> <samp>£<?php echo number_format(60, 2, '.', '')?></samp></span>
                                <h4>Dishes and Wings</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscinit. Vestibulum vel sum ullamcorper, suscipit eros quis, pellentesqsapien. Sed ventis nisl a auris laoreet, at tincidunt lectus volutpat. Etiam semper ligula sollicitudi ante vehicula pellentesqsapien.
                                </p>
                                <a href="">About More</a>
                            </div>
                        </div>
                        <div class="f-menu-item">
                            <div class="item-left">
                                <img src="assets/customer/img/19.jpg" alt="">
                            </div>
                            <div class="item-right">
                                <span class="section-suptitle">Food Lover</span>
                                <h3 class="section-title">
                                    Offer Crepes
                                </h3>
                                <span class="price">Only £<?php echo number_format(10, 2, '.', '')?> <samp>£<?php echo number_format(20, 2, '.', '')?></samp></span>
                                <h4>Crepes and Crape</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscinit. Vestibulum vel sum ullamcorper, suscipit eros quis, pellentesqsapien. Sed ventis nisl a auris laoreet, at tincidunt lectus volutpat. Etiam semper ligula sollicitudi ante vehicula pellentesqsapien.
                                </p>
                                <a href="">About More</a>
                            </div>
                        </div>
                        <div class="f-menu-item">
                            <div class="item-left">
                                <img src="assets/customer/img/20.jpg" alt="">
                            </div>
                            <div class="item-right">
                                <span class="section-suptitle">Food Lover</span>
                                <h3 class="section-title">
                                    Offer Dishes
                                </h3>
                                <span class="price">Only £<?php echo number_format(25, 2, '.', '')?> <samp>£<?php echo number_format(50, 2, '.', '')?></samp></span>
                                <h4>Chicken and Dishes</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscinit. Vestibulum vel sum ullamcorper, suscipit eros quis, pellentesqsapien. Sed ventis nisl a auris laoreet, at tincidunt lectus volutpat. Etiam semper ligula sollicitudi ante vehicula pellentesqsapien.
                                </p>
                                <a href="">About More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End From The Menu -->

    <!-- Section Contact -->

    <!-- End Section Contact -->


<?php require_once "view/base/customer/pre_footer.php"?>

<?php require_once "view/base/customer/footer.php"?>