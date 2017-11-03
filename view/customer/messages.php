<?php require_once "view/base/customer/header.php"?>

    <!-- Section Main -->
    <section id="breadcrumb" data-background="assets/customer/img/main3.jpg" class="parallax-window orderBreadcrumb">
        <div>
            <!--span class="section-suptitle text-center">Food Lover</span-->
            <h1 class="section-title white-font text-center">Order Online</h1>
            <!--ul>
                <li><a href="">Home</a></li>
                <li>About us</li>
            </ul-->
        </div>
    </section>
    <!-- End Section Main -->

    <!-- Section Order Online -->
    <section id="order">
        <div class="container">
            <!--warning-->
            <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
            </div>
            <!--warning end-->

            <div class="row">
                <!--<div class="col-sm-12">
                    <div class="common-header-bar">
                        <a href="javascript:;" class="btn btn-danger">BACK</a>
                    </div>
                </div>-->

                <!-- start category content all -->
                <!--<form id="proceed_payment" action="<?/*= BASE_URL */?>/place-order" method="post">-->
                <div class="col-md-12 ui-order-online-left-side">
                    <div class="checkout-content dThank-content">
                        <div class="row">
                        	<div class="col-sm-12">
                                <?php if (!isset($errorMessage)) {?>
                                    <?php if (isset($h2Message)) {?><h2 class="no-margin-top text-golden"> <?= $h2Message;?></h2><?php }?>
                                    <?php if (isset($smallMessage)) {?><p> <?= $smallMessage;?></p><?php }?>
                                    <?php if (isset($orderNumber)) {?><p>Order Id: <?= $orderNumber;?></p><?php }?>
                                    <?php if (isset($totalAmount)) {?><p>Total Amount: <?= $totalAmount;?></p><?php }?>
                                    <?php if (isset($orderTime)) {?><p>Order Time: <?= $orderTime;?></p><?php }?>
                                <?php } else {?>
                                    <p><?=$errorMessage?></p>
                                <?php }?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end category content all -->
                <!--</form>-->
            </div>
        </div>
    </section>
    <!-- End Section Order Online -->


<?php require_once "view/base/customer/pre_footer.php"?>

<?php require_once "view/base/customer/footer.php"?>