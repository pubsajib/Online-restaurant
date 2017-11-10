<?php require_once "view/base/admin/header.php"; ?>

	<!-- Page Content -->
	<div id="page-wrapper">

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
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
								<div class="panel-heading"> Add Type </div>

								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<!-- add type input-->
											<form id="form_create_variation" action="" method="post" class="margin-top-100">
												<div class="input-group">
													<input type="text" id="" required name="variation_name[]" class="form-control search-input" placeholder="Enter Type Name" style="width:60%">
													<input type="number" id="" required="" name="display_order[]" class="form-control search-input" placeholder="Display Order" style="width: 35%;margin-left: 13px;">
													<span class="input-group-btn">
														<button class="btn btn-primary search-input search-input-btn add-url" id="" type="button"><i class="icon-plus icons"></i></button>
														<button class="btn btn-danger search-input search-input-btn remove-url" id="" type="button"><i class="icon-minus icons"></i></button>
													</span>
												</div>
												<ul class="add-url-list no-padding no-list-style">
													<li>
														<!-- <div class="dynamic-input-group">
															<div class="input-group margin-top-20">
																<input type="text" id="txtSearch" name="link" class="form-control search-input" placeholder="Enter URL">

																<span class="input-group-btn">
																	<button class="btn btn-primary search-input search-input-btn add-url" id="" type="button"><i class="icon-plus icons"></i></button>
																	<button class="btn btn-primary search-input search-input-btn" id="" type="button"><i class="icon-minus icons"></i></button>
																</span>
															</div>
														</div> -->
													</li>
												</ul>

												<button class="btn btn-primary center-block btn_create_variation" id="btnSearch" type="button">Add Type</button>
											</form>
										</div>
									</div>

								</div>
							</div>

							<!-- add type table-->

							<div class="table-responsive margin-top-40">
								<table class="table table-striped table-hover table-bordered">
									<thead>
										<tr>
											<th width="50px" class="text-center">SL.</th>
											<th>Variation Name</th>
											<th>Display Order</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody id="variation_list">
									<?php $counter = 1; ?>
									<?php if(!empty($variations)) foreach ($variations as $variation) {?>
										<tr>
											<form id="variation_form_<?php echo $counter?>">
												<td class="text-center text-bold"><?= $counter ?></td>
												<td class="catTd">
													<p class="catName">
														<input type="hidden" name="variation_id" value="<?php echo $variation->variation_id;?>">
														<input type="text" class="inactive-input" name="variation_name" id="variation_name_<?php echo $counter?>" value="<?php echo $variation->variation_name;?>" style="width: 100%" readonly />
													</p>
												</td><td class="catTd">
													<p class="displayOrder">
														<input type="text" class="inactive-input" name="display_order" id="display_order_<?php echo $counter?>" value="<?php echo $variation->display_order;?>" style="width: 100%" readonly />
													</p>
												</td>
												<td class="text-center">
													<span class="action-icon editBtn">
														<a class="btn btn-primary editProduct" data-id="<?php echo $counter?>" href="javascript:;" title="Edit">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</a>
													</span>

													<span class="action-icon deleteBtn">
														<a class="btn btn-danger" id="delProduct" href="javascript:;" title="Delete" onclick="deleteVariation(<?= $variation->variation_id?>)">
															<i class="fa fa-minus-circle" aria-hidden="true"></i>
														</a>
													</span>

													<span class="action-icon saveBtn hidden">
														<a class="btn btn-success saveCat" id="save_button_<?php echo $counter?>" href="javascript:;" title="Save" onclick="update_variation(<?php echo $counter?>)">
															<i class="fa fa-floppy-o" aria-hidden="true"></i>
														</a>
													</span>
												</td>
											</form>
										</tr>
										<?php $counter++ ?>
									<?php }?>
									</tbody>
								</table>
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

    <!-- /#wrapper -->


<!--	Variation edit modal-->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Variation</h4>
                </div>

				<!--warning-->
				<div class="alert alert-success modal-alert-success alert-dismissible" role="alert" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="alert alert-danger modal-alert-danger alert-dismissible" role="alert" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<!--warning end-->

                <div class="modal-body">
                    <form id="form_edit_variation" action="">
						<input type="hidden" name="variation_id" value="">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
											<label>Variation Name</label>
                                            <input name="variation_name[]" type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn_edit_variation">Save changes</button>
                </div>
            </div>
        </div>
    </div>

	
	<script>
		$(document).on("click",".add-url",function(){
			var html='<li>';
				html+='<div class="dynamic-input-group">';
				html+='<div class="input-group margin-top-20">';
				html+='<input type="text" id="" required name="variation_name[]" class="form-control search-input" placeholder="Enter Variation Name" style="width:60%">';
				html+='<input type="number" id="" required="" name="display_order[]" class="form-control search-input" placeholder="Display Order" style="width: 35%;margin-left: 13px;">';
				html+='<span class="input-group-btn">';
				html+='<button class="btn btn-primary search-input search-input-btn add-url" id="" type="button"><i class="icon-plus icons"></i></button>';
				html+='<button class="btn btn-danger search-input search-input-btn remove-url" id="" type="button"><i class="icon-minus icons"></i></button>';
				html+='</span>';
				html+='</div>';
				html+='</div>';
			$(".add-url-list").append(html);
		});
		
		//Variation add modal
		$(document).on("click",".editProduct",function(){
			//Button show hide
			$(this).parents("td").find(".editBtn,.deleteBtn").addClass("hidden");
			$(this).parents("td").find(".saveBtn").removeClass("hidden");

			var data_id = $(this).attr('data-id');
			$("#variation_name_"+data_id).attr("readonly", false);
			$("#variation_name_"+data_id).removeClass("inactive-input");
			$("#display_order_"+data_id).attr("readonly", false);
			$("#display_order_"+data_id).removeClass("inactive-input");
		});


		$(document).on("click",".remove-url",function(){
			$(this).parents("li").remove();
			//$(this).parents("li").prev("li").find(".add-url").remove('disabled');
		});

		$(function () {
			$('.btn_create_variation').click(function (ev) {
				ev.preventDefault();
				if ($(this).hasClass('disabled')) {
					return;
				}
				$(this).addClass('disabled');
				var btn = $(this);

				var validate = '';
				var names = $("#form_create_variation input[name='variation_name\\[\\]']").map(function(){return $(this).val();}).get();
				var display_orders = $("#form_create_variation input[name='display_order\\[\\]']").map(function(){return $(this).val();}).get();
				//console.log(names);return;
				$.each(names, function (key, name) {
					if (name.trim('') == '') {
						validate = 'Variation Name is required';
					}
				});
				$.each(display_orders, function (key, display_order) {
					if (display_order.trim('') == '') {
						validate += '<br>Display order is required';
					}
				});


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
					url: "<?php echo BASE_URL?>/admin/create-variation",
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
							/*var input = form+" :input";
							 input.val('');*/
							$('#form_create_variation :input').val('');
							$(".add-url-list").html('');
							//$( form+" :textarea" ).val('');
							//$( form+":textarea" ).val('');

							$('.alert-danger').hide();
							$('.alert-success').show();
							$('.alert-success').html(data.message);

							//$("#product_list").html(data.desktopView);

							setTimeout(function () {
								$('.alert-success').hide();
								window.location.href="<?php echo BASE_URL?>/admin/variation";
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

			$('.btn_edit_variation').click(function (ev) {
				ev.preventDefault();
				var validate = '';
				var name = $('#form_edit_variation input[name="variation_name[]"]').val();

				if (name.trim('') == '') {
					validate += 'Variation name is required';
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
				var formData = new FormData( $('#form_edit_variation')[0]);
				$.ajax({
					url: "<?php echo BASE_URL?>/admin/create-variation",
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
							setvariationList(data.variations);

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
		});

		function update_variation(counter){
			$('body').scrollTop(0);
			var validate = '';
			var name = $('#variation_name_'+counter).val();
			var diaplay_order = $('#display_order_'+counter).val();

			if (name.trim('') == '') {
				validate += 'Variation name is required';
			}
			if (diaplay_order.trim('') == '') {
				validate += 'Display Order is required';
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
			var formData = new FormData( $('#variation_form_'+counter)[0]);
			$.ajax({
				url: "<?php echo BASE_URL?>/admin/create-variation",
				type: "post",
				data: formData,
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					console.log(data);
					if (data.status == 200) {

						$("#variation_name_"+counter).attr("readonly", true);
						$("#variation_name_"+counter).addClass("inactive-input");
						$("#display_order_"+counter).attr("readonly", true);
						$("#display_order_"+counter).addClass("inactive-input");
						$('#save_button_'+counter).parents("td").find(".editBtn,.deleteBtn").removeClass("hidden");
						$('#save_button_'+counter).parents("td").find(".saveBtn").addClass("hidden");

						$('.alert-danger').hide();
						$('.alert-success').show();
						$('.alert-success').html(data.message);

						//$("#product_list").html(data.desktopView);
						//setvariationList(data.variations);

						setTimeout(function () {
							$('.alert-success').hide();
							$('#editModal').modal('hide');
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
		}

		function editVariation(variationId) {
			//console.log(productId);return;
			$.ajax({
				url: "<?php echo BASE_URL?>/admin/variation-details",
				type: "get",
				data: {variation_id: variationId},
				dataType: 'json',
				success: function (data) {
					//console.log(data);
					if (data.status == 200) {
						$('#editModal').modal('show');

						$('#form_edit_variation input[name="variation_id"]').val(data.variation.variation_id);
						$('#form_edit_variation input[name="variation_name[]"]').val(data.variation.variation_name);
					} else {
					}
				}
			});
		}

		function deleteVariation(variationId) {
			swal({
					title: "",
					text: "Are you sure you want to delete the variation?",
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
							url: "<?= BASE_URL ?>/admin/variation-delete",
							data: {variation_id: variationId},
							type: 'POST',
							dataType: 'json',
							success: function (data) {
								console.log(data.status);

								if (data.status == 200) {
									$('.alert-danger').hide();
									$('.alert-success').show();
									$('.alert-success').html(data.message);
									setTimeout(function () {
										$('.alert-success').hide();
										window.location.href="<?php echo BASE_URL?>/admin/variation";
									}, 2000);
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

		function setVariationList(variations) {
			var html = '';
			var counter = 1;
			$.each(variations, function (key, variation) {
				html += '<tr>';
				html += '<td class="text-center text-bold">'+counter+'</td>';
				html += '<td>'+variation.variation_name+'</td>';
				html += '<td class="text-center">';
				html += '<span class="action-icon">';
				html += '<a class="btn btn-danger" id="editProduct" href="javascript:;" title="Edit" onclick="editVariation('+variation.variation_id+')">';
				html += '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
				html += '</a>';
				html += '</span>';
				html += '<span class="action-icon">';
				html += '<a class="btn btn-primary" id="delProduct" href="javascript:;" title="Edit" onclick="deleteVariation('+variation.variation_id+')">';
				html += '<i class="fa fa-minus-circle" aria-hidden="true"></i>';
				html += '</a>';
				html += '</span>';
				html += '</td>';
				html += '</tr>';

				counter++;
			});
			$("#variation_list").html(html);
		}
	</script>

<?php require_once "view/base/admin/footer.php"?>