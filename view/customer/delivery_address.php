<?php require_once "view/base/customer/header.php"?>

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
                <!--div class="col-sm-12">
                    <div class="common-header-bar">
                        <a href="<?= BASE_URL ?>/order" class="btn btn-danger">BACK</a>
                    </div>
                </div-->

                <!-- start category content all -->
                <form id="proceed_checkout" action="<?= BASE_URL ?>/checkout" method="post">
                    <input type="hidden" name="cart" value='<?= $cartObjectAsString?>'>
                    <input type="hidden" name="order_process_type_id" value='<?php if (isset($order_process_type_id)) echo $order_process_type_id;?>'>

                    <div class="col-md-12 ui-order-online-left-side">
                        <div class="checkout-content dAddress-content">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5 col-xs-12">
                                    <h3 class="">Your Delivery Address</h3>
                                    <hr class="margin-top-0">

                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Address 1: <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="address1" id="" placeholder="Address 1" type="text">
                                                </div>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Address 2:</label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="address2" id="" placeholder="Addrress 2" type="text">
                                                </div>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Town/City: <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="town" id="town" placeholder="Town/City" type="text">
                                                </div>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">Postcode: <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input class="text form-control" name="postcode" id="" placeholder="Postcode" max="10" type="text">
                                                </div>
                                            </div>

                                        </li>
                                        <li>
                                            <button type="submit" class="btn  btn-danger">Continue</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-5 col-xs-12">
                                    <h3 class="">Delivery Areas</h3>
                                    <hr class="margin-top-0">

                                    <textarea name="order_instruction" class="form-control" readonly="" rows="8"><?php
                                        $code = '';
                                        if (!empty($postcodes)) foreach ($postcodes as $postcode) {
                                            $code .= $postcode->postcode_no.',';
                                            //echo $postcode->postcode_no.',';
                                        }
                                        rtrim($code, ',');
                                        echo $code;
                                        ?>
                                    </textarea>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </div>

                    </div>
                <!-- end category content all -->
                </form>
            </div>
        </div>
    </section>
    <!-- End Section Order Online -->


<?php require_once "view/base/customer/pre_footer.php"?>

    <script>
        $(function () {
            $('#proceed_checkout').submit(function (ev) {
                ev.preventDefault();
                var address_1 = $('#proceed_checkout input[name="address1"]').val();
                var town = $('#proceed_checkout input[name="town"]').val();
                var postcode = $('#proceed_checkout input[name="postcode"]').val();
                var codeString = "<?php echo $code?>";
                var validate = '';
                codeString = codeString.split(',');

                if (address_1 == '') {
                    validate += 'Address 1 is required';
                }
                if (town == '') {
                    validate += '<br>Town is required';
                }
                if (postcode == '') {
                    validate += '<br>Postcode is required';
                }

                var found = false;
                $.each(codeString, function (key, value) {
                    if (value == postcode) {
                        found = true;
                    }
                });
                if (!found) {
                    validate += '<br>Postcode does not match';
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