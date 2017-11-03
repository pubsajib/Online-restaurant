<?php require_once "view/base/customer/header.php"?>

<!-- Section Main -->
<section id="breadcrumb" data-background="assets/customer/img/main3.jpg" class="parallax-window orderBreadcrumb hidden-xs">
    <div>
        <!--span class="section-suptitle text-center">Food Lover</span-->
        <h1 class="section-title white-font text-center">About us</h1>
        <!--ul>
            <li><a href="">Home</a></li>
            <li>About us</li>
        </ul-->
    </div>
</section>
<!-- End Section Main -->

<!-- Section Story -->
<section id="our-story">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="story-description">
                    <span class="section-suptitle">Our Story</span>
                    <h2 class="section-title"><?php echo $about_us[0]->content_heading?></h2>
                    <p>
                        <?php echo $about_us[0]->content?>
                    </p>

                </div>
            </div>
            <div class="col-sm-6">
                <img src="assets/customer/img/chef.jpg" alt="" class="img-responsive img-story">
            </div>
        </div>
    </div>
</section>
<!-- End Section Story -->

<!-- Section Services -->

<!-- End Section Services -->

<!-- Section Gallery -->
<section id="gallery" class="padd-100 ">


    <div class="container">


    </div>

</section>
<!-- End Section Gallery -->

<!-- Section Vision -->

<!-- End Section Vision -->

<!-- Section Teams -->
<!-- End Section Teams -->

<!-- Section apps -->

<!-- End Section apps -->


<!-- Section Contact -->

<!-- End Section Contact -->

<!-- End Section Newsletter -->
<?php require_once "view/base/customer/pre_footer.php"?>

<?php require_once "view/base/customer/footer.php"?>