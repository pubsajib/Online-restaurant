<?php require_once "view/base/admin/header.php"?>
<!-- Page Content -->
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="common-parent">
                    <form id="create_discount_details_form" method="post" action="" class="">

                        <!--warning-->
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <!--warning end-->
                            <div class="col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Discount Setting
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="">Discount Type</label>
                                            <select class="form-control" name="discount_type" id="discount_type">
                                                <option value="1" <?php if($discounts->discount_type==1){ echo "selected";}?>>Both</option>
                                                <option value="2" <?php if($discounts->discount_type==2){ echo "selected";}?>>Delivery</option>
                                                <option value="3" <?php if($discounts->discount_type==3){ echo "selected";}?>>Collection</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Minimum Amount</label>
                                            <input type="text" class="form-control" name="minimum_amount" id="minimum_amount" value="<?php echo $discounts->min_amount?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Maximum Amount</label>
                                            <input type="text" class="form-control" name="maximum_amount" id="maximum_amount" value="<?php echo $discounts->max_amount?>">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6 col-xs-12">
                                                <label for="">Discount Rate</label>
                                                <input type="text" class="form-control" name="discount_rate" id="discount_rate" value="<?php echo $discounts->discount_rate?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success pull-right margin-bottom-20" type="button" id="btn_create_discounts">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "view/base/admin/footer.php"?>

<script>
    $(function () {
        $('#btn_create_discounts').click(function (ev) {
            ev.preventDefault();
            if ($(this).hasClass('disabled')) {
                return;
            }
            $(this).addClass('disabled');
            var btn = $(this);

            var validate = '';
            var discount_type = $('#discount_type').val();
            var minimum_amount = $('#minimum_amount').val();
            var maximum_amount = $('#maximum_amount').val();
            var discount_rate = $('#discount_rate').val();
            if (discount_type.trim('') == '') {
                validate += 'Discount type is required';
            }
            if (minimum_amount.trim('') == '') {
                validate += '</br>Minimum amount is required';
            }
            if (maximum_amount.trim('') == '') {
                validate += '</br>Maximum amount is required';
            }
            if (minimum_amount.trim('') !='' && maximum_amount.trim('') !='' && maximum_amount.trim('') !=0 && parseFloat(maximum_amount) < parseFloat(minimum_amount)) {
                validate += '</br>Maximum amount can not be less than minimum amount. Instead you can set maximum amount 0';
            }
            if (discount_rate.trim('') == '') {
                validate += '</br>Discount rate is required';
            }


            if (validate != '') {
                $('body').scrollTop(0);
                btn.removeClass('disabled');
                $('.alert-success').hide();
                $('.alert-danger').show();
                $('.alert-danger').html(validate);
                setTimeout(function () {
                    $('.alert-danger').hide();
                }, 3000);
                return;
            }

            var formData = new FormData($('#create_discount_details_form')[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/admin/create-discount-details",
                type: "post",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('body').scrollTop(0);
                    btn.removeClass('disabled');
                    console.log(data);
                    if (data.status == 200) {

                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').html(data.message);


                        setTimeout(function () {
                            $('.alert-success').hide();
                            //window.location.href = "<?php echo BASE_URL?>/admin/delivery-charge";
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