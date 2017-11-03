<?php require_once "view/base/admin/header.php"?>

	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 col-xs-12">
					<div class="common-parent">
						<div class="panel panel-default">
							<div class="panel-heading">
								Post Code
							</div>
							<div class="panel-body">
								<!--warning-->
								<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<!--warning end-->

								<form id="form_create_postcode">
									<div class="row">
										<div class="col-sm-2"></div>
										<div class="col-sm-6 col-xs-8">
											<input name="postcode_no" type="text" class="form-control w100" id="" placeholder="Enter Post Code">
										</div>

										<div class="col-sm-4 col-xs-4">
											<button type="submit" class="btn btn-primary btn_create_postcode">Add</button>
										</div>
									</div>
								</form>


								<div class="row">
									<div class="col-sm-12">
										<div class="all-tags margin-top-20">
											<ul class="tags-list">
												<?php if(!empty($postcodes)) foreach ($postcodes as $postcode) {?>
												<li><?= $postcode->postcode_no ?>
													<span>
														<a href="javascript:;" onclick="deletePostcode(<?= $postcode->postcode_id ?>)">
															<span class="glyphicon glyphicon-remove-circle"></span>
														</a>
													</span>
												</li>
												<?php }?>
												<!--<li>tags 02
													<span>
														<a href="javascript:;" class="tag-list-close">
															<span class="glyphicon glyphicon-remove-circle"></span>
														</a>
													</span>
												</li>-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on("click",".tag-list-close",function(){
			$(this).parents("li").remove();
		});
		$(function () {
			$('.btn_create_postcode').click(function (ev) {
				ev.preventDefault();
				var form = '#form_create_postcode';
				var btn = $(this);
				var postcode_no = $(form+' input[name="postcode_no"]').val();
				var validate = '';
				if (postcode_no.trim() == '') {
					validate = 'Post Code is required';
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

				var formData = new FormData( $(form)[0]);
				$.ajax({
					url: "<?php echo BASE_URL?>/admin/create-postcode",
					type: "post",
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function (data) {
						btn.removeClass('disabled');
						if (data.status == 200) {
							$(form+' :input').val('');

							$('.alert-danger').hide();
							$('.alert-success').show();
							$('.alert-success').html(data.message);

							//$("#product_list").html(data.desktopView);
							setPostcodeList(data.postcodes);

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
		});

		function deletePostcode(postcodeId) {
			swal({
					title: "",
					text: "Are you sure you want to delete the postcode?",
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
							url: "<?= BASE_URL ?>/admin/postcode-delete",
							data: {postcode_id: postcodeId},
							type: 'POST',
							dataType: 'json',
							success: function (data) {
								console.log(data.message);

								if (data.status == 200) {
									setPostcodeList(data.postcodes);
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

		function setPostcodeList(postcodes) {
			var html = '';
			$.each(postcodes, function (key, postcode) {
				/*<li>tags 02
				<span>
				<a href="javascript:;" class="tag-list-close">
					<span class="glyphicon glyphicon-remove-circle"></span>
					</a>
					</span>
					</li>*/
				html += '<li>'+postcode.postcode_no;
				html += '<span>';
				html += '<a href="javascript:;" onclick="deletePostcode('+postcode.postcode_id+')">';
				html += '<span class="glyphicon glyphicon-remove-circle"></span>';
				html += '</a>';
				html += '</span>';
				html += '</li>';
			});

			$('.tags-list').html(html);
		}
	</script>

<?php require_once "view/base/admin/footer.php"?>