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
                                            <!--li><a href="#"><i class="fa fa-history" aria-hidden="true"></i> Order History</a></li-->
							                <li><a href="<?= BASE_URL?>/logout"><i class="fa fa-sign-out"></i> Sign out</a></li>
							            </ul>
							        </div>
							        <!-- END OF Myaccount menu  -->
							    </div>
                    		</div>
                        </div>

                        <div class="col-sm-9 col-xs-12 checkout-content">
                            <div class="">
                                <h3 class="no-margin-top">Change Password</h3>
                                <hr>
                                <form id="change_password_form" method="post" action="">

                                    <!--warning-->
                                    <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <!--warning end-->

                                <div clas="row">
                                    <div class="col-sm-12 col-xs-12 no-padding">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control" name="current_password" id="current_password" placeholder="Current password" type="password">
                                        </div>

                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" name="new_password" id="new_password" placeholder="New password" type="password">
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password" type="password">
                                        </div>

                                        <button class="btn btn-block common-btn" id="change_password_button">Change Password</button>
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

<?php require_once "view/base/customer/footer.php"?>

<script>

    $(function () {
        $('#change_password_button').click(function (ev) {
            $('body').scrollTop(0);
            ev.preventDefault();
            if ($(this).hasClass('disabled')) {
                return;
            }
            $(this).addClass('disabled');
            var btn = $(this);

            var validate = '';

            var current_password = $('#current_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            if (current_password.trim('') == '') {
                validate += 'current password is required';
            }
            if (new_password.trim('') == '') {
                validate += '</br>new password is required';
            }
            if (confirm_password.trim('') == '') {
                validate += '</br>confirm password is required';
            }
            if (new_password.trim('') !=confirm_password.trim('')) {
                validate += '</br>confirm password does not match with new password';
            }

            if (validate != '') {
                btn.removeClass('disabled');
                $('.alert-success').hide();
                $('.alert-danger').show();
                $('.alert-danger').html(validate);
                setTimeout(function () {
                    $('.alert-danger').hide();
                }, 3000);
                return;
            }

            var form = $(this).parents('form:first');
            var formData = new FormData( form[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/update-password",
                type: "post",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    btn.removeClass('disabled');
                    console.log(data);
                    if (data.status == 200) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').html(data.message);

                        $('#change_password_form')[0].reset();

                        setTimeout(function () {
                            $('.alert-success').hide();
                            //window.location.href="<?php echo BASE_URL?>/admin/delivery-collection";
                        }, 2000);
                    } else {
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
        });
    });

</script>
