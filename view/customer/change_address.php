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

                        <div class="col-sm-9 col-xs-12 checkout-content details">
                            
                            <h3 class="no-margin-top">
                                <span>My Details</span>
                            </h3>
                            <hr>
                            
                            <form id="update_profile_form" method="post" action="">

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
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>First Name</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <input class="form-control" name="first_name" id="first_name" placeholder="First Name" type="text" value="<?php echo $customer->first_name?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="last_name" id="last_name" placeholder="Last Name" type="text" value="<?php echo $customer->last_name?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Email Address</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input  type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php echo $customer->email?>" disabled >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="<?php echo $customer->phone?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="<?php echo $customer->mobile?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Flat House No</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" name="flat_house_no" id="flat_house_no" tabindex="1" class="form-control" placeholder="Flat House No" value="<?php echo $customer->flat_house_no?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Street</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" name="street" id="street" class="form-control" placeholder="Street" value="<?php echo $customer->street?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>City Town</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" name="city_town" id="city_town" class="form-control" placeholder="City Town"  value="<?php echo $customer->city_town?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label>Postcode</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" name="postcode" id="postcode" class="form-control" placeholder="Postcode" value="<?php echo $customer->postcode?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                
                                            </div>
                                            <div class="col-sm-9">
                                                <button class="btn btn-block common-btn" id="save_information">Save Information</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                                                
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
        $('#save_information').click(function (ev) {
            //$('body').scrollTop(0);
            ev.preventDefault();
            if ($(this).hasClass('disabled')) {
                return;
            }
            $(this).addClass('disabled');
            var btn = $(this);

            var validate = '';

            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var phone = $('#phone').val();

            /*if (email.trim('') == '') {
                validate += 'email is required</br>';
            }
            if (email.trim('') != '') {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailReg.test(email)){
                    validate += 'email is not valid</br>';
                }
            }*/
            if (first_name.trim('') == '') {
                validate += 'first name is required';
            }
            if (last_name.trim('') == '') {
                validate += '</br>last name is required';
            }
            if (phone.trim('') == '') {
                validate += '</br>phone name is required';
            }

            if (validate != '') {
                btn.removeClass('disabled');
                $('.alert-success').hide();
                $('.alert-danger').show();
                $('.alert-danger').html(validate);
                $('html, body').animate({scrollTop: $(".details").offset().top-100}, 300);
                setTimeout(function () {
                    $('.alert-danger').hide();
                }, 3000);
                return;
            }

            var form = $(this).parents('form:first');
            var formData = new FormData( form[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/update-address",
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
                        $('html, body').animate({scrollTop: $(".details").offset().top-100}, 300);

                        $('#email_form')[0].reset();

                        setTimeout(function () {
                            $('.alert-success').hide();
                            //window.location.href="<?php echo BASE_URL?>/admin/delivery-collection";
                        }, 2000);
                    } else {
                        $('.alert-success').hide();
                        $('.alert-danger').show();
                        $('.alert-danger').html(data.message);
                        $('html, body').animate({scrollTop: $(".details").offset().top-100}, 300);
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
