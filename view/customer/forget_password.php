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

                        <div class="col-sm-6 col-sm-offset-3 col-xs-12 checkout-content">
                            <div class="">
                                <h3 class="no-margin-top">Forget Password</h3>
                                <hr>

                                <!--warning-->
                                <div class="alert alert-success alert-dismissible" role="alert" <?php if (!isset($_SESSION['success'])) {?>style="display: none;" <?php } ?> >
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php if (isset($_SESSION['success'])) echo $_SESSION['success']; unset($_SESSION['success'])?>
                                </div>
                                <div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
                                </div>
                                <!--warning end-->

                                <form id="form_forget_password" action="<?= BASE_URL?>/post-forget-password" method="post">
                                    <div class="row no-margin">
                                        <div class="col-sm-12 col-xs-12 no-padding">
                                            <div class="form-group">
                                                <label>Enter your email address and we will send a link to change your password.</label>
                                                <input type="email" class="form-control" name="email" id="">
                                            </div>

                                            <div class="form-group captcha">
                                                <!-- <label>Captcha</label>
                                                <input class="form-control" id="defaultReal" name="defaultReal" placeholder="Enter above text"> -->
                                                <!-- <input class="form-control" id="" name="" placeholder="Enter above text"> -->

                                                <!--goole re-captcha-->
                                                <!-- <div class="g-recaptcha" data-sitekey="6Le8GhMUAAAAAA5ORnV3jipCTlRLC1ssB7-EhMZZ"></div> -->
                                            </div>

                                            <button type="submit" class="btn btn-block common-btn">Submit</button>
                                        </div>
                                    </div>
                                </form>

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
    <script>
        $(function () {
            $('#form_forget_password').on('submit', function (ev) {
                ev.preventDefault();
                var email = $('#form_forget_password input[name="email"]').val();
                //var response = grecaptcha.getResponse();
                var validate = '';
                /*if(response.length == 0) {
                    validate = 'Check the security checkbox';
                }*/
                if (email.trim('') == '') {
                    validate += 'Email is required';
                }

                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                if(email != "" && re.test(email) != true) {
                    validate = validate+"<br>Please type a valid email address";
                }

                if (validate != '') {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                    $('.alert-danger').html(validate);
                    setTimeout(function () {
                        $('.alert-danger').hide();
                    }, 3000);
                } else {
                    $(this)[0].submit();
                }
            });

            /*if(response.length == 0){
                //reCaptcha not verified
                alert('Check the security checkbox');
            }*/
        });
        setTimeout(function () {
            $('.alert-danger').hide();
            $('.alert-success').hide();
        }, 3000);
    </script>
<?php require_once "view/base/customer/footer.php"?>