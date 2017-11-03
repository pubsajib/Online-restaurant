<?php require_once "view/base/admin/header.php"?>
<!-- Page Content -->
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="common-parent">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Banner
                        </div>
                        <div class="panel-body">
                            <form id="add_banner_details" method="post" action="" class="">
                                <?php
                                $banner_data = json_decode($bannerData->banner, true);
                                $banner_text = $banner_data['home_banner_text'];
                                ?>
                                <!--warning-->
                                <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <!--warning end-->

                                <input type="hidden" name="banner_id" class="form-control" id="" value="<?php echo $bannerData->banner_id?>">
                                <div class="form-group">
                                    <label for="">Banner Text</label>
                                    <input type="text" class="form-control" name="banner_text" id="banner_text" value="<?php echo $banner_text?>">
                                </div>

                                <button class="btn btn-success pull-right" type="button" id="btn_create_banner">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "view/base/admin/footer.php"?>
<script>
    $(function () {
        $('#btn_create_banner').click(function (ev) {
            ev.preventDefault();
            if ($(this).hasClass('disabled')) {
                return;
            }
            $(this).addClass('disabled');
            var btn = $(this);

            var validate = '';

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
            var formData = new FormData(form[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/admin/create-banner-details",
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
