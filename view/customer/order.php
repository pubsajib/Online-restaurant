<?php require_once "view/base/customer/header.php"; ?>
    <style>
        .offer-list,.bundle-list {
            padding: 10px;
        }
        .extra-list>li {
            margin: 10px 0 5px 0;
        }
    </style>

    <!-- Loader Bloc -->
    <div class="site-loader" style="display: none;">
        <div class="loading"></div>
        <div class="processing">waiting for offer checking</div>
    </div>
    <!-- End Loader Bloc -->

    <!-- Product add notification -->
    <div class="productAddAlert hide">
        <p>
            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span>
            Successfully added to cart
        </p>
    </div>

    <!--for mobile first top nav -->
    <nav class="navbar navbar-default hide" id="mobo-nav">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-first-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="mobile-first-nav">
                <ul class="nav navbar-nav">
                    <?php if (!empty($categories))
                        foreach ($categories as $category) {?>
                            <?php
                            $categoryName = explode(' ', $category->category_name);
                            $key = array_search('&', $categoryName);
                            if ($key) {
                                unset($categoryName[$key]);
                            }
                            $categoryName = implode('_', $categoryName);

                            if (!empty($category->products)) { ?>
                                <li>
                                    <a class="clicker" href="#<?= $categoryName ?>" ><?= $category->category_name ?></a>
                                </li>
                            <?php } // end if
                        }// end foreach ?>
                    <!--<li><a class="clicker" href="#STARTERS">STARTERS</a></li>
                    <li><a class="clicker" href="#SIDE_DISHES">SIDE DISHES</a></li>
                    <li><a class="clicker" href="#PLATTER">PLATTER</a></li>
                    <li><a class="clicker" href="#MADINA_PLATTER_FAMILY_PLATTER">MADINA PLATTER FAMILY & PLATTER</a></li>-->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- Section Main -->
    <section id="breadcrumb" data-background="assets/customer/img/main3.jpg" class="parallax-window orderBreadcrumb orderPageBreadcrumb">
        <div> <h1 class="section-title white-font text-center margin-top-40">Order Online</h1> </div>
    </section>
    <!-- End Section Main -->

    <!-- Section Order Online -->
    <section id="order">
        <div class="container">

            <div class="row">
                <!-- start category content all -->
                <div class="col-md-9 ui-order-online-left-side">

                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav order-online-tab-nav list-inline list-unstyled"  id="sticky-row" role="tablist">
                            <li role="presentation" class="active">
                                <a href="javascript:;">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                                    Order Online
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="Order">

                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                        <ul class="category-list list-unstyled  wrapper-left" id="">
                                            <?php $counter = 0; ?>
                                            <?php if (!empty($categories)) foreach ($categories as $category) {?>
                                                <?php
                                                $categoryName = explode(' ', $category->category_name);
                                                $key = array_search('&', $categoryName);
                                                if ($key) {
                                                    unset($categoryName[$key]);
                                                }
                                                $categoryName = implode('_', $categoryName);
                                                ?>
                                                <?php if (!empty($category->products)) {?>
                                                    <li class="<?php if ($counter == 0) echo 'active';?>">
                                                        <a class="clicker scroll-section" href="#<?= $categoryName ?>" ><?= $category->category_name ?></a>
                                                    </li>
                                                <?php }?>
                                                <?php $counter++; ?>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
                                        <div class="category-dish-container">
                                            <?php if (!empty($categories))
                                                foreach ($categories as $category) { ?>
                                                    <?php
                                                    $categoryName = explode(' ', $category->category_name);
                                                    $key = array_search('&', $categoryName);
                                                    if ($key) {
                                                        unset($categoryName[$key]);
                                                    }
                                                    $categoryName = implode('_', $categoryName);

                                                    if (!empty($category->products)) {?>
                                                        <div id="<?php if (isset($categoryName)) echo $categoryName; ?>" class="category">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="category-name"><?= $category->category_name ?></div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <?php if (!empty($category->products)) foreach ($category->products as $product) { ?>
                                                                    <div class="col-md-12">
                                                                        <div class="dish-content">
                                                                            <div class="row">
                                                                                <div class="col-md-9 col-xs-6">
                                                                                    <div class="dish-name"><?= $product->name; ?></div>
                                                                                    <p class="dish-details"><?php if (isset($product->description)) echo $product->description; ?></p>
                                                                                </div>
                                                                                <?php if (empty($product->sub_products)){?>
                                                                                <div class="col-md-3 col-xs-6">
                                                                                    <div class="dish-right-content">
                                                                                        <?php
                                                                                        if (!empty($offers)) {
                                                                                            foreach ($offers as $offer) {
                                                                                                if ($offer->product_id == $product->product_id) {
                                                                                                    $product->price = $offer->offer_price;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <div class="dish-price">£<?= number_format($product->price, 2, '.', ''); ?></div>
                                                                                        <div class="text-right ui-order-btn">
                                                                                            <form id="form_product_details">
                                                                                                <?php
                                                                                                $product_title = str_replace('"','&quot;',$product->name);
                                                                                                $product_desc = '';
                                                                                                if (isset($product->description))
                                                                                                    $product_desc = str_replace('"','&quot;',$product->description);
                                                                                                ?>
                                                                                                <input type="hidden" name="product_id" value="<?= $product->product_id ?>">
                                                                                                <input type="hidden" name="sub_product_id" value="">
                                                                                                <input type="hidden" name="product_name" value="<?= $product_title; ?>">
                                                                                                <input type="hidden" name="product_price" value="<?= number_format($product->price, 2, '.', '') ?>">
                                                                                                <a class="add_to_cart addToCart" product_id="<?= $product->product_id ?>" product_name="<?= $product_title ?>" product_desc="<?= $product_desc ?>" data-status="increment" onclick=""><i class="fa fa-plus"></i></a>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                            </div>

                                                                            <?php if (!empty($product->sub_products)) foreach ($product->sub_products as $sub_product) {?>
                                                                                <div class="row">
                                                                                    <div class="col-md-9 col-xs-6">
                                                                                        <div class="dish-name"><?= $sub_product->name; ?></div>
                                                                                    </div>
                                                                                    <div class="col-md-3 col-xs-6">
                                                                                        <div class="dish-right-content">
                                                                                            <div class="dish-price">£<?= number_format($sub_product->price, 2, '.', ''); ?></div>
                                                                                            <div class="text-right ui-order-btn">
                                                                                                <form id="form_product_details">
                                                                                                    <?php
                                                                                                    $title = $product->name."(".$sub_product->name.")";
                                                                                                    $product_title = str_replace('"','&quot;',$title);
                                                                                                    $product_desc = '';
                                                                                                    if (isset($product->description))
                                                                                                        $product_desc = str_replace('"','&quot;',$product->description);
                                                                                                    ?>
                                                                                                    <input type="hidden" name="product_id" value="<?= $product->product_id ?>">
                                                                                                    <input type="hidden" name="sub_product_id" value="<?= $sub_product->sub_product_id ?>">
                                                                                                    <input type="hidden" name="product_name" value="<?= $product_title ?>">
                                                                                                    <input type="hidden" name="product_price" value="<?= number_format($sub_product->price, 2, '.', '') ?>">
                                                                                                    <a class="add_to_cart addToCart" product_id="<?= $product->product_id ?>" product_name="<?= $product_title ?>" product_desc="<?= $product_desc ?>" data-status="increment" onclick=""><i class="fa fa-plus"></i></a>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>



                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                <?php }?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="Offer">rtyrty</div>
                            <div role="tabpanel" class="tab-pane" id="Reservation">..fghfh.</div>
                            <div role="tabpanel" class="tab-pane" id="Info">.drdrtr..</div>
                        </div>

                    </div>
                </div>
                <!-- end category content all -->

                <!-- start cart content -->
                <form id="form_checkout" action="aaa" method="post">
                    <div class="col-md-3 ui-order-online-right-side">
                        <div class="wrapper-right">
                            <div class="ui-order-policy">
                                <ul class="list-inline no-margin row">
                                    <?php $counter = 1; ?>
                                    <?php if(!empty($orderProcessTypes)) foreach ($orderProcessTypes as $type) {?>
                                        <li class="col-sm-6">
                                            <div class="radio">
                                                <input type="radio" name="order_process_type_id" id="radio<?=$counter?>" value="<?= $type->order_process_type_id ?>" data-order_process_name="<?= $type->order_process_name ?>">
                                                <label for="radio<?=$counter?>">
                                                    <?= $type->order_process_name ?>
                                                </label>
                                            </div>

                                        </li>
                                        <?php $counter++; ?>
                                    <?php }?>

                                    <!--<li>
                                        <div class="radio">
                                            <input type="radio" name="order_process_type_id" id="radio1" value="option1">
                                            <label for="radio1">
                                                Delivery
                                            </label>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="radio">
                                            <input type="radio" name="order_process_type_id" id="radio2" value="option2">
                                            <label for="radio2">
                                                Collection
                                            </label>
                                        </div>
                                    </li>-->
                                </ul>
                            </div>

                            <div class="cart-content">
                                <!--warning-->
                                <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                </div>
                                <div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
                                </div>
                                <!--warning end-->

                                <div class="cfo-cart clearfix">
                                    <div class="cart-info" id="mainCart">
                                        <h2>My Order</h2>
                                        <div class="cart-table ui-empty-cart">
                                            <i class="fa fa-4x fa-shopping-bag" aria-hidden="true"></i>
                                            <p class="text-center">Add menu items into your basket</p>
                                        </div>

                                        <div class="cart-table">
                                            <table class="table table-striped">
                                                <tbody class="cart_product_list">
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="ui-order-description order-description" style="display: none;">
                                            <div class="row color-gray">
                                                <div class="col-md-8 col-xs-8">
                                                    <p>Subtotal: </p>
                                                </div>
                                                <div class="col-md-4 col-xs-4 text-right order-subtotal-amount"><?/*= $_SESSION['cart']['total_price'] */?></div>
                                            </div>
                                            <div class="row color-gray order-description-delivery delivery-charge">
                                                <div class="col-md-8 col-xs-8">
                                                    <p>Delivery Charge: </p>
                                                </div>
                                                <div class="col-md-4 col-xs-4 text-right">£<?php if (isset($settings)) echo number_format($settings->delivery_charge, 2, '.', '') ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-xs-4">
                                                    <p>Total: </p>
                                                </div>
                                                <div class="col-md-8 col-xs-8 text-right "><span id="order-total-amount" class="order-total-amount">£<?/*= $_SESSION['cart']['total_price'] */?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cfo-checkoutarea order-proceed" style="display: none;">
                                            <!--<form id="form_checkout" action="<?/*= BASE_URL */?>/checkout" method="post">-->
                                            <input type="hidden" name="cart" value="">
                                            <button type="submit"  id="large_checkOutBtn" name="a" class="btn btn-primary btn-block custom-checkout disable-checkout checkOutBtn" >Proceed to Checkout</button>
                                            <!--</form>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="charges" id="def-charge">
                                <p>
                                    <span>Minimum :</span>
                                    <span  class="pull-right">£0.00</span>
                                </p>
                            </div>

                            <div class="charges hide" id="delivery-charge">
                                <p>
                                    <span>Delivery Charge :</span>
                                    <span  class="pull-right">£<?php if (isset($settings)) echo number_format($settings->delivery_charge, 2, '.', '') ?></span>
                                </p>
                                <p>
                                    <span>Delivery Minimum :</span>
                                    <span  class="pull-right">£<?php if (isset($settings)) echo number_format($settings->delivery_minimum, 2, '.', '') ?></span>
                                </p>
                            </div>

                            <div class="charges hide" id="collection-charge">
                                <p>
                                    <span>Collection Minimum :</span>
                                    <span  class="pull-right">£0.00</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Section Order Online -->

    <!-- For mobile first bottom fix nav-->
    <nav class="navbar navbar-default navbar-fixed-bottom mobile-cart-nav hidden" id="mobileNavBar">
        <div class="mobile-cart-inner-content">
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <div class="mobile-cart-item">
                        <a id="mobileCartToggle" href="javascript:;" data-toggle="modal" data-target="#lab-slide-bottom-popup">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <span id="item_count"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <div class="mobile-total-amount">Total: <span id="total_cart_amount" class="order-total-amount"></span></div>
                </div>
                <div class="col-md-4 col-xs-4">
                    <button disabled="" class="btn mobile-btn-checkout checkOutBtn" id="mobileCheckOutBtn">Min. £ <?php if (isset($settings)) echo number_format($settings->delivery_minimum, 2, '.', '') ?></button>
                </div>
            </div>
        </div>
    </nav>

    <!-- xs cart modal -->

    <div class="modal fade" id="lab-slide-bottom-popup" data-keyboard="false" data-backdrop="false">
        <div class="lab-modal-body">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <!-- /.modal-body -->
            <form id="m_form_checkout" method="post">
                <div class="ui-order-policy">
                    <ul class="list-inline">
                        <?php $counter = 1; ?>
                        <?php if(!empty($orderProcessTypes)) foreach ($orderProcessTypes as $type) {?>
                            <li>
                                <div class="radio">
                                    <input type="radio" name="order_process_type_id" id="radio0<?=$counter?>" value="<?= $type->order_process_type_id ?>">
                                    <label for="radio0<?=$counter?>">
                                        <?= $type->order_process_name ?>
                                    </label>
                                </div>

                            </li>
                            <?php $counter++; ?>
                        <?php }?>

                        <!--<li>
                            <div class="radio">
                                <input type="radio" name="order_process_type_id" id="radio1" value="option1">
                                <label for="radio1">
                                    Delivery
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="radio">
                                <input type="radio" name="order_process_type_id" id="radio2" value="option2">
                                <label for="radio2">
                                    Collection
                                </label>
                            </div>
                        </li>-->
                    </ul>
                </div>

                <div class="cart-content">
                    <!--warning-->
                    <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
                    </div>
                    <!--warning end-->

                    <div class="cfo-cart clearfix">
                        <div class="cart-info" id="mainCart">
                            <h2>My Order</h2>
                            <div class="cart-table ui-empty-cart">
                                <i class="fa fa-4x fa-shopping-bag" aria-hidden="true"></i>
                                <p class="text-center">Add menu items into your basket</p>
                            </div>

                            <div class="cart-table">
                                <table class="table table-striped">
                                    <tbody class="cart_product_list">
                                    <!--<tr class="hobtr">
                                        <td class="cross-td custom-spinner">
                                            <div class="input-group spinner">
                                                <button class="btn btn-default cust-plus cust-plus-increment" type="button"><i class="fa fa-plus"></i>
                                                </button>
                                                <input class="form-control increse-val" value="11" readonly="" type="text">
                                                <button class="btn btn-default cust-plus cust-plus-decrement" type="button"><i class="fa fa-minus"></i>
                                                </button>
                                            </div><span class="qnt-idn">11 x</span>
                                        </td>
                                        <td class="itme-td">Lime Pickle</td>
                                        <td class="amont-td"><i class="fa fa-times-circle-o"></i> <span class="main-price">8.80</span>
                                        </td>
                                    </tr>-->

                                    </tbody>
                                </table>
                            </div>

                            <div class="clearfix"></div>
                            <div class="ui-order-description order-description" style="display: none;">
                                <div class="row color-gray">
                                    <div class="col-md-8 col-xs-8">
                                        <p>Subtotal: </p>
                                    </div>
                                    <div class="col-md-4 col-xs-4 text-right order-subtotal-amount"><?/*= $_SESSION['cart']['total_price'] */?></div>
                                </div>
                                <div class="row color-gray delivery-charge">
                                    <div class="col-md-8 col-xs-8">
                                        <p>Delivery Charge: </p>
                                    </div>
                                    <div class="col-md-4 col-xs-4 text-right">£<?php if (isset($settings)) echo number_format($settings->delivery_charge, 2, '.', '') ?></div>
                                </div>
                                <!--<div class="row color-gray">
                                    <div class="col-md-8 col-xs-8">
                                        <p>Discount: </p>
                                    </div>
                                    <div class="col-md-4 col-xs-4 text-right">0.00</div>
                                </div>-->
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <p>Total: </p>
                                    </div>
                                    <div class="col-md-8 col-xs-8 text-right "><span id="order-total-amount" class="order-total-amount">£<?/*= $_SESSION['cart']['total_price'] */?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cfo-checkoutarea order-proceed" style="display: none;">
                                <!--<form id="form_checkout" action="<?/*= BASE_URL */?>/checkout" method="post">-->
                                <input type="hidden" name="cart" value="">
                                <!--<button type="submit"  id="m_checkOutBtn" name="" class="btn btn-primary btn-block custom-checkout disable-checkout" >Proceed to Checkout</button>-->
                                <!--</form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- xs cart modal end-->

    <!-- Modal -->
    <div class="modal fade delivery_policy" id="delivery-policy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content modal-content-new">
                <div class="devilery-modal-body">
                    <div class="modal-header modal-header-new">
                        <h4 class="modal-title modal-policy-titel-popup">Would you like to collect or have your order delivered?</h4>
                    </div>
                    <div class="modal-body clearfix">
                        <div class="row ui-modal-inner-content modal-policy-inner-content-box">
                            <div class="col-md-6 modal-middle-body-box text-center">
                                <a href="javascript:;" id="deliveryRadMain" data-dismiss="modal">
                                        <span class="deliveryRedMain">
                                            <i class="fa fa-4x fa-bicycle" aria-hidden="true"></i>
                                            <br><br>
                                            <span>
                                                Pre-order Delivery &nbsp;<i class="fa fa-angle-right arrow-btn-box-left"></i>
                                            </span>
                                        </span>
                                </a>
                            </div>

                            <div class="col-md-6 collectionRadMain-box text-center">
                                <a href="javascript:;" id="collectionRadMain" data-dismiss="modal">
                                        <span>
                                            <i class="fa fa-4x fa-shopping-bag" aria-hidden="true"></i>
                                            <br><br>
                                            <span class="collection-mess-box">
                                                Pre-order Collection &nbsp;<i class="fa fa-angle-right arrow-btn-box"></i>
                                            </span>
                                        </span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-policy text-center">
                        <button type="button" class="btn btn-gray no-border-radius" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ===================================================================================================================== -->

    <!-- ===================================================================================================================== -->
    <div class="modal extraOffer fade" id="productPopUp" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Parent Product Name, Product name</h4>
                    <pre class="modal-description">Description</pre>
                    <input type="hidden" name="popup_product_id" id="popup_product_id"/>
                    <input type="hidden" name="popup_sub_product_id" id="popup_sub_product_id"/>
                    <input type="hidden" name="popup_product_name" id="popup_product_name"/>
                    <input type="hidden" name="popup_product_price" id="popup_product_price"/>
                    <input type="hidden" name="popup_offer_id" id="popup_offer_id"/>
                    <input type="hidden" name="offer_left" id="offer_left" value=""/>
                    <input type="hidden" name="is_bundle" id="is_bundle" value="0"/>
                    <input type="hidden" name="popup_bundle_id" id="popup_bundle_id" value=""/>
                    <input type="hidden" name="bundle_left" id="bundle_left" value=""/>
                    <input type="hidden" name="bundle_step" id="bundle_step" value=""/>
                    <input type="hidden" name="bundle_max_step" id="bundle_max_step" value=""/>
                    <input type="hidden" name="type_for" id="type_for" value=""/>
                </div>

                <div class="modal-body">
                    <div class="testArea"></div>
                    <!-- Offer selected list START -->
                    <div class="offer-selected-list selectedList">

                        <div class="row offer-selected-item hidden">
                            <div class="col-sm-1 col-xs-6">
                                <div class="extra-td text-right">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn offer-add extra-added active">
                                            <input type="checkbox" autocomplete="off" checked="checked" disabled="">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-11 col-xs-6">
                                <p><strong>7" Deep Chesse Pizza</strong></p>
                            </div>
                        </div>

                        <div class="row offer-selected-item hidden">
                            <div class="col-sm-1 col-xs-6">
                                <div class="extra-td text-right">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn offer-add extra-added active">
                                            <input type="checkbox" autocomplete="off" checked="checked" disabled="">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-11 col-xs-6">
                                <p><strong>10" Maxican hot town Pizza</strong></p>
                            </div>
                        </div>
                    </div>
                    <!-- Offer selected list START -->
                    <div id="productPopUpContent">
                    	<p class="selection-text">Select Offer</p>
                        <!-- Extra selected list START -->
                        <div class="all-offer-list allOfferList">
                            <!--div class="row offer-list-title">
                                <div class="col-sm-6">
                                    <p><strong>Select option</strong></p>
                                </div>
                                <div class="col-sm-6">
                                    <p></p>
                                </div>
                            </div-->

                            <div class="row">
                                <div class="">
                                    <ul class="offer-list">
                                        <li class="">

                                        </li>
                                    </ul>
                                    <ul class="bundle-list" style="display:none">
                                        <li class="">

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Offer/bbundle list END -->

                        <!--Add Extra START -->
                        <div class="all-extra-list" id="addExtra" style="display:none">
                            <div class="cfo-cart clearfix">
                                <div class="cart-info" id="ExtraCart">
                                    <form action="">
                                        <div class="extra-table">
                                            <ul class="extra-list">
                                                <li>
                                                </li>
                                            </ul>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Add Extra END -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 text-left">
                            <button type="button" class="btn common-btn addExtraCart sm-btn" id="add_to_buscate">Add to Basket</button>
                            <button type="button" class="btn btn-primary addExtraCart sm-btn" id="skip_offer_extra_button" style="display:none">Skip Extra</button>
                            <button type="button" class="btn btn-primary addExtraCart sm-btn" id="add_offer_extra_button" style="display:none">Add Extra</button>
                            <button type="button" class="btn btn-primary addExtraCart sm-btn" id="skip_product_extra_button" style="display:none">Skip Extra</button>
                            <button type="button" class="btn btn-primary addExtraCart sm-btn" id="add_product_extra_button" style="display:none">Add Extra</button>
                        </div>

                        <div class="col-sm-6 col-xs-6 text-right">
                            <p class="lh-30 black-text"><strong>Total: £<span id="extra-order-total-amount" class="">0</span></strong></p>
                            <input type="hidden" name="total_extra_price" id="total_extra_price" value="0"/>
                            <input type="hidden" name="extra-price-hidden" id="extra-price-hidden" value="0"/>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

<?php require_once "view/base/customer/pre_footer.php" ?>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            var originalModal = $('#productPopUp').clone();
            $(document).on( 'hidden.bs.modal','#productPopUp', function () {
                $('#productPopUp').remove()
                var myClone = originalModal.clone();
                $('body').append(myClone);
            });


            $(document).on( 'click', '#masterPopUPShow', function (event) {
                $('#masterPopUP').modal('show');
            });

            // For mobile first
            if ($(window).width() < 767) {
                $('.wrapper-left').addClass("hide");
                $('.wrapper-right').addClass("hide");

                var stickyTop = $('#sticky-row').offset().top-40;
                $(window).on( 'scroll', function(){
                    if ($(window).scrollTop() >= stickyTop) {
                        $('#site-header>.navbar').addClass("hide");
                        $("#mobo-nav").removeClass("hide");
                    }
                    else {
                        $('#site-header>.navbar').removeClass("hide");
                        $("#mobo-nav").addClass("hide");
                    }
                });

                // On scroll header title change
                var topTitle = $('.category').offset().top+30;
                $(window).on( 'scroll', function(){
                    $('.category').each(function(){
                        var windowScroll = $(window).scrollTop();
                        var elementScroll = $(this).offset().top;
                        var distance = elementScroll-windowScroll;
                        //console.log($(this).offset().top);
                        //console.log(distance);
                        if(distance<50){
                            var item=$(this).find('.category-name').html();
                            //console.log(item);
                            $('.navbar-brand').html(item);
                        }
                    });
                });

                /*Click to call menu*/
                $('a.clicker[href^="#"]').on('click', function(event) {
                    var target = $(this.getAttribute('href'));
                    if( target.length ) {
                        event.preventDefault();
                        $('html, body').stop().animate({
                            scrollTop: target.offset().top-10
                        }, 1000);
                    }
                });
            }
            else {
                //alert('More than 767');
            }

            $("#mobile-first-nav .clicker").click(function(){
                $(".clicker").parent("li").removeClass("active");
                $(this).parent("li").addClass("active");
            });

            // for xs cart modal
            /* setTimeout(function() {
             $('#lab-slide-bottom-popup').modal('show');
             }, 5000);*/ // optional - automatically opens in xxxx milliseconds

            $(document).ready(function() {
                $('.lab-slide-up').find('a').attr('data-toggle', 'modal');
                $('.lab-slide-up').find('a').attr('data-target', '#lab-slide-bottom-popup');
            });
            // For mobile first end

            //For modal selection delivery or collection 
            $("#deliveryRadMain").click(function(){
                $("#radio2").prop("checked", false);
                $("#radio1").prop("checked", true);
                $(".charges").addClass("hide").removeClass("show");
                $("#delivery-charge").removeClass("hide").addClass("show");
            });
            $("#collectionRadMain").click(function(){
                $("#radio1").prop("checked", false);
                $("#radio2").prop("checked", true);
                $(".charges").addClass("hide").removeClass("show");
                $("#collection-charge").removeClass("hide").addClass("show");
            });

            //on check delivery option delivery payment bar show hide
            $("#radio1").change(function(){
                if($("#radio1").prop("checked", true)){
                    $(".charges").addClass("hide").removeClass("show");
                    $("#delivery-charge").removeClass("hide").addClass("show");
                }
            });
            $("#radio2").change(function(){
                if($("#radio2").prop("checked", true)){
                    $(".charges").addClass("hide").removeClass("show");
                    $("#collection-charge").removeClass("hide").addClass("show");
                }
            });

            var delivery_minimum = "<?php if (isset($settings)) echo $settings->delivery_minimum ?>";
            var delivery_charge_added = false;
            $('#form_checkout input[name="order_process_type_id"]').click(function () {
                //console.log('order_process_type_id');
                //$('#checkOutBtn').prop('disabled', true);
                orderProcess('#form_checkout');
            });

            $('#m_form_checkout input[name="order_process_type_id"]').click(function () {
                //console.log('order_process_type_id');
                orderProcess('#m_form_checkout');
                //$('#checkOutBtn').prop('disabled', true);
                /*var name = $(this).data('order_process_name');
                 var id = $(this).val();
                 var action = '';
                 //console.log(id);
                 var delivery_charge = "";
                 if (id == 1) {
                 action = "/checkout";
                 $('#m_form_checkout').attr('action', action);
                 $('.checkOutBtn').prop('disabled', true);
                 $('.delivery-charge').show();

                 if (cart != null && delivery_charge_added == false) {
                 cart.total_price = parseFloat(cart.total_price) + parseFloat(delivery_charge);
                 cart.delivery_charge = delivery_charge;
                 //$('.order-subtotal-amount').text(cart.total_price);
                 $('.order-total-amount').text('£'+parseFloat(cart.total_price).toFixed(2));
                 delivery_charge_added = true;
                 }

                 } else {
                 action = "/checkout";
                 //$('#mobileCheckOutBtn').text('');
                 $('#m_form_checkout').attr('action', action);
                 $('.checkOutBtn').prop('disabled', false);
                 $('.delivery-charge').hide();

                 if (delivery_charge_added) {
                 cart.total_price = parseFloat(cart.total_price) - parseFloat(delivery_charge);
                 cart.delivery_charge = 0;
                 delivery_charge_added = false;
                 $('.order-total-amount').text('£'+parseFloat(cart.total_price).toFixed(2));
                 }
                 }
                 if (cart != null && Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                 $('.checkOutBtn').prop('disabled', false);
                 }*/
            });

            function orderProcess (formId) {
                //var name = $(this).data('order_process_name');
                var id = $(formId+' input[name="order_process_type_id"]:checked').val();
                var action = '';
                //console.log(id);
                var delivery_charge = "<?php if (isset($settings)) echo number_format($settings->delivery_charge, 2, '.', '') ?>";
                if (id == 1) {
                    action = "<?= BASE_URL ?>/checkout";
                    $(formId).attr('action', action);
                    $('.checkOutBtn').prop('disabled', true);
                    $('.delivery-charge').show();
                    if (cart != null && delivery_charge_added == false) {
                        cart.total_price = parseFloat(cart.total_price) + parseFloat(delivery_charge);
                        cart.delivery_charge = delivery_charge;
                        //$('.order-subtotal-amount').text(cart.total_price);
                        $('.order-total-amount').text('£'+parseFloat(cart.total_price).toFixed(2));
                        delivery_charge_added = true;
                    }

                } else {
                    action = "<?= BASE_URL ?>/checkout";
                    $(formId).attr('action', action);
                    $('.checkOutBtn').prop('disabled', false);
                    $('.delivery-charge').hide();

                    if (delivery_charge_added) {
                        console.log('inside collection');
                        console.log(delivery_charge);
                        console.log(parseFloat(cart.total_price) - parseFloat(delivery_charge));
                        cart.total_price = parseFloat(cart.total_price) - parseFloat(delivery_charge);
                        cart.delivery_charge = 0;
                        delivery_charge_added = false;

                        $('.order-total-amount').text('£'+parseFloat(cart.total_price).toFixed(2));
                    }

                    if ($(window).width() < 1025) {
                        $('#mobileCheckOutBtn').text('Checkout');
                    } else {
                        $('#large_checkOutBtn').text('Proceed to Checkout');
                    }

                }

                if (cart != null) {
                    if (Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                        $('.checkOutBtn').prop('disabled', false);
                        if ($(window).width() < 1025) {
                            $('#mobileCheckOutBtn').text('Checkout');
                        } else {
                            $('#large_checkOutBtn').text('Proceed to Checkout');
                        }
                    } else {
                        //$('.checkOutBtn').prop('disabled', true);
                        if (id == 1) {
                            if ($(window).width() < 1025) {
                                $('#mobileCheckOutBtn').text('Min. £ '+delivery_minimum);
                            } else {
                                $('#large_checkOutBtn').text('Delivery Minimum £ '+delivery_minimum);
                            }
                        }

                    }
                }
                /*if (cart != null && Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                 $('.checkOutBtn').prop('disabled', false);
                 }*/
            }

            $('#mobileCheckOutBtn').click(function () {
                $('#m_form_checkout').submit();
            });


            var quantity = 0;

            $(document).on('click', '.add_to_cart', function () {


                //console.log('clicked');
                //$('#delivery-policy').modal('show');return;

                var order_process_type_id = $('input[name="order_process_type_id"]:checked').val();
                /*if ($(window).width() >= 767) {
                 if (typeof order_process_type_id == 'undefined') {
                 $('.alert-success').hide();
                 $('.alert-danger').show();
                 $('.alert-danger').html('You must select an order process');
                 $('.ui-empty-cart').removeClass('hidden');
                 setTimeout(function () {
                 $('.alert-danger').hide();
                 }, 3000);
                 return;
                 }
                 }*/

                var form = $(this).parents('form:first');
                var status = $(this).data('status');
                var product_id = form.find('input[name="product_id"]').val();
                var sub_product_id = form.find('input[name="sub_product_id"]').val();
                var name = form.find('input[name="product_name"]').val();
                var price = parseFloat(form.find('input[name="product_price"]').val());
                //var key = name.split(' ').join('_');
                var key = product_id;
                if(sub_product_id!=''){
                    key = product_id+"_"+sub_product_id;
                }

                $.ajax({
                    url: "<?php echo BASE_URL?>/order/check-product-offers",
                    type: "post",
                    data: { productId:key},
                    success: function (data) {
                        $(".site-loader").hide();
                        if ( data == 404) { // if no offer/bundle found
                            if (cart != null) {
                                if ((key in cart.products)) {
                                    if (status == 'increment') {
                                        $('.productAddAlert').removeClass('hide');
                                        cart.products[key].quantity += 1;
                                        cart.products[key].price += price;
                                    } else if (status == 'decrement') {
                                        if (cart.products[key].quantity != 0) {
                                            cart.products[key].quantity -= 1;
                                            cart.products[key].price -= price;
                                        }

                                    }

                                    //console.log(cart.products[key]);
                                } else {
                                    $('.productAddAlert').removeClass('hide');
                                    cart.products[key] = {
                                        product_id:  product_id,
                                        sub_product_id:  sub_product_id,
                                        name: name,
                                        price: price,
                                        quantity: 1,
                                        product_offers: [],
                                        product_variations: [],
                                        product_extras: [],
                                        product_bundles: []
                                    };
                                }
                            } else {
                                $('.productAddAlert').removeClass('hide');
                                cart = {
                                    products: {
                                        [key]: {
                                            product_id:  product_id,
                                            sub_product_id:  sub_product_id,
                                            name: name,
                                            price: price,
                                            quantity: 1,
                                            product_offers: [],
                                            product_variations: [],
                                            product_extras: [],
                                            product_bundles: []
                                        }
                                    }
                                };
                            }

                            var totalPrice = 0.00;
                            var subTotalPrice = 0.00;
                            quantity = 0;
                            $.each(cart.products, function (key, value) {
                                totalPrice += value.price;
                                subTotalPrice += value.price;
                                quantity += value.quantity;
                                // Now add extra items price
                                $.each(value.product_extras, function (key, extra) {
                                    var extra_price = extra.price * extra.quantity;
                                    totalPrice += extra_price;
                                    subTotalPrice += extra_price;
                                });
                            });
                            cart.sub_total_price = subTotalPrice;
                            cart.total_price = totalPrice.toFixed(2);
                            cart.delivery_charge = 0.00;
                            cart.quantity = quantity;

                            /*
                             console.log(cart.total_price);
                             console.log(delivery_minimum);
                             */

                            //console.log(order_process_type_id);
                            if (order_process_type_id == 1) {
                                $('.delivery-charge').show();
                                if (cart != null) {
                                    if (Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                                        $('.checkOutBtn').prop('disabled', false);
                                        if ($(window).width() < 1025) {
                                            $('#mobileCheckOutBtn').text('Checkout');
                                        } else {
                                            $('#large_checkOutBtn').text('Proceed to Checkout');
                                        }
                                    } else {
                                        $('.checkOutBtn').prop('disabled', true);
                                        if ($(window).width() < 1025) {
                                            $('#mobileCheckOutBtn').text('Min. £ '+delivery_minimum);
                                        } else {
                                            $('#large_checkOutBtn').text('Delivery Minimum £ '+delivery_minimum);
                                        }
                                    }
                                }
                                /*if (cart != null && Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                                 $('.checkOutBtn').prop('disabled', false);
                                 } else {
                                 $('.checkOutBtn').prop('disabled', true);
                                 }*/

                                var delivery_charge = "<?php if (isset($settings)) echo $settings->delivery_charge ?>";
                                cart.total_price = parseFloat(cart.total_price) + parseFloat(delivery_charge);
                                cart.delivery_charge = delivery_charge;
                                delivery_charge_added = true;
                            } else {
                                $('.delivery-charge').hide();
                                $('.checkOutBtn').prop('disabled', false);
                                if ($(window).width() < 1025) {
                                    $('#mobileCheckOutBtn').text('Checkout');
                                } else {
                                    $('#large_checkOutBtn').text('Proceed to Checkout');
                                }
                            }

                            cartHtml(cart.products, cart.total_price, cart.sub_total_price, price);
                            if ($(window).width() < 1025) {
                                $('#mobileNavBar').removeClass('hidden');
                            }


                            setTimeout(function () {
                                $('.productAddAlert').addClass('hide');
                            }, 1000);

                            //console.log(quantity);
                            $('#item_count').text(quantity);
                        }
                    },
                    error: function (e) {
                        // alert('error');
                    }
                });

                console.log(cart);
            });

            $(document).on('click', '.remove_item_from_cart', function () {
                var key = $(this).data('product_id');
                var price = $(this).data('price');
                console.log('only product');
                if (cart != null) {
                    cart.sub_total_price = parseFloat(cart.sub_total_price) - cart.products[key].price;
                    cart.total_price = parseFloat(cart.total_price) - cart.products[key].price;
                    cart.total_price = cart.total_price.toFixed(2);
                    quantity -= cart.products[key].quantity;
                    cart.quantity = quantity;
                }
                delete cart.products[key];
                //console.log(cart);

                cartHtml(cart.products, cart.total_price, cart.sub_total_price, price);

                var order_process_type_id = $('input[name="order_process_type_id"]:checked').val();
                if (order_process_type_id == 1) {
                    if (cart != null) {
                        if (Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                            $('.checkOutBtn').prop('disabled', false);
                            if ($(window).width() < 1025) {
                                $('#mobileCheckOutBtn').text('Checkout');
                            }
                        } else {
                            $('.checkOutBtn').prop('disabled', true);
                            if ($(window).width() < 1025) {
                                $('#mobileCheckOutBtn').text('Min. £ '+delivery_minimum);
                            } else {
                                $('#large_checkOutBtn').text('Delivery Minimum £ '+delivery_minimum);
                            }
                        }
                    }
                    /*if (cart != null && Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                     $('.checkOutBtn').prop('disabled', false);
                     } else {
                     $('.checkOutBtn').prop('disabled', true);
                     }*/
                } else {
                    $('.checkOutBtn').prop('disabled', false);
                    if ($(window).width() < 1025) {
                        $('#mobileCheckOutBtn').text('Checkout');
                    }
                }

                if ($('.cart_product_list tr').size() == 0) {
                    $('.order-description').hide();
                    $('.order-proceed').hide();
                    $('.ui-empty-cart').removeClass('hidden');
                    if ($(window).width() < 1025) {
                        $('#mobileNavBar').addClass('hidden');
                        $('body').removeClass('scroll-inactive');
                        $("#lab-slide-bottom-popup").removeClass("in show");
                    }
                }

                //console.log(quantity);
                $('#item_count').text(quantity);

            });

        });



        var cart = null;
        function add_to_cart(productId, decrement = null) {
            /*$("#delivery-policy").modal('show');
             return;*/

            $.ajax({
                url: "<?php echo BASE_URL?>/add-to-cart",
                type: "post",
                data: {product_id: productId, cart: cart, decrement: decrement},
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data.status == 200) {
                        //console.log(data.cart.products);
                        cart = data.cart;
                        cartHtml(data.cart.products, data.cart.total_price);
                    } else {
                    }
                }
            });
        }

        function remove_item_from_cart (productId) {
            //console.log($('#cart_product_list tr').size());return;
            //if ($('#cart_product_list li').length())
            if ($('#cart_product_list tr').size() == 1) {
                $('.order-description').hide();
                $('.order-proceed').hide();
                $('.ui-empty-cart').removeClass('hidden');
            }

            $.ajax({
                url: "<?php echo BASE_URL?>/remove-from-cart",
                type: "post",
                data: {product_id: productId, cart: cart},
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data.status == 200) {
                        //console.log(data.cart.products);
                        cart  = data.cart;
                        cartHtml(data.cart.products, data.cart.total_price);
                    } else {
                    }
                }
            });
        }

        $(function () {
            $('#form_checkout').submit(function (ev) {
                ev.preventDefault();
                var order_process_type_id = $('#form_checkout input[name="order_process_type_id"]:checked').val();
                var validate = '';
                if (typeof order_process_type_id == 'undefined') {
                    validate += 'You must select an order process'
                }
                var availability = true;
                //check current time is available or not today
                $.ajax({
                    url: "<?php echo BASE_URL?>/check-time-availability",
                    type: "post",
                    //data: {product_id: productId, cart: cart},
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        //return;
                        if (data.status == 500) {

                            window.location.href = '<?= BASE_URL ?>/common-error-message?errorMsg=Our restaurant is closed now.';
                            availability = false;
                        } else {
                        }
                    }
                });
                /*console.log(validate);
                 return;*/
                //return;
                if (!availability) {
                    return;
                }
                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                    return;
                }
                var order = JSON.stringify(cart);
                $('#form_checkout input[name="cart"]').val(order);
                $(this)[0].submit();
                //console.log($(this).serialize());
            });

            $('#m_form_checkout').submit(function (ev) {
                ev.preventDefault();
                var order_process_type_id = $('#m_form_checkout input[name="order_process_type_id"]:checked').val();
                var validate = '';
                if (typeof order_process_type_id == 'undefined') {
                    validate += 'You must select an order process';
                    $("#lab-slide-bottom-popup").toggleClass("in show");
                }
                //check current time is available or not today
                var availability = true;
                $.ajax({
                    url: "<?php echo BASE_URL?>/check-time-availability",
                    type: "post",
                    //data: {product_id: productId, cart: cart},
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        //console.log(data);
                        if (data.status == 500) {
                            window.location.href = '<?= BASE_URL ?>/common-error-message?errorMsg=Our restaurant is closed now.';
                            availability = false;
                        } else {
                        }
                    }
                });
                if (!availability) {
                    return;
                }
                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                    return;
                }
                var order = JSON.stringify(cart);
                $('#m_form_checkout input[name="cart"]').val(order);
                $(this)[0].submit();
                //console.log($(this).serialize());
            });
        });

        function placeOrder (ev) {
            var order = JSON.stringify(cart);
            window.location.href = "<?php echo BASE_URL?>/place-order?cart="+order;
            /* window.location.href = "<?php echo BASE_URL?>/checkout?cart="+order; */

            /* $.ajax({
             url: "",
             type: "post",
             data: {cart: cart},
             dataType: 'json',
             success: function (data) {
             //console.log(data);
             if (data.status == 200) {
             //console.log(data.cart.products);
             cartHtml(data.cart.products, data.cart.total_price);
             } else {
             }
             }
             }); */
        }

        function cartHtml(products, totalPrice, subTotal, originalPrice) {
            $('.order-description').show();
            $('.order-proceed').show();
            var html = '';
            $.each(products, function (key, item) {
                html += '<tr class="hobtr">';
                html += '<td class="cross-td custom-spinner">';
                html += '<div class="input-group spinner">';
                html += '<form id="form_product_details">';
                html += '<input type="hidden" name="product_id" value="'+item.product_id+'">';
                html += '<input type="hidden" name="sub_product_id" value="'+item.sub_product_id+'">';
                html += '<input type="hidden" name="product_name" value="'+item.name+'">';
                html += '<input type="hidden" name="product_price" value="'+originalPrice+'">';
                html += '<button class="btn btn-default cust-plus cust-plus-increment add_to_cart" data-status="increment" type="button" >';
                html += '<i class="fa fa-plus"></i>';
                html += '</button>';
                html += '<input class="form-control increse-val" value="'+item.quantity+'" readonly="" type="text">';
                html += '<button class="btn btn-default cust-plus cust-plus-decrement add_to_cart" data-status="decrement" type="button" >';
                html += '<i class="fa fa-minus"></i>';
                html += '</button>';
                html += '</form>';
                html += '</div><span class="qnt-idn">'+item.quantity+' x</span>';
                html += '</td>';
                html += '<td class="itme-td">'+item.name+'</td>';
                html += '<td class="amont-td">';
                if(item.sub_product_id==''){
                    html += '<i class="fa fa-times-circle-o remove_item_from_cart" data-product_id="'+item.product_id+'" data-price="'+originalPrice+'"></i> <span class="main-price">'+item.price.toFixed(2)+'</span>';
                }
                else{
                    html += '<i class="fa fa-times-circle-o remove_item_from_cart" data-product_id="'+item.product_id+'_'+item.sub_product_id+'" data-price="'+originalPrice+'"></i> <span class="main-price">'+item.price.toFixed(2)+'</span>';
                }
                html += '</td>';
                html += '</tr>';

                $.each(item.all_extra_items, function (offerKey, val) {
                    var price = (val.price*val.quantity);
                    html += '<tr class="extra">';
                    html += '<td></td>';
                    html += '<td><p>+ '+val.name+'</td>';
                    if(val.type=="extra"){
                        html += '<td class="text-right">'+ price.toFixed(2) +'</td>';
                    }
                    else{
                        html += '<td></td>';
                    }
                    html += '</tr>';
                });

                /*$.each(item.product_offer_array, function (offerKey, offerVal) {
                    html += '<tr class="extra">';
                    html += '<td></td>';
                    html += '<td><p>+ '+offerVal.name+'</td>';
                    html += '<td></td>';
                    html += '</tr>';
                });

                $.each(item.product_extras, function (extraKey, extraVal) {
                    html += '<tr class="extra">';
                    html += '<td></td>';
                    html += '<td><p>+ '+extraVal.name+'</td>';
                    html += '<td class="text-right">'+ ((extraVal.price*extraVal.quantity) - extraVal.price) +'</td>';
                    html += '</tr>';
                });

                $.each(item.product_bundles, function (bundleKey, bundleVal) {
                    html += '<tr class="extra">';
                    html += '<td></td>';
                    html += '<td><p>+ '+bundleVal.name+'</td>';
                    html += '<td></td>';
                    html += '</tr>';
                });*/
            });
            $('.cart_product_list').html(html);
            $('.order-subtotal-amount').text('£'+subTotal.toFixed(2));
            totalPrice = parseFloat(totalPrice).toFixed(2);
            //console.log(totalPrice);
            $('.order-total-amount').text('£'+totalPrice);
        }
    </script>
    <script>
        // Ajax for showing offers and extras
        jQuery(function($) {
            var addToCart       = [];
            var product_offers = [];
            var product_offer_array = [];
            var product_variations = [];
            var product_extra_array = [];
            var product_extras = [];
            var product_bundles = [];
            var all_extra_items = [];

            $(document).on('click', '.addToCart', function (event) {
                $(".site-loader").show();
                product_offers = [];
                product_offer_array = [];
                product_variations = [];
                product_extra_array = [];
                product_extras = [];
                product_bundles = [];
                all_extra_items = [];

                var form = $(this).parents('form:first');
                var sub_product_id = form.find('input[name="sub_product_id"]').val();
                var productPrice = form.find('input[name="product_price"]').val();

                var productId   = $(this).attr('product_id');
                var productName = $(this).attr('product_name');
                var productDesc = $(this).attr('product_desc');

                //var key = productId;
                if(sub_product_id!=''){
                    productId = productId+"_"+sub_product_id;
                }


                $.ajax({
                    url: "<?php echo BASE_URL?>/order/check-product-offers",
                    type: "post",
                    data: { productId:productId},
                    success: function (data) {
                        $(".site-loader").hide();
                        if ( data != 404) {
                            $('#productPopUp').modal('show');
                            var ajaxUrl     = "<?php echo BASE_URL?>/admin/product-offers";
                            // addToCart       = [];
                            $('#popup_product_id').val(productId);
                            $('#popup_sub_product_id').val(sub_product_id);
                            $('#popup_product_name').val(productName);
                            $('#popup_product_price').val(productPrice);
                            $('#productPopUp .modal-title').html(productName);
                            $('#productPopUp .modal-description').html(productDesc);

                            $('#extra-order-total-amount').html(productPrice);
                            $('#total_extra_price').val(productPrice);

                            if(data=='bundle'){
                                getProductBundle(productId,product_offers);
                            }
                            else{
                                $.ajax({
                                    url: "<?php echo BASE_URL?>/order/get-offer-type",
                                    type: "POST",
                                    data: {'product_id':productId},
                                    success: function (data) {
                                        if ( data != 404 ) {
                                            $('.selection-text').text('Select Type');
                                            $('.offer-list').html(data);
                                        }
                                        else {
                                            //getProductExtra(productId,product_offers);
                                            var type_for = $('#type_for').val();
                                            if(type_for=='bundle'){
                                                var productId = $('#popup_bundle_id').val();
                                            }
                                            else{
                                                var productId = $('#popup_product_id').val();
                                            }
                                            getProductOffers(productId,product_offers,type_for);
                                        }
                                        //$('.list_container').html(data);
                                    }
                                });
                            }

                        }
                    },
                    error: function (e) {
                        // alert('error');
                    }
                });
            });

            // add offer
            $(document).on('click','.offer-list>li.add',function(){
                $(this).parent('.offer-list').children('li').removeClass('active');
                var selectedOffer       = $(this);
                var selectedOfferId     = selectedOffer.attr('id');
                var selectedOfferName   = selectedOffer.find('strong').html();
                selectedOffer.removeClass('add').addClass('added active');
                $('popup_offer_id').val(selectedOfferId);

                $('.selectedList').append(selectedOfferProductHtml(selectedOfferName));
                addToCart.push({product:'testData'});
                //$( '.testArea' ).text( 'TestData : '+ selectedOfferId +' Name : '+ selectedOfferName);

                product_offers.push(selectedOfferId);
                product_offer_array.push({id:selectedOfferId,name:selectedOfferName,price:0});
                all_extra_items.push({id:selectedOfferId,name:selectedOfferName,price:0,quantity:1,type:'offer'});

                var type_for = $('#type_for').val();
                if(type_for=='bundle'){
                    var productId = $('#popup_bundle_id').val();
                }
                else{
                    var productId = $('#popup_product_id').val();
                }
                var offer_left = parseFloat($('#offer_left').val());
                $('#offer_left').val(offer_left-1);

                var offer_left = $('#offer_left').val();
                if(offer_left > 0) {
                    getProductOffers(productId,product_offers,type_for);
                }
                else{
                    getProductExtra(productId,product_offers,type_for);
                }


                // console.log(addToCart);
            });

            // add variation
            $(document).on('click','.offer-list>li.var_add',function(){
                $(this).parent('.offer-list').children('li').removeClass('active');
                var selectedVariation       = $(this);
                var selectedofferId     = selectedVariation.attr('data-offer_id');
                var selectedVariationId     = selectedVariation.attr('id');
                var selectedVariationName   = selectedVariation.find('strong').html();
                var productId = $('#popup_product_id').val();
                var offer_id = $('popup_offer_id').val();
                var var_type_for = $('#type_for').val();
                selectedVariation.removeClass('add').addClass('added active');

                $('.selectedList').append(selectedOfferProductHtml(selectedVariationName));
                addToCart.push({product:'testData'});
                product_variations.push({product_id:selectedofferId,variation_id:selectedVariationId,name:selectedVariationName,price:0});
                all_extra_items.push({id:selectedofferId,name:selectedVariationName,price:0,quantity:1,type:'type'});
                //$( '.testArea' ).text( 'TestData : '+ selectedVariationId +' Name : '+ selectedVariationName);


                //getofferExtra(offer_id,product_offers,'offer');
                if(var_type_for=='bundle'){
                    productId = $('#popup_bundle_id').val();
                    getProductOffers(productId,product_offers);
                }
                else{
                    getProductOffers(productId,product_offers);
                }


                // console.log(addToCart);
            });

            // add offer extra
            $(document).on('click','.offer-list>li.offer_extra_add',function(){
                $(this).parent('.offer-list').children('li').removeClass('active');
                var selectedVariation       = $(this);
                var selectedVariationId     = selectedVariation.attr('id');
                var selectedVariationName   = selectedVariation.find('strong').html();
                var productId = $('#popup_product_id').val();
                var offer_id = $('popup_offer_id').val();
                selectedVariation.removeClass('add').addClass('added active');

                $('.selectedList').append(selectedOfferProductHtml(selectedVariationName));
                addToCart.push({product:'testData'});
                //product_bundles.push({product_id:selectedVariationId,name:});


                //getProductBundle(productId,product_offers);
                //getofferExtra(offer_id,product_offers);


                // console.log(addToCart);
            });

            // add bundle
            $(document).on('click','.bundle-list>li.bundle_add',function(){
                $(this).parent('.offer-list').children('li').removeClass('active');
                var selectedBundle       = $(this);
                var selectedBundleId     = selectedBundle.attr('id');
                var selectedBundleName   = selectedBundle.find('strong').html();
                $('#popup_bundle_id').val(selectedBundleId);
                var productId = $('#popup_product_id').val();
                selectedBundle.removeClass('add').addClass('added active');

                $('.selectedList').append(selectedOfferProductHtml(selectedBundleName));
                addToCart.push({product:'testData'});
                product_bundles.push({product_id:selectedBundleId,name:selectedBundleName,price:0});
                all_extra_items.push({id:selectedBundleId,name:selectedBundleName,price:0,quantity:1,type:'bundle'});
                var bundle_left = parseFloat($('#bundle_left').val());
                $('#bundle_left').val(bundle_left-1);
                $('#type_for').val('bundle');
                $('#offer_left').val('');
                //$( '.testArea' ).text( 'TestData : '+ selectedBundleId +' Name : '+ selectedBundleName);

                getProductType(selectedBundleId,product_offers,'bundle');


                // console.log(addToCart);
            });

            // add bundle
            $(document).on('click','.offer-list>li.extra_add',function(){
                $(this).parent('.offer-list').children('li').removeClass('active');
                var selectedVariation       = $(this);
                var selectedVariationId     = selectedVariation.attr('id');
                var selectedVariationName   = selectedVariation.find('strong').html();
                var productId = $('#popup_product_id').val();
                selectedVariation.removeClass('add').addClass('added active');

                $('.selectedList').append(selectedOfferProductHtml(selectedVariationName));
                addToCart.push({product:'testData'});
                //$( '.testArea' ).text( 'TestData : '+ selectedVariationId +' Name : '+ selectedVariationName);


                getProductOffers(productId,product_offers);


                // console.log(addToCart);
            });

            $(document).on('click','.extra-add',function(){
                var expand_count = 0;
                var data_type = $(this).attr('data-type');
                var data_price = $(this).attr('data-price');
                var total_extra_price = $('#total_extra_price').val();
                var grand_total = parseFloat(data_price) + parseFloat(total_extra_price);

                $(this).attr("disabled", "true");

                $('#total_extra_price').val(grand_total.toFixed(2));
                $('#extra-order-total-amount').html(grand_total.toFixed(2));
                $('.extra-add').each(function(){
                    var is_expand = $(this).attr('aria-expanded');
                    if(is_expand=='true'){
                        expand_count++;
                    }
                    if(expand_count>0){
                        $('#skip_offer_extra_button').hide();
                        $('#skip_product_extra_button').hide();
                        if(data_type=='offer'){
                            $('#add_offer_extra_button').show();
                            $('#add_product_extra_button').hide();
                        }
                        else{
                            $('#add_offer_extra_button').hide();
                            $('#add_product_extra_button').show();
                        }

                    }
                    else{
                        if(data_type=='offer') {
                            $('#skip_offer_extra_button').show();
                            $('#skip_product_extra_button').hide();
                        }
                        else{
                            $('#skip_offer_extra_button').hide();
                            $('#skip_product_extra_button').show();
                        }
                        $('#add_offer_extra_button').hide();
                        $('#add_product_extra_button').hide();
                    }
                });
            });

            $(document).on('click','.extra-rmv',function(){

                $(this).parents('li').find('.extra-add').removeAttr('disabled');
                $(this).parents('li').find('.extra-add').attr('aria-expanded','false');
                $(this).parents('.panel-body').find('.increse-val').val('1');

                var init_val = $(this).parents('li').find('.extra-add').attr('data-price');
                $(this).parents('.panel-body').find('.extra-price').html(init_val);

                var dataId = $(this).attr('data-id');

                var total_amount = $('#extra-order-total-amount').html();
                var item_amount = $('#item_total_'+dataId).val();
                var change_total_amount = parseFloat(total_amount)-parseFloat(item_amount);


                $('#extra-order-total-amount').html(change_total_amount);
                $('#total_extra_price').val(change_total_amount);
                $('#item_total_'+dataId).val(init_val);

                var expand_count = 0;
                $('.extra-add').each(function(){
                    var is_expand = $(this).attr('aria-expanded');
                    if(is_expand=='true'){
                        expand_count++;
                    }
                    if(expand_count>0){
                        $('#add_offer_extra_button').hide();
                        $('#skip_offer_extra_button').hide();
                        $('#add_product_extra_button').show();
                        $('#skip_product_extra_button').hide();
                    }
                    else{
                        $('#add_offer_extra_button').hide();
                        $('#skip_offer_extra_button').hide();
                        $('#add_product_extra_button').hide();
                        $('#skip_product_extra_button').show();
                    }
                });
            });

            /*$(document).on('click','#add_offer_extra_button',function(){
                var data_id = $(this).attr('data-id');
                var data_type = 'offer';
                add_extra_product(data_id,data_type);

            });*/

            /*$(document).on('click','#skip_offer_extra_button',function(){
             var productId = $('#popup_product_id').val();
             getProductOffers(productId,product_offers)
             });*/

            $(document).on('click','#add_product_extra_button',function(){
                var data_id = $(this).attr('data-id');
                var data_type = 'product';
                add_extra_product(data_id,data_type);

            });

            $(document).on('click','#skip_product_extra_button',function(){
                //add_to_buscate();
                var type_for = $('#type_for').val();
                if(type_for=='bundle'){
                    var productId = $('#popup_product_id').val();
                    getProductBundle(productId,product_offers);
                }
                else{
                    $('#add_to_buscate').show();
                    $('#skip_product_extra_button').hide();
                    $('.extra-list').html('');
                    $('.selection-text').text('');
                }
            });

            $(document).on('click', '#add_to_buscate', function () {
                add_to_buscate();
            });

            function add_extra_product(data_id,type=''){
                var product_extra_id = [];
                var bundle_extras = [];
                var all_expand = 0;
                var count = $('.extra-add').length;

                $('.extra-add').each(function(){
                    var pe = [];
                    var product_id = $(this).attr('id');
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    var price = $(this).attr('data-price');
                    var is_expand = $(this).attr('aria-expanded');
                    if(is_expand=='true'){
                        if(jQuery.inArray(id, product_extra_id) === -1){
                            var extra_qty = $('#extra_qty_'+id).val();
                            product_extra_id.push(id);
                            /*pe['id'] = id;
                             pe['name'] = name;
                             pe['price'] = price;
                             pe['quantity'] = extra_qty;*/
                            product_extras.push({id:product_id,name:name,price:price,quantity:extra_qty});
                            bundle_extras.push({id:product_id,name:name,price:price,quantity:extra_qty});

                            all_extra_items.push({id:product_id,name:name,price:price,quantity:extra_qty,type:'extra'});
                            //product_extras.push(pe);
                        }
                    }

                    count = count-1;
                    var is_expand = $(this).attr('aria-expanded');

                    if(is_expand && is_expand=='true'){
                        all_expand = 1;
                    }
                    console.log(bundle_extras);
                    if(count<=0 && all_expand==1){
                        var productId = $('#popup_product_id').val();
                        //$('.selectedList').append(selectedExtraProductHtml(product_extras));
                        $('.selectedList').append(selectedExtraProductHtml(bundle_extras));
                    }

                });

                product_extra_array = product_extras;
                if(type=="offer"){   // If offer extra seleected. Now it is not in use
                    var productId = $('#popup_product_id').val();
                    getProductOffers(productId,product_offers);
                }
                else{ // if type = product . If product extra is selected.
                    //add_to_buscate();
                    var type_for = $('#type_for').val();
                    var productId = $('#popup_product_id').val();
                    if(type_for=='bundle'){ // If come from bundle
                        getProductBundle(productId,product_offers);
                    }
                    else{ // If come from offer
                        var offer_left = $('#offer_left').val();
                        if(offer_left > 0 || offer_left==''){
                            getProductOffers(productId,product_offers);
                        }
                        else{
                            $('#add_to_buscate').show();
                            $('#add_product_extra_button').hide();
                            $('.extra-list').html('');
                            $('.selection-text').text('');
                        }

                    }
                }
            }

            function getProductType(productId,product_offers,type=''){
                $.ajax({
                    url: "<?php echo BASE_URL?>/order/get-offer-type",
                    type: "POST",
                    data: {'product_id':productId},
                    success: function (data) {
                        if ( data != 404 ) {
                            $('.selection-text').text('Select Type');
                            $('.offer-list').show();
                            $('.bundle-list').hide();
                            $('.offer-list').html(data);
                            if(type=="bundle"){
                                $('#type_for').val('bundle');
                            }
                            else{
                                $('#type_for').val('offer');
                            }
                        }
                        else {
                            var pId = $('#popup_product_id').val();
                            if(type=="bundle"){
                                $('type_for').val('bundle');
                                //getProductBundle(pId,product_offers);
                                getProductOffers(productId,product_offers);
                            }
                            else{
                                $('type_for').val('offer');
                                //getProductExtra(pId,product_offers);
                                getProductOffers(pId,product_offers);
                            }

                        }
                        //$('.list_container').html(data);
                    }
                });
            }

            function getProductOffers(productId,product_offers,type=''){
                var offer_left = $('#offer_left').val();
                if(offer_left > 0 || offer_left==''){
                    $.ajax({
                        url: "<?php echo BASE_URL?>/admin/product-offers",
                        type: "POST",
                        data: {'productId':productId,offer_array:product_offers },
                        success: function (data) {
                            if ( data != 404 ) {
                                var obj = jQuery.parseJSON(data);
                                if(obj.html !=''){
                                    $('.all-offer-list').show();
                                    $('.all-extra-list').hide();

                                    $('.selection-text').text('Select Offer');
                                    $('.bundle-list').hide();
                                    $('.offer-list').show();
                                    $('.offer-list').html(obj.html);

                                    if(offer_left==''){
                                        $('#offer_left').val(obj.max_offer);
                                    }

                                    $('#add_to_buscate').show();
                                    $('#add_offer_extra_button').hide();
                                    $('#skip_offer_extra_button').hide();
                                    $('#add_product_extra_button').hide();
                                    $('#skip_product_extra_button').hide();
                                }
                                else{
                                    //getProductBundle(productId,product_offers);
                                    getProductExtra(productId,product_offers,'bundle');
                                }
                            }
                            else {
                                //getProductBundle(productId,product_offers);
                                getProductExtra(productId,product_offers,'bundle');
                            }
                            //$('.list_container').html(data);
                        }
                    });
                }
                else{
                    //getProductBundle(productId,product_offers);
                    getProductExtra(productId,product_offers,'bundle');
                }
            }

            /*function getofferExtra(offerId,product_offers,type){
                $.ajax({
                    url: "<?php echo BASE_URL?>/order/get-offer-extra",
                    type: "POST",
                    data: {'product_id':offerId},
                    success: function (data) {
                        if ( data != 404 && data != '' ) {
                            $('.selection-text').text('Select Extra');
                            $('.extra-list').html(data);
                            $('.all-offer-list').hide();
                            $('.all-extra-list').show();

                            $('#add_to_buscate').hide();
                            $('#add_offer_extra_button').hide();
                            $('#skip_offer_extra_button').show();
                            $('#add_product_extra_button').hide();
                            $('#skip_product_extra_button').hide();
                        }
                        else {
                            var productId = $('#popup_product_id').val();
                            if(type=='offer'){
                                getProductOffers(productId,product_offers);
                            }
                            else if(type='bundle'){
                                getProductBundle(productId,product_offers);
                            }

                        }
                        //$('.list_container').html(data);
                    }
                });
            }*/

            function getProductBundle(productId,product_offers){
                var is_bundle = $('#is_bundle').val();
                var bundle_left = $('#bundle_left').val();
                var bundle_step = $('#bundle_step').val();
                var bundle_max_step = $('#bundle_max_step').val();

                if(bundle_max_step != '' && bundle_step >= bundle_max_step && bundle_left==0){
                    /*var productId = $('#popup_bundle_id').val();
                    getProductExtra(productId,product_offers);*/
                    $('.all-offer-list').show();
                    $('.all-extra-list').hide();

                    $('.offer-list').hide();
                    $('.bundle-list').show();

                    $('.selection-text').text('');
                    $('.bundle-list').html('');

                    $('#add_to_buscate').show();
                    $('#add_offer_extra_button').hide();
                    $('#skip_offer_extra_button').hide();
                    $('#add_product_extra_button').hide();
                    $('#skip_product_extra_button').hide();
                }
                else{
                    if(parseFloat(bundle_left)==0){
                        bundle_step = parseFloat(bundle_step)+1;
                    }
                    $.ajax({
                        url: "<?php echo BASE_URL?>/order/get-product-bundle",
                        type: "POST",
                        data: {'product_id':productId,'bundle_step':bundle_step},
                        success: function (data) {
                            var obj = jQuery.parseJSON(data);
                            if ( data != 404 ) {
                                if(bundle_max_step==''){
                                    $('#bundle_max_step').val(obj.max_step);
                                }

                                if(bundle_step==''){
                                    $('#bundle_step').val(obj.min_step);
                                }
                                else{
                                    $('#bundle_step').val(bundle_step);
                                }
                                if(bundle_left=='' || bundle_left==0 ){
                                    $('#bundle_left').val(obj.max_bundle);
                                }
                                $('.all-offer-list').show();
                                $('.all-extra-list').hide();

                                $('.offer-list').hide();
                                $('.bundle-list').show();

                                $('.selection-text').text('Select Bundle');
                                $('.bundle-list').html(obj.html);

                                $('#add_to_buscate').show();
                                $('#add_offer_extra_button').hide();
                                $('#skip_offer_extra_button').hide();
                                $('#add_product_extra_button').hide();
                                $('#skip_product_extra_button').hide();
                            }
                            else if(bundle_step < bundle_max_step) {
                                var productId = $('#popup_bundle_id').val();
                                $('#bundle_step').val(parseFloat(bundle_step)+1);
                                $('#bundle_left').val(0);
                                getProductBundle(productId,product_offers);
                            }
                            else{
                                var productId = $('#popup_bundle_id').val();
                                //getProductExtra(productId,product_offers);
                                $('.all-offer-list').show();
                                $('.all-extra-list').hide();

                                $('.offer-list').hide();
                                $('.bundle-list').show();

                                $('.selection-text').text('');
                                $('.bundle-list').html('');

                                $('#add_to_buscate').show();
                                $('#add_offer_extra_button').hide();
                                $('#skip_offer_extra_button').hide();
                                $('#add_product_extra_button').hide();
                                $('#skip_product_extra_button').hide();
                            }
                            //$('.list_container').html(data);
                        }
                    });
                }

            }

            function getProductExtra(productId,product_offers,type=''){
                $.ajax({
                    url: "<?php echo BASE_URL?>/order/get-product-extra",
                    type: "POST",
                    data: {'product_id':productId},
                    success: function (data) {
                        if ( data != 404 ) {
                            $('.selection-text').text('Select Extra');
                            $('.extra-list').html(data);
                            $('.all-offer-list').hide();
                            $('.all-extra-list').show();

                            $('#add_to_buscate').hide();
                            $('#add_offer_extra_button').hide();
                            $('#skip_offer_extra_button').hide();
                            $('#add_product_extra_button').hide();
                            $('#skip_product_extra_button').show();
                        }
                        else {
                            if(type=='bundle'){
                                productId = $('#popup_product_id').val();
                                getProductBundle(productId,product_offers);
                            }
                            else{
                                //add_to_buscate();
                                $('.all-offer-list').hide();
                                $('.all-extra-list').hide();
                                $('#add_to_buscate').show();
                            }
                        }
                        //$('.list_container').html(data);
                    }
                });
            }

            function add_to_buscate(){
                var order_process_type_id = $('input[name="order_process_type_id"]:checked').val();

                var product_id = $('#popup_product_id').val();
                var product_price = $('#popup_product_price').val();
                var product_name = $('#popup_product_name').val();
                var sub_product_id = $('#popup_sub_product_id').val();
                var extra_price_with_main = parseFloat($('#total_extra_price').val());
                //var price = parseFloat(extra_price);
                var price = parseFloat(product_price);
                var only_extra_item_price = extra_price_with_main - price;
                var key = product_id;
                if(sub_product_id!=''){
                    key = product_id+"_"+sub_product_id;
                }
                if (cart != null) {
                    if ((key in cart.products)) {
                        $('.productAddAlert').removeClass('hide');
                        cart.products[key].price = price;
                        cart.products[key].product_offers = product_offers;
                        cart.products[key].product_offer_array = product_offer_array;
                        cart.products[key].product_variations = product_variations;
                        cart.products[key].product_extras = product_extra_array;
                        cart.products[key].product_bundles = product_bundles;
                        cart.products[key].all_extra_items = all_extra_items;

                    } else {
                        $('.productAddAlert').removeClass('hide');
                        cart.products[key] = {
                            product_id:  product_id,
                            sub_product_id:  sub_product_id,
                            name: product_name,
                            price: price,
                            quantity: 1,
                            product_offers: product_offers,
                            product_variations: product_variations,
                            product_extras: product_extra_array,
                            product_bundles: product_bundles,
                            all_extra_items: all_extra_items
                        };
                    }
                } else {
                    $('.productAddAlert').removeClass('hide');
                    cart = {
                        products: {
                            [key]: {
                                product_id:  product_id,
                                sub_product_id:  sub_product_id,
                                name: product_name,
                                price: price,
                                quantity: 1,
                                product_offers: product_offers,
                                product_variations: product_variations,
                                product_extras: product_extra_array,
                                product_bundles: product_bundles,
                                all_extra_items: all_extra_items
                            }
                        }
                    };
                }

                var totalPrice = 0.00;
                var subTotalPrice = 0.00;
                quantity = 0;
                $.each(cart.products, function (key, value) {
                    totalPrice += value.price;
                    subTotalPrice += value.price;
                    quantity += value.quantity;
                    // Now add extra items price
                    $.each(value.product_extras, function (key, extra) {
                        var extra_price = extra.price * extra.quantity;
                        totalPrice += extra_price;
                        subTotalPrice += extra_price;
                    });
                });
                cart.sub_total_price = subTotalPrice;
                cart.total_price = totalPrice.toFixed(2);
                cart.delivery_charge = 0.00;
                cart.quantity = quantity;


                if (order_process_type_id == 1) {
                    $('.delivery-charge').show();
                    if (cart != null) {
                        if (Number(cart.sub_total_price) >= Number(delivery_minimum) ) {
                            $('.checkOutBtn').prop('disabled', false);
                            if ($(window).width() < 1025) {
                                $('#mobileCheckOutBtn').text('Checkout');
                            } else {
                                $('#large_checkOutBtn').text('Proceed to Checkout');
                            }
                        } else {
                            $('.checkOutBtn').prop('disabled', true);
                            if ($(window).width() < 1025) {
                                $('#mobileCheckOutBtn').text('Min. £ '+delivery_minimum);
                            } else {
                                $('#large_checkOutBtn').text('Delivery Minimum £ '+delivery_minimum);
                            }
                        }
                    }

                    var delivery_charge = "<?php if (isset($settings)) echo $settings->delivery_charge ?>";
                    cart.total_price = parseFloat(cart.total_price) + parseFloat(delivery_charge);
                    cart.delivery_charge = delivery_charge;
                    delivery_charge_added = true;
                } else {
                    $('.delivery-charge').hide();
                    $('.checkOutBtn').prop('disabled', false);
                    if ($(window).width() < 1025) {
                        $('#mobileCheckOutBtn').text('Checkout');
                    } else {
                        $('#large_checkOutBtn').text('Proceed to Checkout');
                    }
                }

                cartHtml(cart.products, cart.total_price, cart.sub_total_price, extra_price_with_main);
                if ($(window).width() < 1025) {
                    $('#mobileNavBar').removeClass('hidden');
                }


                setTimeout(function () {
                    $('.productAddAlert').addClass('hide');
                }, 1000);

                $('#item_count').text(quantity);
                $('#productPopUp').modal('hide');

                console.log(cart);
                console.log(all_extra_items);
            }
        });


        function selectedOfferProductHtml(name='offer name') {
            var data = '<div class="row offer-selected-item selectedOfferProduct">'+
                '<div class="col-sm-1 col-xs-2">'+
                '<div class="extra-td text-right">'+
                '<div class="btn-group" data-toggle="buttons">'+
                '<label class="btn offer-add extra-added active">'+
                '<input type="checkbox" autocomplete="off" checked="checked" disabled="">'+
                '<span class="glyphicon glyphicon-ok"></span>'+
                '</label>'+
                '</div>'+
                '</div>'+
                '</div>'+

                '<div class="col-sm-11 col-xs-10">'+
                '<p><strong id="productName">'+ name +'</strong></p>'+
                '</div>'+
                '</div>';
            return data;
        }

        function selectedExtraProductHtml(extra=[]) {
            var extra_item = 'Extras: ';
            $.each(extra, function( k, v ) {
                extra_item +=v['name']+',';
            });
            var data = '<div class="row offer-selected-item selectedOfferProduct">'+
                '<div class="col-sm-1  col-xs-2">'+
                '<div class="extra-td text-right">'+
                '<div class="btn-group" data-toggle="buttons">'+
                '<label class="btn offer-add extra-added active">'+
                '<input type="checkbox" autocomplete="off" checked="checked" disabled="">'+
                '<span class="glyphicon glyphicon-ok"></span>'+
                '</label>'+
                '</div>'+
                '</div>'+
                '</div>'+

                '<div class="col-sm-11 col-xs-10">'+
                '<p><strong id="productName">'+ extra_item +'</strong></p>'+
                '</div>'+
                '</div>';
            return data;
            console.log('extra');
            console.log(data);
        }

    </script>

<?php require_once "view/base/customer/footer.php"; ?>