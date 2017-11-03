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
                                <h3 class="no-margin-top">Reset Password</h3>
                                <hr>

                                <!--warning-->
                                <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                </div>
                                <div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
                                </div>
                                <!--warning end-->

                                <form id="form_reset_pass" action="<?=BASE_URL?>/post-reset-password" method="post">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 no-padding">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input class="form-control" name="password" id="password" placeholder="New password" type="password">
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input class="form-control" name="re_password" id="re_password" placeholder="Confirm password" type="password">
                                            </div>

                                            <button type="submit" class="btn btn-block common-btn">Change Password</button>
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
            $('#form_reset_pass').on('submit', function (ev) {
                ev.preventDefault();
                var password = $('#form_reset_pass input[name="password"]').val();
                var confirm_password = $('#form_reset_pass input[id="re_password"]').val();
                //console.log(terms);return;
                var validate = '';


                if (password.trim('') == '') {
                    validate += 'Password is required';
                }
                if (confirm_password.trim('') != password.trim('')) {
                    validate += '<br>Password does not match the confirm password';
                }
                //console.log(validate);return;

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
        })
    </script>
<?php require_once "view/base/customer/footer.php"?>