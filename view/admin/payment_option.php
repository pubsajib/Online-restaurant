<?php require_once "view/base/admin/header.php"?>

        <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="common-parent">

							<!--warning-->
							<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<!--warning end--> 
							<div class="common-parent">
								<div class="panel panel-default">
									<div class="panel-heading">
										<label>Payment Option</label>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12">
												<p>Select A Payment Option</p>
												<!-- add category input-->
												<form id="payment_option_form" action="" method="post" class="margin-top-10 form-inline">
													<?php foreach($paymentOptions as $option){ ?>
														<div class="checkbox margin-right-20">
															<label>
																<input type="checkbox" name="<?php echo $option->payment_type_name?>" value="1" <?php if($option->is_active==1){echo "checked";}?>> <?php echo $option->payment_type_name?>
															</label>
														</div>
													<?php } ?>

													<br><br>
													<button class="btn btn-success pull-right" id="save_payment_option_button">save</button>
												</form>
											</div>
										</div>

									</div>
								</div>
								
							</div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<script>

		$(function () {
			$('#save_payment_option_button').click(function (ev) {
				ev.preventDefault();

				var validate = '';

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
					url: "<?php echo BASE_URL?>/admin/create-payment-option",
					type: "post",
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function (data) {
						console.log(data);
						if (data.status == 200) {

							$('.alert-danger').hide();
							$('.alert-success').show();
							$('.alert-success').html(data.message);


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

<?php require_once "view/base/admin/footer.php"?>