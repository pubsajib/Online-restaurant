<?php require_once "view/base/admin/header.php"?>

        <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="common-parent">
							<div class="common-parent">

								<!--warning-->
								<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<!--warning end-->

								<div class="panel panel-default">
									<div class="panel-heading">
										<label>Delivery or Collection</label>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12">
												<p>Select Option</p>
												<!-- add category input-->
												<form id="save_collection_form" action="" method="post" class="margin-top-10 form-inline">

													<?php foreach($deliveryCollection as $collection){ ?>
														<div class="checkbox margin-right-20">
															<label>
																<input type="checkbox" name="<?php echo $collection->order_process_name?>" value="1" <?php if($collection->is_active==1){echo "checked";}?>> <?php echo $collection->order_process_name?>
															</label>
														</div>
													<?php } ?>

													<!-- <div class="checkbox margin-left-20">
													    <label>
													      <input type="radio" name="delivery_collection" value="Delivery & Collection" <?php if($deliveryCollection->order_process_name=='Delivery & Collection'){echo "checked";}?>>Delivery & Collection
													    </label>
													</div> -->
													<br><br>
													<button class="btn btn-success pull-right" id="save_collection_button">save</button>
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
			$('#save_collection_button').click(function (ev) {
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
				var formData = new FormData( form[0]);
				$.ajax({
					url: "<?php echo BASE_URL?>/admin/create-delivery-collection",
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

			$('#update_button').click(function (ev) {
				ev.preventDefault();
				var validate = '';
				var delivery_charge = $('#update_delivery_charge').val();

				if (delivery_charge == '') {
					validate += 'Delivery charge is required';
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

				//var form = $(this).parents('form:first');
				var formData = new FormData( $('#update_change_form')[0]);
				$.ajax({
					url: "<?php echo BASE_URL?>/admin/create-delivery-charge",
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

							setTimeout(function () {
								$('.modal-alert-success').hide();
								$('#editModal').modal('hide');
								window.location.href="<?php echo BASE_URL?>/admin/delivery-charge";
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
		});

		function deleteCharge(settingId) {
			swal({
					title: "",
					text: "Are you sure you want to delete the charge?",
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
							url: "<?= BASE_URL ?>/admin/delivery-charge-delete",
							data: {setting_id: settingId},
							type: 'POST',
							dataType: 'json',
							success: function (data) {
								console.log(data.message);

								if (data.status == 200) {
									$('.alert-danger').hide();
									$('.alert-success').show();
									$('.alert-success').html(data.message);
									setTimeout(function () {
										$('.alert-success').hide();
										window.location.href="<?php echo BASE_URL?>/admin/delivery-charge";
									}, 500);
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

	</script>

<?php require_once "view/base/admin/footer.php"?>