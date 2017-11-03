<?php require_once "view/base/admin/header.php"?>

        <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
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
								<div class="panel panel-default add_panel" <?php if($deliveryCharge->delivery_charge!='' && $deliveryCharge->delivery_charge!=0){ echo 'style="display:none"';}?>>
									<div class="panel-heading">
										Delivery Charge
									</div>

									<div class="panel-body">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<!-- add category input-->
												<form id="form_create_charge" action="" method="post" class="margin-top-100">
													<div class="input-group">
														<input type="text" id="delivery_charge" name="delivery_charge" class="form-control search-input" placeholder="Enter Delivery Charge">

														<span class="input-group-btn">
														<button class="btn btn-primary search-input search-input-btn add-url" id="btn_create_charge" type="button">Add</button>
													</span>
													</div>

												</form>
											</div>
										</div>

									</div>
								</div>
							<!-- add category table-->
							<div class="table-responsive margin-top-40" <?php if($deliveryCharge->delivery_charge=='' || $deliveryCharge->delivery_charge==0){ echo 'style="display:none"';}?>>

								<form id="update_change_form" action="">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Charge Amount</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<input type="hidden" name="setting_id" value="<?php echo $deliveryCharge->setting_id;?>" >
												<input type="text" class="form-control editField" id="update_delivery_charge" name="delivery_charge" value="<?php echo $deliveryCharge->delivery_charge ;?>" readonly="readonly"/>
											</td>
											<td class="text-center">
												<span class="action-icon">
													<a class="btn btn-primary editBtn" id="editProduct" href="javascript:;" title="Edit">
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</a>
												</span>

												<span class="action-icon">
													<a class="btn btn-danger" id="delProduct" href="javascript:;" title="Delete" onclick="deleteCharge(<?php echo $deliveryCharge->settings_id ;?>)">
														<i class="fa fa-minus-circle" aria-hidden="true"></i>
													</a>
												</span>

												<span class="action-icon">
													<a class="btn btn-success" href="javascript:;" title="save" id="update_button" style="display:none">
														<i class="fa fa-floppy-o" aria-hidden="true"></i>
													</a>
												</span>
											</td>
										</tr>
									</tbody>
								</table>
								</form>
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
	
	
	/*Category edit modal*/
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Delivery Charge</h4>
                </div>

                <div class="modal-body">
						<!--warning-->
						<div class="alert modal-alert-success modal-alert-dismissible" role="alert" style="display: none;">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="alert modal-alert-danger alert-dismissible" role="alert" style="display: none;">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<!--warning end-->

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
											<label>Change Delivery Charge</label>
											<input type="hidden" name="setting_id" value="<?php echo $deliveryCharge->setting_id;?>" >
                                            <input type="text" id="update_delivery_charge" name="delivery_charge" value="<?php echo $deliveryCharge->delivery_charge ;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
			$(".editBtn").click(function(){
				$(".editField").attr("readonly", false);
				$("#update_button").show();

			});
		});
		
		$(function () {
			$('#btn_create_charge').click(function (ev) {
				ev.preventDefault();
				if ($(this).hasClass('disabled')) {
					return;
				}
				$(this).addClass('disabled');
				var btn = $(this);

				var validate = '';
				var delivery_charge = $('#delivery_charge').val();
				//console.log(names);return;
				if (delivery_charge.trim('') == '') {
					validate = 'Delivery charge is required';
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
					url: "<?php echo BASE_URL?>/admin/create-delivery-charge",
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
								window.location.href="<?php echo BASE_URL?>/admin/delivery-charge";
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

				if (delivery_charge.trim('') == '') {
					validate += 'Delivery charge is required';
				}

				if (validate != '') {
					$('.alert-success').hide();
					$('.alert-danger').show();
					$('.alert-danger').html(validate);
					setTimeout(function () {
						$('.alert-danger').hide();
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

							$('.alert-danger').hide();
							$('.alert-success').show();
							$('.alert-success').html(data.message);

							setTimeout(function () {
								$('.modal-alert-success').hide();
								$('#editModal').modal('hide');
								window.location.href="<?php echo BASE_URL?>/admin/delivery-charge";
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