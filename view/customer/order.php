<?php require_once "view/base/customer/header.php"?>

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
        <div>
            <!--span class="section-suptitle text-center">Food Lover</span-->
            <h1 class="section-title white-font text-center margin-top-40">Order Online</h1>
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
                            <!--li role="presentation">
                                <a href="#Offer" aria-controls="Offer" role="tab" data-toggle="tab">
                                    <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                                    Offer
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#Reservation" aria-controls="Reservation" role="tab" data-toggle="tab">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                    Reservation
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#Info" aria-controls="Info" role="tab" data-toggle="tab">
                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    Info
                                </a>
                            </li-->
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
                                            <?php }?>
                                            <!--<li class="">
                                                <a href="#category02" class="scroll-section">STARTERS</a>
                                            </li>-->
                                        </ul>
                                    </div>

                                    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
                                        <div class="category-dish-container">
                                            <?php if (!empty($categories))
                                                foreach ($categories as $category) {?>
                                                <?php
                                                $categoryName = explode(' ', $category->category_name);
                                                $key = array_search('&', $categoryName);
                                                if ($key) {
                                                    unset($categoryName[$key]);
                                                }
                                                $categoryName = implode('_', $categoryName);
                                                ?>
                                                <?php if (!empty($category->products)) {?>
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
                                                                        <div class="col-md-9">
                                                                            <div class="dish-name"><?= $product->name; ?></div>
                                                                            <p class="dish-details"><?php if (isset($product->description)) echo $product->description; ?></p>
                                                                            <!--<p class="dish-details">
                                                                                <b>Allergens Info:</b>
                                                                                <span class="allergensInfo">Mustard</span>
                                                                            </p>-->
                                                                        </div>
                                                                        <?php if (empty($product->sub_products)){?>
                                                                        <div class="col-md-3">
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
                                                                                        <a class="add_to_cart" product_id="<?= $product->product_id ?>" product_name="<?= $product_title ?>" product_desc="<?= $product_desc ?>" data-status="increment" onclick=""><i class="fa fa-plus"></i></a>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>

                                                                    <?php if (!empty($product->sub_products)) foreach ($product->sub_products as $sub_product) {?>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <div class="dish-name"><?= $sub_product->name; ?></div>
                                                                        </div>
                                                                        <div class="col-md-3">
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
                                                                                        <a class="add_to_cart" product_id="<?= $product->product_id ?>" product_name="<?= $product_title ?>" product_desc="<?= $product_desc ?>" data-status="increment" onclick=""><i class="fa fa-plus"></i></a>
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
                                                <?php /*if (!empty($_SESSION['cart']['products'])) foreach ($_SESSION['cart']['products'] as $item) {*/?><!--
                                            <tr class="hobtr">
                                                <td class="cross-td custom-spinner">
                                                    <div class="input-group spinner">
                                                        <button class="btn btn-default cust-plus cust-plus-increment" type="button" onclick="add_to_cart(<?/*= $item['product_id'] */?>)">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <input class="form-control increse-val" value="<?/*= $item['quantity'] */?>" readonly="" type="text">
                                                        <button class="btn btn-default cust-plus cust-plus-decrement" type="button" onclick="add_to_cart(<?/*= $item['product_id'] */?>, true)">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div><span class="qnt-idn"><?/*= $item['quantity'] */?> x</span>
                                                </td>
                                                <td class="itme-td"><?/*= $item['name'] */?></td>
                                                <td class="amont-td">
                                                    <i class="fa fa-times-circle-o" onclick="remove_item_from_cart(<?/*= $item['product_id'] */?>)"></i> <span class="main-price"><?/*= $item['price'] */?></span>
                                                </td>
                                            </tr>
                                            --><?php /*}*/?>

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
                                            <div class="row color-gray order-description-delivery delivery-charge">
                                                <div class="col-md-8 col-xs-8">
                                                    <p>Delivery Charge: </p>
                                                </div>
                                                <div class="col-md-4 col-xs-4 text-right">£<?php if (isset($settings)) echo number_format($settings->delivery_charge, 2, '.', '') ?></div>
                                            </div>
                                            <!-- <div class="row color-gray">
                                                <div class="col-md-8 col-xs-8">
                                                    <p>Discount: </p>
                                                </div>
                                                <div class="col-md-4 col-xs-4 text-right">0.00</div>
                                            </div> -->
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

    <!--Add Type modal-->
    <!-- Modal -->
    <div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Karma</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="typeDetails">
                                <span>Chicken</span>
                                <span>$8.50</span>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <p class="typeDetails">
                                <span>Chicken</span>
                                <span>$8.50</span>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <p class="typeDetails">
                                <span>Chicken</span>
                                <span>$8.50</span>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <p class="typeDetails">
                                <span>Chicken</span>
                                <span>$8.50</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Offer START -->
    <div class="modal fade" id="addOffer" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Parent Product Name, Product name</h4>
                    <p class="modal-description">Test Product Description</p>
                </div>

                <div class="modal-body">
                    <div class="cart-content">
                        <!--warning-->
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

                        </div>
                        <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                        <!--warning end-->

                        <div class="cfo-cart clearfix">
                            <div class="cart-info" id="ExtraCart">
                                <form action="">
                                    <div class="extra-table">
                                        <ul>
                                            <li>
                                                <div class="row no-margin">

                                                    <div class="col-sm-6">
                                                        <div class="itme-td">Test product 01</div>
                                                    </div>

                                                    <div class="col-sm-5 text-right">
                                                        <div class="extra-td">
                                                            <span class="extra-price">1000.00</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="extra-td text-right">
                                                            <div class="btn-group" >
                                                                <label class="btn offer-add" type="button" data-toggle="collapse" data-target="#extra01">
                                                                    <i class="fa fa-plus"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="extra01" class="extra-collespe-panel panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row no-margin">
                                                            <div class="col-sm-1">
                                                                <a class="common-close-btn extra-rmv" href="javascript:;"><i class="fa fa-close"></i></a>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <div class="hobtr add-dlt-col">
                                                                    <div class="cross-td custom-spinner offer-spiner">
                                                                        <div class="input-group spinner l10">
                                                                            <input type="hidden" class="product_price" name="product_price" value="1000.00">
                                                                            <button class="btn btn-default cust-plus offer-plus-increment" data-status="increment" type="button"><i class="fa fa-plus"></i></button>
                                                                            <input class="form-control increse-val" value="1" readonly="" type="text">
                                                                            <button class="btn btn-default cust-plus offer-plus-decrement" data-status="decrement" type="button"><i class="fa fa-minus"></i></button>
                                                                        </div><span class="qnt-idn">1</span>x
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-10 text-right">
                                                                <div class="extra-td lh-43">
                                                                    <span class="extra-price">1000.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="row no-margin">

                                                    <div class="col-sm-6">
                                                        <div class="itme-td">Test product 01</div>
                                                    </div>

                                                    <div class="col-sm-5 text-right">
                                                        <div class="extra-td">
                                                            <span class="extra-price">700</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="extra-td text-right">
                                                            <div class="btn-group" >
                                                                <label class="btn offer-add" type="button" data-toggle="collapse" data-target="#extra02">
                                                                    <i class="fa fa-plus"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="extra02" class="extra-collespe-panel panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row no-margin">
                                                            <div class="col-sm-1">
                                                                <a class="common-close-btn" href="javascript:;"><i class="fa fa-close"></i></a>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <div class="hobtr add-dlt-col">
                                                                    <div class="cross-td custom-spinner offer-spiner">
                                                                        <div class="input-group spinner l10">
                                                                            <input type="hidden" class="product_price" name="product_price" value="700">
                                                                            <button class="btn btn-default cust-plus offer-plus-increment" data-status="increment" type="button"><i class="fa fa-plus"></i></button>
                                                                            <input class="form-control increse-val" value="1" readonly="" type="text">
                                                                            <button class="btn btn-default cust-plus offer-plus-decrement" data-status="decrement" type="button"><i class="fa fa-minus"></i></button>
                                                                        </div><span class="qnt-idn">1</span>x
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-10 text-right">
                                                                <div class="extra-td lh-43">
                                                                    <span class="extra-price">700</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="row no-margin">

                                                    <div class="col-sm-6">
                                                        <div class="itme-td">Test product 01</div>
                                                    </div>

                                                    <div class="col-sm-5 text-right">
                                                        <div class="extra-td">
                                                            <span class="extra-price">500</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="extra-td text-right">
                                                            <div class="btn-group" >
                                                                <label class="btn offer-add" type="button" data-toggle="collapse" data-target="#extra03">
                                                                    <i class="fa fa-plus"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="extra03" class="extra-collespe-panel panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row no-margin">
                                                            <div class="col-sm-1">
                                                                <a class="common-close-btn" href="javascript:;"><i class="fa fa-close"></i></a>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <div class="hobtr add-dlt-col">
                                                                    <div class="cross-td custom-spinner offer-spiner">
                                                                        <div class="input-group spinner l10">
                                                                            <input type="hidden" class="product_price" name="product_price" value="500">
                                                                            <button class="btn btn-default cust-plus offer-plus-increment" data-status="increment" type="button"><i class="fa fa-plus"></i></button>
                                                                            <input class="form-control increse-val" value="1" readonly="" type="text">
                                                                            <button class="btn btn-default cust-plus offer-plus-decrement" data-status="decrement" type="button"><i class="fa fa-minus"></i></button>
                                                                        </div><span class="qnt-idn">1</span>x
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-10 text-right">
                                                                <div class="extra-td lh-43">
                                                                    <span class="extra-price">500</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="ui-order-description order-description" style="">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-4">
                                                <p>Total: </p>
                                            </div>
                                            <div class="col-md-8 col-xs-8 text-right ">£<span id="extra-order-total-amount" class="">1000</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn common-btn SkipExtra sm-btn" data-dismiss="modal">Skip Extra</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Add Offer END -->

<?php require_once "view/base/customer/pre_footer.php" ?>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

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
                    /* action = "<?= BASE_URL ?>/delivery-address"; */
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


                //Add offser modal
                //$('#addOffer').modal('show');

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
                            quantity: 1
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
                                quantity: 1
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

                //console.log(cart);
            });

            $(document).on('click', '.remove_item_from_cart', function () {
                var key = $(this).data('product_id');
                var price = $(this).data('price');
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
            console.log('clicked');


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
            console.log('clicked remove_item_from_cart');
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
                        console.log(data);
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
                html += '<i class="fa fa-times-circle-o remove_item_from_cart" data-product_id="'+item.product_id+'" data-price="'+originalPrice+'"></i> <span class="main-price">'+item.price.toFixed(2)+'</span>';
                html += '</td>';
                html += '</tr>';
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
            $(document).on('click', '.add_to_cart', function (event) {
                var productId   = $(this).attr('product_id');
                var productName = $(this).attr('product_name');
                var productDesc = $(this).attr('product_desc');
                var ajaxUrl     = "<?php echo BASE_URL?>/admin/product-offers";
                $('#addOffer .modal-title').html(productName);
                $('#addOffer .modal-description').html(productDesc);
                $.ajax({
                    url: ajaxUrl,
                    type: "post",
                    data: {productId:productId},
                    success: function (data) {
                        // alert(data);
                        // console.log(data);
                        if ( data != 404 ) {
                            $('#ExtraCart').html(data);
                            $('#addOffer').modal('show');
                        }
                        
                    },
                    error: function (e) {
                        // alert('error');
                    }
                });
            });
        });

    </script>

<?php require_once "view/base/customer/footer.php"?>