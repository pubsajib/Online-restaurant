<?php require_once "view/base/customer/header.php"?>
    <style>
        #newsletter, #site-footer {
            z-index: 99;
            position: initial;
        }
    </style>
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/login.css" />

    <!--Login Section Main -->
    <section id="breadcrumb" style="min-height: 700px;"  data-background="assets/customer/img/main3.jpg" class="parallax-window">
        <div class="container" style="top: 35%;">
            <div class="row">
                <div class="col-md-5 center-div">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="javascript:;" class="<?php if (!isset($_SESSION['activeTab'])) echo 'active'; else { if ($_SESSION['activeTab']=='login') {echo 'active';} }?> btn btn-block btn-golden" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="javascript:;" class="<?php if ($_SESSION['activeTab']=='register') echo 'active'; ?> btn btn-block btn-golden" id="register-form-link">Register</a>
                                </div>
                            </div>
                        </div>
                        

                        <div class="panel-body login-panel-body" style="max-height:400px; overflow-y: auto;">
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
                                <div class="col-lg-12">
                                    <?php if (isset($cartObjectAsString)) {?>
                                    <form id="login-form" action="<?php if (isset($action)) echo BASE_URL.'/'.$action; ?>" method="post" role="form"  <?php if (!isset($_SESSION['activeTab'])) echo "style=\"display: block;\""; else { if ($_SESSION['activeTab']=='login') {echo "style=\"display: block;\""; unset($_SESSION['activeTab']);} else {echo "style=\"display: none;\"";}  }?>>
                                        <input type="hidden" name="login" value="1">
                                        <input type="hidden" name="cart" value='<?= $cartObjectAsString?>'>
                                        <input type="hidden" name="order_process_type_id" value='<?php if (isset($order_process_type_id)) echo $order_process_type_id;?>'>
                                    <?php }
                                    else {?>
                                    <form id="login-form" action="<?= BASE_URL?>/customer-login" method="post" role="form" <?php if (!isset($_SESSION['activeTab'])) echo "style=\"display: block;\""; else { if ($_SESSION['activeTab']=='login') {echo "style=\"display: block;\""; unset($_SESSION['activeTab']);} else {echo "style=\"display: none;\"";} }?>>
                                        <?php }?>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>

                                        <div class="row">
                                            <!--div class="col-sm-6 col-xs-12">
                                                <div class="form-group remember-option">
                                                    <div class="checkbox checkbox-primary" style="padding-left:25px;">
                                                        <input id="checkbox2" class="styled" type="checkbox">
                                                        <label for="checkbox2">
                                                            Remember Password
                                                        </label>
                                                    </div>
                                                </div>
                                            </div-->

                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login btn-block" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group no-margin">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="<?=BASE_URL?>/forget-password" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if (isset($cartObjectAsString)) {?>
                                    <form id="register-form" action="<?php if (isset($action)) echo BASE_URL.'/'.$action; ?>" method="post" role="form"  <?php if (isset($_SESSION['activeTab']) && $_SESSION['activeTab']=='register') {echo "style=\"display: block;\""; unset($_SESSION['activeTab']);} else echo "style=\"display: none;\"";?> >
                                        <input type="hidden" name="register" value="1">
                                        <input type="hidden" name="cart" value='<?= $cartObjectAsString?>'>
                                        <input type="hidden" name="order_process_type_id" value='<?php if (isset($order_process_type_id)) echo $order_process_type_id;?>'>
                                    <?php }
                                    else {?>
                                    <form id="register-form" action="<?= BASE_URL ?>/create-customer" method="post" role="form" <?php if (isset($_SESSION['activeTab']) && $_SESSION['activeTab']=='register') {echo "style=\"display: block;\""; unset($_SESSION['activeTab']);} else echo "style=\"display: none;\"";?> >
                                        <?php }?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input  type="text" name="first_name" tabindex="1" class="form-control" placeholder="First Name" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="">
                                                </div>
                                            </div>
                                        
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input  type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="mobile" tabindex="1" class="form-control" placeholder="Mobile" value="">
                                                </div>
                                            </div>

                                        </div>

                                        <!-- <div class="form-group">
                                            <input type="text" name="phone" tabindex="1" class="form-control" placeholder="Phone" value="">
                                        </div> -->
                                        <!--<div class="form-group">
                                            <input type="text" name="mobile" tabindex="1" class="form-control" placeholder="Mobile" value="">
                                        </div>
                                        <div class="form-group">
                                            <input required type="text" name="flat_house_no" tabindex="1" class="form-control" placeholder="Flat House No" value="">
                                        </div>
                                        <div class="form-group">
                                            <input required type="text" name="street" tabindex="1" class="form-control" placeholder="Street" value="">
                                        </div>
                                        <div class="form-group">
                                            <input required type="text" name="city_town" tabindex="1" class="form-control" placeholder="City Town" value="">
                                        </div>
                                        <div class="form-group">
                                            <input required type="text" name="postcode" tabindex="1" class="form-control" placeholder="Postcode" value="">
                                        </div>-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input  type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input  type="password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms"><input class="terms" id="terms" name="terms" type="checkbox" value="1"> I have read and accept the <a href="#" target="_blank">terms and condition</a>.</label>
                                        </div>

                                        <div class="form-group no-margin">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register btn-block" value="Register Now">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login Section Main -->


<?php require_once "view/base/customer/pre_footer.php"?>
    <script>
        setTimeout(function () {
            $('.alert-danger').hide();
        }, 3000);

        $(function () {
            $('#register-form').on('submit', function (ev) {
                ev.preventDefault();
                var fName = $('#register-form input[name="first_name"]').val();
                var email = $('#register-form input[name="email"]').val();
                var flat_house_no = $('#register-form input[name="flat_house_no"]').val();
                var street = $('#register-form input[name="street"]').val();
                var city_town = $('#register-form input[name="city_town"]').val();
                var postcode = $('#register-form input[name="postcode"]').val();
                var password = $('#register-form input[name="password"]').val();
                var confirm_password = $('#register-form input[id="confirm-password"]').val();
                var terms = $('#register-form input[name="terms"]:checked').val();
                //console.log(terms);return;
                var validate = '';

                if (fName.trim('') == '') {
                    validate += 'First Name is required';
                }

                if (email.trim('') == '') {
                    validate += '<br>Email is required';
                }

                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                if(email != "" && re.test(email) != true){
                    validate = validate+"<br>Please type a valid email address";
                }

                /*if (flat_house_no.trim('') == '') {
                    validate += '<br>Flat House No is required';
                }

                if (street.trim('') == '') {
                    validate += '<br>Street is required';
                }
                if (city_town.trim('') == '') {
                    validate += '<br>City Town is required';
                }
                if (postcode.trim('') == '') {
                    validate += '<br>Postcode is required';
                }*/
                //console.log(validate);return;
                if (password.trim('') == '') {
                    validate += '<br>Password is required';
                }
                if (confirm_password.trim('') != password.trim('')) {
                    validate += '<br>Password does not match the confirm password';
                }
                if (typeof terms == 'undefined') {
                    validate += '<br>You must accept terms & condition';
                }

                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
                    $('html, body').animate({scrollTop: $(".panel-heading").offset().top-100}, 300);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                } else {
                    $(this)[0].submit();
                }
            });

            $('#login-form').on('submit', function (ev) {
                ev.preventDefault();
                var email = $('#login-form input[name="email"]').val();
                var password = $('#login-form input[name="password"]').val();
                var validate = '';

                if (email.trim('') == '') {
                    validate += 'Email is required';
                }
                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                if(email != "" && re.test(email) != true){
                    validate = validate+"<br>Please type a valid email address";
                }
                if (password.trim('') == '') {
                    validate += '<br>Password is required';
                }

                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
                    $('html, body').animate({scrollTop: $(".panel-heading").offset().top-100}, 300);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                } else {
                    $(this)[0].submit();
                }
            })
        });

    </script>
<?php require_once "view/base/customer/footer.php"?>