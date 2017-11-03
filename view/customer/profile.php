<?php require_once "view/base/customer/header.php"?>

    <!-- page topper without breadcrumb-->
    <section class="page-topper">
    </section>
	<!-- page topper without breadcrumb end-->    

    <!-- Section customer profile -->
    <section id="order">
        <div class="container">

            <div class="row">

                <!-- Customer content -->
                <div class="col-md-12 ui-order-online-left-side">
                    <div class="row">
                    	<div class="col-sm-3 col-xs-12">
                    		<div class="checkout-content">
                    			<div class="account-cfoinfo clearfix">
							        <div class="cfoaccount">
							            <ul class="list-unstyled profile-nav">
							                <li><a href="<?= BASE_URL?>/profile"><i class="fa fa-home" aria-hidden="true"></i> My Account</a></li>
											<li><a href="<?= BASE_URL?>/order-history"><i class="fa fa-history" aria-hidden="true"></i> Order History</a></li>
											<li><a href="<?= BASE_URL?>/logout"><i class="fa fa-sign-out"></i> Sign out</a></li>
							            </ul>
							        </div>
							        <!-- END OF Myaccount menu  -->
							    </div>
                    		</div>
                        </div>

                        <div class="col-sm-9 col-xs-12 checkout-content">
                    		<div class="">
                    			<h3 class="no-margin-top">Account access</h3>
                    			<hr>

                    			<div clas="row">
                    				<div class="col-sm-3 col-xs-12 no-padding">
                    					<h4>Sign in Info</h4>
                    				</div>

                    				<div class="col-sm-9 col-xs-12">
                    					<h4><?php echo $customer->email?></h4>
                    					<a href="<?= BASE_URL?>/change-password" class="text-golden text-underline">Modify my password</a>
                    				</div>
                    			</div>
                    		</div>
                        </div>
					</div>

					<div class="row">
						<div class="col-sm-3"></div>
                        <div class="col-sm-9 col-xs-12 checkout-content">

                			<h3 class="no-margin-top">
                				<span>My Details</span>
                				<span class="pull-right"><a href="<?= BASE_URL?>/change-address" class="text-golden text-underline">Modify address</a></span>
                			</h3>
                			<hr>

        					<div class="form-group">
                                <p><?php echo $customer->first_name." ".$customer->last_name?></p>
                                <p><?php echo $customer->phone?></p>
                                <p><?php echo $customer->email?></p>
                                <p><?php echo $customer->flat_house_no;
										if($customer->street!=''){echo ", ".$customer->street;}
										if($customer->city_town!=''){echo ", ".$customer->city_town;}?>
								</p>
                                <p><?php echo $customer->postcode?></p>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Customer content end -->

            </div>
        </div>
    </section>
    <!-- End Section Order Online -->


<?php require_once "view/base/customer/pre_footer.php"?>

<?php require_once "view/base/customer/footer.php"?>