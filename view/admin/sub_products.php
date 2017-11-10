<?php require_once "view/base/admin/header.php"; ?>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- fixed alert pop -->
    <div class="productAddAlert success div-alert-success hide">
        <p>
            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span>
            <span class="alert-success-pop">Successfully added to cart</span>
        </p>
    </div>

    <div class="productAddAlert danger div-alert-danger hide">
        <p>
            <span><i class="fa fa-bell-o" aria-hidden="true"></i></span>
            <span class="alert-danger-pop">Successfully added to cart</span>
        </p>
    </div>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common-parent">

                        <!--warning-->
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        </div>
                        <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <!--warning end-->

                        <div id="dynamicAddFormContainer">
                            <div class="dynamicAddForm">
                                <div class="panel panel-default dynamicContentPanel">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-2"> <h4>Add Product</h4> </div>
                                            <div class="col-sm-6"> </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <form id="create_product" action="" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input name="name" type="text" class="form-control" id="" placeholder="Name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <select name="product_id" class="form-control w100">
                                                                    <option value="">Select A Product</option>
                                                                    <?php foreach ($products as $product) { ?>
                                                                        <option value="<?= $product->product_id?>"><?= $product->name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row addType">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-group select-type">
                                                                <!--label>Type</label-->
                                                                <select name="variations[]" class="selectpicker" multiple data-selected-text-format="count > 3" title="select types" style="width: 100%; margin: 0">
                                                                    <?php if ($variations){
                                                                        foreach ($variations as $variation) {
                                                                            echo '<option value="'. $variation->variation_id .'">'. $variation->variation_name .'</option>';
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="row">

                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="row">

                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <input name="price" type="text" class="form-control" id="" placeholder="Price">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-xs-12"> </div>

                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <input name="display_order" type="number" class="form-control" id="display_order" placeholder="Display Order">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-xs-12">
                                                            <h4 class="pull-left margin-right-15">Is extra</h4>
                                                            <input name="isExtra" value="1" id="toggle-event" class="pull-left" type="checkbox" data-toggle="toggle" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-xs-12">
                                                    <button class="btn btn-success pull-right  margin-top-10 btn_create_product">submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive margin-top-40">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Product</th>
                                    <th>Sub Product</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Display order</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="product_list">
                                <?php //echo "<pre>"; print_r($sub_products); echo "</pre>"; exit(); ?>
                                <?php $counter = 1;?>
                                <?php if(!empty($sub_products)) foreach ($sub_products as $product) { ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $product->product_name ?></td>
                                        <td><?= $product->name ?></td>
                                        <td><?= $product->variationNames; ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?= $product->product_display_order ?></td>

                                        <td class="text-center" width="20%">

                                        <span class="action-icon">
                                            <a class="btn btn-primary" id="editProduct" href="javascript:;" title="Edit" onclick="editProduct(<?= $product->sub_product_id?>)" >
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </span>

                                            <span class="action-icon">
                                            <a class="btn btn-danger" id="delProduct" href="javascript:;" title="Delete" onclick="deleteProduct(<?= $product->sub_product_id?>)">
                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        </td>
                                    </tr>
                                    <?php $counter++; ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div> <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!--    /*product edit modal*/-->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Sub Product</h4>
                </div>

                <!--warning-->
                <div class="alert modal-alert-success alert-success alert-dismissible common-center-alert" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="alert modal-alert-danger alert-danger alert-dismissible common-center-alert" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <!--warning end-->

                <div class="modal-body">
                    <form id="form_edit_product" action="">
                        <input type="hidden" name="sub_product_id" value="">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control" id="" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input name="price" type="text" class="form-control" id="" placeholder="Product Price">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <!-- <div class="form-group">
                                                <input name="quantity" type="text" class="form-control" id="" placeholder="Product Quantity">
                                            </div> -->
                                            <div class="form-group">
                                                <label>Product</label>
                                                <select name="product_id" class="form-control w100">
                                                    <option value="">Select A Product</option>
                                                    <?php foreach ($products as $product) {?>
                                                        <option value="<?= $product->product_id?>"><?= $product->name?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="variations[]" class="selectpicker" multiple data-selected-text-format="count > 3">
                                                    <?php if ($variations){
                                                        foreach ($variations as $variation) {
                                                            echo '<option value="'. $variation->variation_id .'">'. $variation->variation_name .'</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Display Order</label>
                                            <input name="display_order" type="number" class="form-control" id="" placeholder="Display Order">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn_edit_product">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--    /*Offer modal*/-->
    <!-- Modal -->
    <div class="modal fade offerModal" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Offer</h4>
                </div>

                <!--warning-->
                <div class="alert modal-alert-success alert-success alert-dismissible common-center-alert" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="alert modal-alert-danger alert-danger alert-dismissible common-center-alert" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <!--warning end-->

                <div class="modal-body">
                    <form id="form_offerModal" action="">
                        <input type="hidden" name="offer_id" value="">
                        <input type="hidden" name="sub_product_id" value="">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input name="offer_price" type="text" class="form-control" id="" placeholder="Offer Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <textarea name="offer_description" placeholder="Offer Description" class="form-control margin-bottom-20" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn_save_offer" onclick="saveOffer()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Dynamically add panel
        $(document).on("click",".addProductBtn",function(){
            var dynamic_content='<div class="row">';
            dynamic_content+='<div class="col-sm-6 col-xs-12">'
            dynamic_content+='<div class="form-group">';
            dynamic_content+='<div class="form-group">';
            dynamic_content+='<select class="form-control productType">';
            dynamic_content+='<option>Select Product Type</option>';
            dynamic_content+='<option>Product Type 02</option>';
            dynamic_content+='<option>Product Type 03</option>';
            dynamic_content+='<option>Product Type 04</option>';
            dynamic_content+='<select>';
            dynamic_content+='</div>';
            dynamic_content+='</div>';
            dynamic_content+='</div>';

            dynamic_content+='<div class="col-sm-6 col-xs-12">';
            dynamic_content+='<div class="form-group">';
            dynamic_content+='<div class="form-group">';
            dynamic_content+='<input name="price" type="text" class="form-control" id="" placeholder="Product Price">';
            dynamic_content+='</div>';
            dynamic_content+='</div>';
            dynamic_content+='</div>';
            dynamic_content+='</div>';


            $(".dynamicPanels").append(dynamic_content);
        });

        /*$(document).on("click",".deleteProductBtn",function(){

         var contentLength=$(".dynamicContentPanel").length;

         if(contentLength>1){
         $(this).parents(".dynamicContentPanel").remove();
         }
         });*/

        // Checking single item

        /*$(document).on("change",".singleItemCheck",function(){
         $(this).parents(".dynamicContentPanel").find(".productType").prop("disabled", $(this).is(':checked'));
         });*/

        // Dynamically add panel End

        $(function () {
            $('.btn_create_product').click(function (ev) {
                ev.preventDefault();
                var validate = '';
                var name = $('#create_product input[name="name"]').val();
                //var image = $('#create_product input[name="image_name"]').val();
                var product_id = $('#create_product select[name="product_id"]').val();
                var quantity = $('#create_product input[name="quantity"]').val();
                var price = $('#create_product input[name="price"]').val();
                var display_order = $('#create_product input[name="display_order"]').val();
                if (name == '') {
                    validate += 'Name is required';
                }
                if (product_id == '') {
                    validate += '<br>Product is required';
                }
                /*if (quantity == '') {
                 validate += '<br>Quantity is required';
                 }
                 if (!$.isNumeric(quantity) && quantity != '') {
                 validate = validate+'<br>Quantity should be a number';
                 } else if (quantity <= 0  && quantity != '') {
                 validate = validate+'<br>Quantity should be a positive number';
                 }*/
                if (price == '') {
                    validate += '<br>Price is required';
                }
                if (!$.isNumeric(price) && price != '') {
                    validate = validate+'<br>Price should be a number';
                } else if (price <= 0  && price != '') {
                    validate = validate+'<br>Price should be a positive number';
                }

                if (display_order == '') {
                    validate += '<br>Display order is required';
                }
                if (!$.isNumeric(display_order) && display_order != '') {
                    validate = validate+'<br>Display order should be a number';
                } else if (display_order <= 0  && display_order != '') {
                    validate = validate+'<br>Display order should be a positive number';
                }

                /*if (image == '') {
                 validate += '<br>Image is required';
                 }*/

                if (validate != '') {
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
                    url: "<?php echo BASE_URL?>/admin/create-sub_products",
                    type: "post",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == 200) {
                            /*var input = form+" :input";
                             input.val('');*/
                            $('#create_product :input').val('');
                            //$( form+" :textarea" ).val('');
                            //$( form+":textarea" ).val('');

                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            $('.alert-success').html(data.message);

                            //$("#product_list").html(data.desktopView);
                            setProductList(data.products);

                            setTimeout(function () {
                                $('.alert-success').hide();
                            }, 3000);
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

            $('.btn_edit_product').click(function (ev) {
                ev.preventDefault();
                var validate = '';
                var name = $('#form_edit_product input[name="name"]').val();
                //var image = $('#form_edit_product input[name="image_name"]').val();
                var product_id = $('#form_edit_product select[name="product_id"]').val();
                var quantity = $('#form_edit_product input[name="quantity"]').val();
                var price = $('#form_edit_product input[name="price"]').val();
                var display_order = $('#form_edit_product input[name="display_order"]').val();
                if (name == '') {
                    validate += 'Name is required';
                }
                if (product_id == '') {
                    validate += '<br>Product is required';
                }
                /*if (quantity == '') {
                 validate += '<br>Quantity is required';
                 }
                 if (!$.isNumeric(quantity) && quantity != '') {
                 validate = validate+'<br>Quantity should be a number';
                 } else if (quantity <= 0  && quantity != '') {
                 validate = validate+'<br>Quantity should be a positive number';
                 }*/

                if (price == '') {
                    validate += '<br>Price is required';
                }
                if (!$.isNumeric(price) && price != '') {
                    validate = validate+'<br>Price should be a number';
                } else if (price <= 0  && price != '') {
                    validate = validate+'<br>Price should be a positive number';
                }

                if (display_order == '') {
                    validate += '<br>Display order is required';
                }
                if (!$.isNumeric(display_order) && display_order != '') {
                    validate = validate+'<br>Display order should be a number';
                } else if (display_order <= 0  && display_order != '') {
                    validate = validate+'<br>Display order should be a positive number';
                }

                /*if (image == '') {
                 validate += '<br>Image is required';
                 }*/

                if (validate != '') {
                    $('.modal-alert-success').hide();
                    $('.modal-alert-danger').show();
                    $('.modal-alert-danger').html(validate);
                    setTimeout(function () {
                        $('.modal-alert-danger').hide();
                    }, 3000);
                    return;
                }



                //var form = $(this).parents('form:first');
                var formData = new FormData( $('#form_edit_product')[0]);
                $.ajax({
                    url: "<?php echo BASE_URL?>/admin/create-sub_products",
                    type: "post",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == 200) {

                            $('.modal-alert-danger').hide();
                            $('.modal-alert-success').show();
                            $('.modal-alert-success').html(data.message);

                            //$("#product_list").html(data.desktopView);
                            setProductList(data.products);

                            setTimeout(function () {
                                $('.modal-alert-success').hide();
                                $('#editModal').modal('hide');
                            }, 3000);
                        } else {
                            $('.modal-alert-success').hide();
                            $('.modal-alert-danger').show();
                            $('.modal-alert-danger').html(data.message);
                            setTimeout(function () {
                                $('.modal-alert-danger').hide();
                            }, 3000);
                        }
                        //$('.list_container').html(data);
                    }
                });
            });

            $(document).on('click', '.call_offer_modal', function () {
                var productId = $(this).attr('data-product_id');
                var offerId = $(this).attr('data-offer_id');
                var offerPrice = $(this).attr('data-offer_price');
                var offerDescription = $(this).attr('data-offer_description');
                /*console.log(productId);
                 console.log(offerId);
                 console.log(offerPrice);
                 console.log(offerDescription);*/

                $('#form_offerModal input[name="offer_id"]').val(offerId);
                $('#form_offerModal input[name="sub_product_id"]').val(productId);
                $('#form_offerModal input[name="offer_price"]').val(offerPrice);
                $('#form_offerModal textarea[name="offer_description"]').val(offerDescription);

                $('#offerModal').modal('show');
            });

            var offerNumber = "<?=(!empty($offers))?count($offers):0?>";
            $(document).on('click', '.switch-check-offer', function () {
                console.log('clicked');
                //console.log($(this).is(':checked'));return;

                var btn = $(this);
                var isActive =  $(this).is(':checked');
                var offerId = $(this).attr('data-offer_id');
                //console.log(offerNumber);//return;
                if (offerNumber >= 3 && isActive) {
                    $(this).prop('checked', false);
                    $('.div-alert-success').addClass('hide');
                    $('.div-alert-danger').removeClass('hide');
                    $('.alert-danger-pop').text('You have reached maximum offer limit. Please inactive any offer first.');
                    setTimeout(function () {
                        $('.div-alert-danger').addClass('hide');
                    }, 3000);
                    return;
                    /*$('.alert-success').hide();
                     $('.alert-danger').show();
                     $('.alert-danger').html('You have reached maximum offer limit. Please inactive any offer first.');
                     setTimeout(function () {
                     $('.alert-danger').hide();
                     }, 3000);*/
                }
                //console.log(isActive);console.log(offerId);return;
                $.ajax({
                    url: "<?php echo BASE_URL?>/admin/activate-offer",
                    type: "post",
                    data: {offer_id: offerId, is_active: isActive},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);

                        if (data.status == 200) {
                            //setProductList(data.products);
                            offerNumber = data.offerNumber;
                            //productAddAlert
                            $('.div-alert-danger').addClass('hide');
                            $('.div-alert-success').removeClass('hide');
                            $('.alert-success-pop').text(data.message);
                            setTimeout(function () {
                                $('.div-alert-success').addClass('hide');
                            }, 3000);
                            /*$('.alert-danger').hide();
                             $('.alert-success').show();
                             $('.alert-success').html(data.message);
                             setTimeout(function () {
                             $('.alert-success').hide();
                             }, 3000);*/
                        } else {
                            btn.prop('checked', false);
                            $('.div-alert-success').addClass('hide');
                            $('.div-alert-danger').removeClass('hide');
                            $('.alert-danger-pop').text(data.message);
                            setTimeout(function () {
                                $('.div-alert-danger').addClass('hide');
                            }, 3000);
                            /*$('.alert-success').hide();
                             $('.alert-danger').show();
                             $('.alert-danger').html(data.message);
                             setTimeout(function () {
                             $('.alert-danger').hide();
                             }, 3000);*/
                        }
                    }
                });
            });

            $(document).on('click', '.switch-check-product', function () {
                console.log('clicked');
                //console.log($(this).is(':checked'));
                var isActive =  $(this).is(':checked');
                var productId = $(this).attr('data-product_id');
                //console.log(isActive);console.log(offerId);return;
                $.ajax({
                    url: "<?php echo BASE_URL?>/admin/activate-product",
                    type: "post",
                    data: {product_id: productId, is_active: isActive},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);

                        if (data.status == 200) {
                            //setProductList(data.products);
                            if (data.deactivateOffer == true) {
                                $('#offer_status_'+productId).prop('checked', false);
                            }

                            $('.div-alert-danger').addClass('hide');
                            $('.div-alert-success').removeClass('hide');
                            $('.alert-success-pop').text(data.message);
                            setTimeout(function () {
                                location.reload();
                                $('.div-alert-success').addClass('hide');
                            }, 100);

                            /*$('.alert-danger').hide();
                             $('.alert-success').show();
                             $('.alert-success').html(data.message);
                             //setProductList(data.products);
                             setTimeout(function () {
                             $('.alert-success').hide();
                             }, 3000);*/
                        } else {
                            $('.div-alert-success').addClass('hide');
                            $('.div-alert-danger').removeClass('hide');
                            $('.alert-danger-pop').text(data.message);
                            setTimeout(function () {
                                $('.div-alert-danger').addClass('hide');
                            }, 3000);
                            /*$('.alert-success').hide();
                             $('.alert-danger').show();
                             $('.alert-danger').html(data.message);
                             setTimeout(function () {
                             $('.alert-danger').hide();
                             }, 3000);*/
                        }
                    }
                });
            });
        });

        function saveOffer() {
            var price = $('#form_offerModal input[name="offer_price"]').val();
            var validate = '';
            if (price == '') {
                validate += 'Price is required';
            }
            if (!$.isNumeric(price) && price != '') {
                validate = validate+'Price should be a number';
            } else if (price <= 0  && price != '') {
                validate = validate+'Price should be a positive number';
            }

            if (validate != '') {
                $('.modal-alert-success').hide();
                $('.modal-alert-danger').show();
                $('.modal-alert-danger').html(validate);
                setTimeout(function () {
                    $('.modal-alert-danger').hide();
                }, 3000);
                return;
            }

            var formData = new FormData( $('#form_offerModal')[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/admin/create-product-offer",
                type: "post",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data.data.product_id);
                    if (data.status == 200) {

                        $('.modal-alert-danger').hide();
                        $('.modal-alert-success').show();
                        $('.modal-alert-success').html(data.message);

                        $('#prod_'+data.data.product_id).attr('data-offer_id', data.data.offer_id);
                        $('#prod_'+data.data.product_id).attr('data-offer_price', data.data.offer_price);
                        $('#prod_'+data.data.product_id).attr('data-offer_description', data.data.offer_description);

                        $('#offer_status_'+data.data.product_id).attr('data-offer_id', data.data.offer_id);
                        //$("a").find("[data-product_id='" + data.data.product_id + "']").data('offer_id', data.data.offer_id);
                        //$("#product_list").html(data.desktopView);
                        //setProductList(data.products);

                        setTimeout(function () {
                            $('.modal-alert-success').hide();
                            $('#offerModal').modal('hide');
                            window.location.href="<?php echo BASE_URL?>/admin/products";
                        }, 2000);
                    } else {
                        $('.modal-alert-success').hide();
                        $('.modal-alert-danger').show();
                        $('.modal-alert-danger').html(data.message);
                        setTimeout(function () {
                            $('.modal-alert-danger').hide();
                        }, 3000);
                    }
                    //$('.list_container').html(data);
                }
            });
        }

        function editProduct(productId) {
            //console.log(productId);return;
            $.ajax({
                url: "<?php echo BASE_URL?>/admin/sub_product-details",
                type: "get",
                data: {product_id: productId},
                dataType: 'json',
                success: function (data) {
                    console.log(data);

                    if (data.status == 200) {
                        $('#editModal').modal('show');
                        //$('#form_edit_product).find("input[type=text], textarea").val("");
                        $('#form_edit_product input[name="image_name"]').val("");
                        $('#form_edit_product input[name="image"]').val("");

                        $('#form_edit_product input[name="sub_product_id"]').val(data.product.sub_product_id);
                        $('#form_edit_product input[name="name"]').val(data.product.name);
                        $('#form_edit_product textarea[name="description"]').val(data.product.description);
                        $('#form_edit_product select[name="product_id"]').val(data.product.product_id);
                        $('#form_edit_product input[name="quantity"]').val(data.product.quantity);
                        $('#form_edit_product input[name="price"]').val(data.product.price);
                        $('#form_edit_product input[name="display_order"]').val(data.product.display_order);
                    } else {
                    }
                }
            });
        }

        function deleteProduct(productId) {
            swal({
                    title: "",
                    text: "Are you sure you want to delete the sub product?",
                    //type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            url: "<?= BASE_URL ?>/admin/sub_product-delete",
                            data: {product_id: productId},
                            type: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                console.log(data.message);

                                if (data.status == 200) {
                                    setProductList(data.products);
                                    $('.alert-danger').hide();
                                    $('.alert-success').show();
                                    $('.alert-success').html(data.message);
                                    setTimeout(function () {
                                        $('.alert-success').hide();
                                    }, 3000);
                                } else {
                                    $('.alert-success').hide();
                                    $('.alert-danger').show();
                                    $('.alert-danger').html(data.message);
                                    setTimeout(function () {
                                        $('.alert-danger').hide();
                                    }, 3000);
                                }
                            }
                        });
                    }
                    /*else {
                     swal("Cancelled", "Your have canceled)", "error");
                     $('.confirm').trigger('click');
                     }*/
                }
            );
        }

        function setProductList(products) {
            var html = '';
            var counter = 1;
            var img = '<?= BASE_URL.'/assets/img/products/__image__' ?>';

            $.each(products, function (key, product) {
                html += '<tr>';
                html += '<td>'+counter+'</td>';
                html += '<td>'+product.product_name+'</td>';
                html += '<td>'+product.name+'</td>';
                html += '<td>'+product.price+'</td>';
                html += '<td>'+product.product_display_order+'</td>';

                html += '<td class="text-center" width="20%">';
                html += '<span class="action-icon">';
                html += '<a class="btn btn-primary" id="editProduct" href="javascript:;" title="Edit" onclick="editProduct('+product.sub_product_id+')">';
                html += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
                html += '</a>';
                html += '</span>';
                html += '<span class="action-icon">';
                html += '<a class="btn btn-danger" id="delProduct" href="javascript:;" title="Edit" onclick="deleteProduct('+product.sub_product_id+')">';
                html += '<i class="fa fa-minus-circle" aria-hidden="true"></i>';
                html += '</a>';
                html += '</span>';

                /*html += '<span class="action-icon">';
                 html += '<a class="btn btn-success" id="discountPorduct" title="discount" href="javascript:;">';
                 html += '<i class="fa fa-handshake-o" aria-hidden="true"></i>';
                 html += '</a>';
                 html += '</span>';*/
                html += '</td>';
                html += '</tr>';

                counter++;
            });
            $("#product_list").html(html);
        }
    </script>

<?php require_once "view/base/admin/footer.php"?>