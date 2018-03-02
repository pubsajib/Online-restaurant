<?php require_once "view/base/customer/header.php"?>
	<!-- Loader Bloc -->
	<div class="site-loader" style="display: none;">
		<div class="loading"></div>
		<div class="processing">waiting for confirmation</div>
	</div>
	<!-- End Loader Bloc -->
    <!-- page topper without breadcrumb-->
    <section class="page-topper">
    </section>
    <!-- page topper without breadcrumb end--> 

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

                <!-- Address content all -->
                <!--<form id="proceed_checkout" action="<?/*= BASE_URL */?>/checkout" method="post">
                    <input type="hidden" name="cart" value='<?/*= $cartObjectAsString*/?>'>
                    <input type="hidden" name="order_process_type_id" value='<?php /*if (isset($order_process_type_id)) echo $order_process_type_id;*/?>'>
                </form>-->
				
				<!-- For address picker from postcode -->
				<div class="col-sm-12 col-xs-12">
					<div class="hidden" id="showAddress">
						<button type="button" id="addCloseBtn" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<!--<div class="row address_list hidden">
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, enim! </span>
											<span>Lorem ipsum dolor sit amet, </span>
											<span>Lorem ipsum.</span>
										</address>
									</a>
								</div>
							</div>
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>	
							<div class="col-sm-12 col-xs-12">
								<div class="selectedTab">
									<a href="javascript:;">
										<address>
											<span>London HC, </span>
											<span>North Whetstone, </span>
											<span>London</span>
										</address>
									</a>
								</div>
							</div>
						</div>-->

						<div class="table-responsive address_list_table">          
						  	<table class="table table-hover">
						    	<tbody class="address_list" >
								<!--<tr>
									<td>
										<div class="selectedTab">
											<a href="javascript:;">
												<address>
													<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, enim! </span>
													<span>Lorem ipsum dolor sit amet, </span>
													<span>Lorem ipsum.</span>
												</address>
											</a>
										</div>
									</td>
								</tr>-->
						      	</tbody>
						    </table>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
                <!-- start category content all -->
                <form id="proceed_payment" action="<?= BASE_URL ?>/place-order" method="post">
					<input type="hidden" name="order_process_type_id" value='<?php if (isset($order_process_type_id)) echo $order_process_type_id;?>'>
                    <?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
                    <div class="col-md-12">
                        <div class="checkout-content dAddress-content">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <h3 class="no-margin-top">Your Delivery Address</h3>
                                    <hr class="margin-top-0">

                                    <ul class="list-unstyled">
                                    	<li>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4 col-md-4 col-lg-4">Postcode: <span class="text-danger">*</span></label>
                                                <div class="col-sm-4 col-md-5 col-lg-5">
                                                    <input class="text form-control" name="postcode" id="" placeholder="Postcode" max="10" type="text" value="<?php if (isset($customer)) echo $customer->postcode ?>">
                                                </div>
                                                <!-- For address picker button from postcode -->
                                                <div class="col-sm-4 col-md-3 col-lg-3">
                                                	<button type="button" id="findAddress" class="btn btn-success btn-block">Find Address</button>
                                                </div> 
                                            </div>

                                        </li>
                                        <li>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Address 1: <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="address1" id="" placeholder="Address1" type="text" value="<?php echo (isset($customer) && $customer->flat_house_no != '') ? $customer->flat_house_no:''; echo (isset($customer) && $customer->street != '') ? ' '.$customer->street: '' ?>">
                                                </div>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Address 2:</label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="address2" id="" placeholder="Address 2" type="text">
                                                </div>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Town/City: <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="town" id="town" placeholder="Town/City" type="text" value="<?php if (isset($customer)) echo $customer->city_town ?>">
                                                </div>
                                            </div>

                                        </li>
                                        
                                        <!-- <li>
                                            <button type="submit" class="btn  btn-danger">Continue</button>
                                        </li> -->
                                    </ul>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <h3 class="no-margin-top">Delivery Areas</h3>
                                    <hr class="margin-top-0">

                                    <textarea name="order_instruction" class="form-control" readonly="" rows="8"><?php
                                        $code = '';
                                        if (!empty($postcodes)) foreach ($postcodes as $postcode) {
                                            $code .= $postcode->postcode_no.', ';
                                            //echo $postcode->postcode_no.',';
                                        }
                                        $code = rtrim($code, ', ');
                                        echo $code;
                                        ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }?>

                    <div class="col-md-9">
	                    <div class="checkout-content">
	                        <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <h3 class="no-margin-top">Order Information</h3>
                                    <hr class="margin-top-0">
                                    <div class="form-inline">
                                        <label class="margin-right-20" style="margin-top:6px">Collection / Delivery Time:</label>
                                        <select name="order_delivery_time" class="form-control" id="order_delivery_time">
                                            <option value="Asap">ASAP</option>
                                            <?php if (!empty($deliveryTimes)) foreach ($deliveryTimes as $time) {?>
                                                <option value="<?= $time->delivery_time?>" ><?= $time->delivery_time?></option>
                                            <?php }?>
                                            <!--<option>06.30 PM</option>-->
                                        </select>
                                    </div>
                                    <!-- <div class="radio">
	                                    <input type="radio" name="order_process_type_id" id="radio1" value="<?php if (isset($orderProcessType)) echo $orderProcessType->order_process_type_id ?>" checked>
	                                    <label for="radio1">
	                                        <?php if (isset($orderProcessType)) echo $orderProcessType->order_process_name ?>
	                                    </label>
	                                </div>
	                                <hr>

	                                <div class="radio">
	                                    <input type="radio" name="radio1" id="radio2" value="option1" checked>
	                                    <label for="radio1">
	                                        Later
	                                    </label>
	                                </div> -->

                                    <hr class="no-margin-bottom">

                                </div>

	                            <div class="col-sm-6 col-xs-12">
	                                <h3 class="no-margin-top">Special Request</h3>
	                                <hr class="margin-top-0">

	                                <textarea name="order_instruction" class="form-control" rows="3"></textarea>
	                                <small><i>* Please write in the above box if you have any allergy</i><small>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="checkout-content">
	                        <div class="row">
	                            <div class="col-sm-12 col-xs-12">
	                                <h3 class="no-margin-top">Payment Options</h3>
	                                <hr class="margin-top-0">

	                                <ul class="list-inline">
										<?php $counter = 1; ?>
	                                    <?php if (!empty($paymentTypes)) {
                                            $paymentTypes = array_reverse($paymentTypes);
                                            foreach ($paymentTypes as $paymentType) { ?>
                                                <li>
                                                    <div class="radio">
                                                        <input type="radio" name="payment_type" id="payment_<?=$counter?>"
                                                               value="<?= $paymentType->payment_type_id ?>">
                                                        <label for="payment_<?=$counter?>">
                                                            <?= $paymentType->payment_type_name ?>
                                                        </label>
                                                    </div>
                                                </li>
												<?php $counter++;?>
                                        <?php
                                            }
                                        }
	                                    ?>
	                                    <!--<li>
	                                        <div class="radio">
	                                            <input type="radio" name="payment" id="" value="paypal">
	                                            <label for="radio2">
	                                                Paypal
	                                            </label>
	                                        </div>
	                                    </li>-->
	                                </ul>
	                                <hr>

	                                <div class="col-md-12 payment-method-logos modify-payment-logo no-padding">
	                                <ul class="list-inline">
	                                    <?php if (!empty($paymentTypes)) {
                                            foreach ($paymentTypes as $paymentType) { ?>
                                                <?php if ($paymentType->payment_type_id == 1) { ?>
                                                    <li>
                                                        <img src="<?= BASE_URL ?>/assets/customer/img/paypal_logo_by_cgiphoto.jpg">
                                                    </li>
                                                <?php } elseif ($paymentType->payment_type_id == 2) { ?>
                                                    <li>
                                                        <img class="cash-logo" src="<?= BASE_URL ?>/assets/customer/img/cash.png">
                                                    </li>
                                                <?php }
                                            }
                                        }
	                                    ?>
	                                </ul>
	                           </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                    <!-- end category content all -->

                    <!-- start cart content -->
                    <div class="col-md-3 ui-order-online-right-side no-padding-top" id="checkout-cart-lg">
	                    <div class="sticky-wrapper">
	                        <div class="ui-order-policy-2 delivery-time">
	                            <?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
	                                <span class="est-deli">Estimated delivery time</span>
	                                <span class="deli-time" id="col_del_time"><?php if(isset($settings)) echo $settings->estimated_delivery_time;?> <p><small>minutes</small></p></span>
	                            <?php } elseif (isset($orderProcessType) && $orderProcessType->order_process_type_id == 2) {?>
	                                <span class="est-deli">Estimated collection time</span>
	                                <span class="deli-time" id="col_del_time"><?php if(isset($settings)) echo $settings->estimated_collection_time;?> <p><small>minutes</small></p></span>
	                            <?php }?>
	                        </div>

	                        <div class="cart-content">
	                            <div class="cfo-cart clearfix">
	                                <div class="cart-info" id="mainCart">
	                                    <h2>My Order</h2>
	                                    <div class="cart-table">
	                                        <table class="table table-striped checkout-table">
	                                            <tbody>
	                                            <?php if (isset($cart) && isset($cart->products)) foreach($cart->products as $product) { ?>
	                                            <tr class="">
	                                                <td class="cross-td custom-spinner">
	                                                    <div class="input-group spinner">
	                                                        <button class="btn btn-default cust-plus cust-plus-increment" type="button"><i class="fa fa-plus"></i>
	                                                        </button>
	                                                        <input class="form-control increse-val" value="<?= $product->quantity ?>" readonly="" type="text">
	                                                        <button class="btn btn-default cust-plus cust-plus-decrement" type="button"><i class="fa fa-minus"></i>
	                                                        </button>
	                                                    </div><span class="qnt-idn"><?= $product->quantity ?> x</span>
	                                                </td>
	                                                <td class="itme-td"><?= $product->name ?></td>
	                                                <td class="amont-td"><i class="fa fa-times-circle-o" ></i> <span class="main-price"><?= number_format($product->price, 2, '.', '') ?></span>
	                                                </td>
	                                            </tr>
													<?php foreach($product->all_extra_items as $offer) { ?>
														<tr class="extra">
															<td></td>
															<td><p><?php echo $offer->name ?></td>
															<?php if($offer->type=="extra"){ ?>
																<td><?php echo ($offer->price*$offer->quantity) ?></td>
															<?php }
															else { ?>
																<td></td>
															<?php } ?>
														</tr>
													<?php } ?>
													<?php /*foreach($product->product_offer_array as $offer) { ?>
														<tr class="extra">
															<td></td>
															<td><p><?php echo $offer->name ?></td>
															<td></td>
														</tr>
													<?php } ?>
													<?php foreach($product->product_extras as $extra) { ?>
														<tr class="extra">
															<td></td>
															<td><p><?php echo $extra->name ?></td>
															<td><?php echo ($extra->price*$extra->quantity) - $extra->price ?></td>
														</tr>
													<?php } ?>
													<?php foreach($product->product_bundles as $bundle) { ?>
														<tr class="extra">
															<td></td>
															<td><p><?php echo $bundle->name ?></td>
															<td></td>
														</tr>
													<?php } */?>
	                                            <?php }?>
	                                            <!--<tr class="">
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
	                                    <div class="ui-order-description">
	                                        <div class="row color-gray">
	                                            <div class="col-md-8 col-xs-8">
	                                                <p>Subtotal: </p>
	                                            </div>
	                                            <div class="col-md-4 col-xs-4 text-right checkout-amout">£<?php if (isset($cart)) echo number_format($cart->sub_total_price, 2, '.', ''); ?></div>
	                                        </div>
											<?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
	                                        <div class="row color-gray">
	                                            <div class="col-md-8 col-xs-8">
	                                                <p>Delivery Charge: </p>
	                                            </div>
	                                            <div class="col-md-4 col-xs-4 text-right  checkout-amout">£<?php if (isset($cart)) echo number_format($cart->delivery_charge, 2, '.', ''); ?></div>
	                                        </div>
											<?php }?>
											<div class="row color-gray" id="cp_charge_area" style="display:none">
												<div class="col-md-8 col-xs-8">
													<p>Card Payment Charge: </p>
												</div>
												<div class="col-md-4 col-xs-4 text-right  checkout-amout">£<?php echo number_format($card_payment_charge, 2, '.', '')?></div>
											</div>
	                                        <div class="row color-gray">
	                                            <div class="col-md-8 col-xs-8">
	                                                <p>Discount: </p>
	                                            </div>
												<div class="col-md-4 col-xs-4 text-right  checkout-amout">-£<?php echo number_format($_SESSION['discount_price'], 2, '.', '') ?></div>
	                                        </div>
	                                        <div class="row">
	                                            <div class="col-md-4 col-xs-4">
	                                                <p>Total: </p>
	                                            </div>
	                                            <div class="col-md-8 col-xs-8 text-right"><span id="order-total-amount" class="order-total-amount">£<?php if (isset($cart)) echo number_format($cart->total_price - $_SESSION['discount_price'], 2, '.', ''); ?></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="cfo-checkoutarea">
	                                        <input type="hidden" name="cart" value='<?= $cartObjectAsString?>'>
	                                        <input type="hidden" name="total_price" id="total_price" value='<?= number_format($cart->total_price, 2, '.', '') ?>'>
	                                        <input type="hidden" name="discount_price" id="discount_price" value='<?= number_format($_SESSION['discount_price'], 2, '.', '') ?>'>
	                                        <input type="hidden" name="card_payment_charge" id="card_payment_charge" value='<?= number_format($card_payment_charge, 2, '.', '') ?>'>
											<!--<img src="<?/*=BASE_URL*/?>/assets/customer/img/loader.gif" alt="">-->
	                                        <button type="submit" id="checkOutBtn" class="btn btn-primary btn-block custom-checkout disable-checkout" >Proceed</button>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </form>
            </div>

            <!-- For mobile first bottom fix nav-->
		    <nav class="navbar navbar-default navbar-fixed-bottom mobile-cart-nav" id="mobileNavBar">
		        <div class="mobile-cart-inner-content">
		            <div class="row">
		                <div class="col-md-4 col-xs-4">
		                    <div class="mobile-cart-item">
		                        <a id="mobileCartToggle" href="javascript:;" data-toggle="modal" data-target="#lab-slide-bottom-popup">
		                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
		                            <span id="item_count"><?php if (isset($cart)) echo $cart->quantity; ?></span>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-md-4 col-xs-4">
		                    <div class="mobile-total-amount">Total: <span id="total_cart_amount" class="order-total-amount"><?php if (isset($cart)) echo number_format($cart->total_price, 2, '.', ''); ?></span></div>
		                </div>
		                <div class="col-md-4 col-xs-4">
		                    <button class="btn mobile-btn-checkout checkOutBtn" id="mobileCheckOutBtn">Proceed</button>
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

		                <div class="ui-order-policy-2 delivery-time">
				            <?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
				                <span class="est-deli">Estimated delivery time</span>
				                <span class="deli-time" id="col_del_time"><?php if(isset($settings)) echo $settings->estimated_delivery_time;?> <p><small>minutes</small></p></span>
				            <?php } elseif (isset($orderProcessType) && $orderProcessType->order_process_type_id == 2) {?>
				                <span class="est-deli">Estimated collection time</span>
				                <span class="deli-time" id="col_del_time"><?php if(isset($settings)) echo $settings->estimated_collection_time;?> <p><small>minutes</small></p></span>
				            <?php }?>
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

									<!--input type="hidden" name="card_payment_charge" id="card_payment_charge" value="<?php echo $card_payment_charge?>"-->
		                            <div class="cart-table">
		                                <table class="table table-striped checkout-table">
		                                    <tbody class="cart_product_list">
												<?php if (isset($cart) && isset($cart->products)) foreach($cart->products as $product) { ?>
													<tr class="">
														<td class="cross-td custom-spinner">
															<div class="input-group spinner">
																<button class="btn btn-default cust-plus cust-plus-increment" type="button"><i class="fa fa-plus"></i>
																</button>
																<input class="form-control increse-val" value="<?= $product->quantity ?>" readonly="" type="text">
																<button class="btn btn-default cust-plus cust-plus-decrement" type="button"><i class="fa fa-minus"></i>
																</button>
															</div><span class="qnt-idn"><?= $product->quantity ?> x</span>
														</td>
														<td class="itme-td"><?= $product->name ?></td>
														<td class="amont-td"><i class="fa fa-times-circle-o" ></i> <span class="main-price"><?= number_format($product->price, 2, '.', '') ?></span>
														</td>
													</tr>
												<?php }?>
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
									<div class="ui-order-description">
										<div class="row color-gray">
											<div class="col-md-8 col-xs-8">
												<p>Subtotal: </p>
											</div>
											<div class="col-md-4 col-xs-4 text-right checkout-amout">£<?php if (isset($cart)) echo number_format($cart->sub_total_price, 2, '.', ''); ?></div>
										</div>
										<?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
										<div class="row color-gray">
											<div class="col-md-8 col-xs-8">
												<p>Delivery Charge: </p>
											</div>
											<div class="col-md-4 col-xs-4 text-right checkout-amout">£<?php if (isset($cart)) echo number_format($cart->delivery_charge, 2, '.', ''); ?></div>
										</div>
										<?php }?>

										<div class="row">
											<div class="col-md-4 col-xs-4">
												<p>Total: </p>
											</div>
											<div class="col-md-8 col-xs-8 text-right"><span id="order-total-amount" class="order-total-amount">£<?php if (isset($cart)) echo number_format($cart->total_price, 2, '.', ''); ?></span>
											</div>
										</div>
									</div>
		                            <!--<div class="ui-order-description order-description">
		                                <div class="row color-gray">
		                                    <div class="col-md-8 col-xs-8">
		                                        <p>Subtotal: </p>
		                                    </div>
		                                    <div class="col-md-4 col-xs-4 text-right order-subtotal-amount"></div>
		                                </div>
		                                <div class="row color-gray">
		                                    <div class="col-md-8 col-xs-8">
		                                        <p>Delivery Charge: </p>
		                                    </div>
		                                    <div class="col-md-4 col-xs-4 text-right">0.00</div>
		                                </div>
	
		                                <div class="row">
		                                    <div class="col-md-4 col-xs-4">
		                                        <p>Total: </p>
		                                    </div>
		                                    <div class="col-md-8 col-xs-8 text-right "><span id="order-total-amount" class="order-total-amount">£ 100</span>
		                                    </div>
		                                </div>
		                            </div>-->

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
        </div>
    </section>
    <!-- End Section Order Online -->


<?php require_once "view/base/customer/pre_footer.php"?>

    <script>
        $(function () {
			//For find address
			$("#findAddress").click(function() {
				var postcode = $('#proceed_payment input[name="postcode"]').val();
				if (postcode.trim('') == '') {
					$('.alert-success').hide();
					$('.alert-danger').show();
					$('.alert-danger').html('Please input a postcode. Right format of the post code is E14 9TX');
					setTimeout(function () {
						$('.alert-danger').hide();
					}, 3000);
					return;
				}
				//console.log(postcode);
				//if ($(this).)
				$("#findAddress").prop('disabled', true);
				$.ajax({
					url: "<?php echo BASE_URL?>/get-address-by-postcode",
					type: "post",
					data: {postcode: postcode},
					dataType: 'json',
					success: function (data) {
						//console.log(data);
						if (data.status == 200) {
							setAddressList(data.addressees);
							$("#showAddress").removeClass("hidden");

						} else {
							$("#findAddress").prop('disabled', false);
							$("#showAddress").addClass("hidden");
							$('.alert-success').hide();
							$('.alert-danger').show();
							$('.alert-danger').html(data.message);
							setTimeout(function () {
								$('.alert-danger').hide();
							}, 3000);
						}
						//$('.list_container').html(data);
					}
				});
				//$("#showAddress").removeClass("hidden");
			});

			$(document).on("click",".selectedTab>a", function() {
				$(".selectedTab").removeClass("tabSelected");
				$(this).parent(".selectedTab").addClass("tabSelected");

				var address1 = $(this).children().find('.address_address1').text();
				var address2= $(this).children().find('.address_address2').text();
				var town = $(this).children().find('.address_town').text();
				var postcode = $(this).children().find('.address_postcode').text();
				$('#proceed_payment input[name="address1"]').val(address1);
				$('#proceed_payment input[name="address2"]').val(address2);
				$('#proceed_payment input[name="town"]').val(town);
				$('#proceed_payment input[name="postcode"]').val(postcode);
				$("#showAddress").addClass("hidden");
				$("#findAddress").prop('disabled', false);
				//console.log();
			});

			function setAddressList(addressees) {
				var html = '';
				//console.log(addressees);
				/*$.each(addressees, function (key, address) {
					html += '<div class="col-sm-3 col-xs-12">';
					html += '<div class="selectedTab">';
					html += '<a href="javascript:;">';
					html += '<address>';
					if (address.BuildName.length) {
						html += '<p class="address_address1">'+address.BuildName+'</p>';
					}
					if (address.Street.length) {
						html += '<p class="address_address2">'+address.Street+'</p>';
					}
					if (address.Town.length) {
						html += '<p class="address_town">'+address.Town+'</p>';
					}
					html += '<p class="address_postcode">'+address.Postcode+'</p>';
					html += '</address>';
					html += '</a>';
					html += '</div>';
					html += '</div>';
				});*/
				$.each(addressees, function (key, address) {
					html += '<tr>';
					html += '<td>';
					html += '<div class="selectedTab">';
					html += '<a href="javascript:;">';
					html += '<address>';
					if (address.BuildName.length) {
						html += '<span class="address_address1">'+address.BuildName+'</span>, ';
					}
					if (address.Street.length) {
						html += '<span class="address_address2">'+address.Street+'</span>, ';
					}
					if (address.Town.length) {
						html += '<span class="address_town">'+address.Town+'</span>, ';
					}

					html += '<span class="address_postcode">'+address.Postcode+'</span>';
					html += '</address>';
					html += '</a>';
					html += '</div>';
					html += '</td>';
					html += '</tr>';
				});
				//console.log(html);
				$('.address_list').html(html);
			}

			$('#mobileCheckOutBtn').click(function () {
				$('#proceed_payment').submit();
			});

            $('#proceed_payment').submit(function (ev) {
                ev.preventDefault();
                //console.log('clicked');return;
                var payment_type = $('#proceed_payment input[name="payment_type"]:checked').val();
                var order_delivery_time = $('#proceed_payment select[name="order_delivery_time"]').val();
                //console.log(order_delivery_time);return;
                var validate = '';

                <?php if (isset($orderProcessType) && $orderProcessType->order_process_type_id == 1) {?>
                var address_1 = $('#proceed_payment input[name="address1"]').val();
                var town = $('#proceed_payment input[name="town"]').val();
                var postcode = $('#proceed_payment input[name="postcode"]').val();
                var codeString = "<?php if (isset($code)) echo $code?>";
                codeString = codeString.split(',');
				//console.log(codeString);
				//return;

                if (address_1 == '') {
                    validate += 'Address 1 is required';
                }
                if (town == '') {
                    validate += '<br>Town is required';
                }
                if (postcode == '') {
                    validate += '<br>Postcode is required';
                }
				var modifiedPostCode = postcode;
                var found = false;
                $.each(codeString, function (key, value) {
					var value = value.trim(' ');
					var n = modifiedPostCode.indexOf(value);
					var res = value.substring(0,2); // get first two character of post code from db
					var res_position = modifiedPostCode.indexOf(res);
					if(n>-1 && res_position==0){
						found = true;
					}
                });
                if (!found && modifiedPostCode != '') {
                    validate += '<br>Postcode does not match';
                }
                <?php }?>

                if (typeof payment_type == 'undefined') {
                   validate += '<br>You must select a Payment Option';
                }
                if (order_delivery_time == '') {
                    validate += '<br>You must select a delivery time';
                }

                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
					$('html, body').animate({scrollTop: $("#order").offset().top-100}, 300);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                } else {
                	$(".site-loader").show();
                    $(this)[0].submit();
                }
            });
        })

		$(function() {
			$("input[name = 'payment_type']").click(function(){
				var radio_value = $(this).val();
				var total_price = parseFloat($('#total_price').val());
				var discount_price = parseFloat($('#discount_price').val());
				var cph = parseFloat($('#card_payment_charge').val());
				if(radio_value==1){
					$('#cp_charge_area').show();
					var grand_total = total_price+cph-discount_price;
				}
				else{
					$('#cp_charge_area').hide();
					var grand_total = total_price-discount_price;
				}
				$('.order-total-amount').text('£'+grand_total.toFixed(2));
			});
		})
    </script>

<?php require_once "view/base/customer/footer.php"?>