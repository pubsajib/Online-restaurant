<?php require_once "view/base/admin/header.php"?>
    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
            	<div class="col-sm-12 col-xs-12">
            		<div class="common-parent">
            			<form id="create_contact_details_form" method="post" action="" class="">

							<!--warning-->
							<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<!--warning end-->
            				<div class="row">
            					<div class="col-sm-12 col-xs-12">
		            				<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													Company Name
												</div>
												<div class="panel-body">
													<div class="form-group">
														<label for="">Company Name</label>
														<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $contacts['company_name']?>">
													</div>
												</div>
											</div>
										</div>
		            					<div class="col-sm-12 col-xs-12">
					            			<div class="panel panel-default">
												<div class="panel-heading">
													Header
												</div>
												<div class="panel-body">
												  	<div class="form-group">
												    	<label for="">Support Phone</label>
												    	<input type="text" class="form-control" name="header_phone1" id="header_phone1" value="<?php echo $contacts['header_phone1']?>">
												  	</div>

												  	<div class="form-group">
												    	<label for="">Support Email</label>
												    	<input type="email" class="form-control" name="header_email1" id="header_email1" value="<?php echo $contacts['header_email1']?>">
												  	</div>
												</div>
											</div>
										</div>

										<div class="col-sm-12 col-xs-12">
					            			<div class="panel panel-default">
												<div class="panel-heading">
													Contact Details
												</div>
												<div class="panel-body">
												  	<div class="form-group">
												    	<label for="">Email</label>
												    	<input type="email" class="form-control" name="reservation_email1" id="reservation_email1" value="<?php echo $contacts['reservation_email1']?>">
												  	</div>

												  	<div class="form-group">
												    	<label for="">Phone</label>
												    	<input type="text" class="form-control" name="reservation_phone1" id="reservation_phone1" value="<?php echo $contacts['reservation_phone1']?>">
												  	</div>

												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12 col-xs-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											Contact Address
										</div>
										<div class="panel-body">
											<div class="form-group">
										    	<label for="">Phone1</label>
										    	<input type="text" class="form-control" name="contact_phone1" id="contact_phone1" value="<?php echo $contacts['contact_phone1']?>">
										  	</div>
										  	<div class="form-group">
										    	<label for="">Phone2</label>
										    	<input type="text" class="form-control" name="contact_phone2" id="contact_phone2" value="<?php echo $contacts['contact_phone2']?>">
										  	</div>

										  	<div class="form-group">
										    	<label for="">Street</label>
										    	<input type="text" class="form-control" name="contact_street" id="contact_street" value="<?php echo $contacts['contact_street']?>">
										  	</div>
										  	<div class="row">
											  	<div class="form-group col-sm-6 col-xs-12">
											    	<label for="">City</label>
											    	<input type="text" class="form-control" name="contact_city" id="contact_city" value="<?php echo $contacts['contact_city']?>">
											  	</div>

											  	<div class="form-group col-sm-6 col-xs-12">
											    	<label for="">ZIP</label>
											    	<input type="text" class="form-control" name="contact_postcode" id="contact_postcode" value="<?php echo $contacts['contact_postcode']?>">
											  	</div>
											</div>

											<div class="row">
											  	<div class="form-group col-sm-6 col-xs-12">
											    	<label for="">Order Email</label>
											    	<input type="email" class="form-control" name="contact_email1" id="contact_email1" value="<?php echo $contacts['contact_email1']?>">
											  	</div>

											  	<div class="form-group col-sm-6 col-xs-12">
											    	<label for="">Sells Email</label>
											    	<input type="email" class="form-control" name="contact_email2" id="contact_email2" value="<?php echo $contacts['contact_email2']?>">
											  	</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-12 col-xs-12">
			            			<div class="panel panel-default">
										<div class="panel-heading">
											Query
										</div>
										<div class="panel-body">
										  	<div class="form-group">
										    	<label for="">Query Email</label>
										    	<input type="email" class="form-control" name="query_email1" id="query_email1" value="<?php echo $contacts['query_email1']?>">
										  	</div>
										</div>
									</div>
								</div>
							</div>

							<button class="btn btn-success pull-right margin-bottom-20" type="button" id="btn_create_contact_details">Submit</button>
						</form>
					</div>
            	</div>
            </div>
        </div>
    </div>
<?php require_once "view/base/admin/footer.php"?>

<script>
	$(function () {
		$('#btn_create_contact_details').click(function (ev) {
			ev.preventDefault();
			if ($(this).hasClass('disabled')) {
				return;
			}
			$(this).addClass('disabled');
			var btn = $(this);

			var validate = '';
			var header_email1 = $('#header_email1').val();
			var company_name = $('#company_name').val();
			var reservation_email1 = $('#reservation_email1').val();
			var order_email = $('#contact_email1').val();
			var sells_email = $('#contact_email2').val();
			var query_email1 = $('#query_email1').val();
			if (company_name.trim('') == '') {
				validate += 'Company name is required';
			}
			if (query_email1.trim('') == '') {
				validate += '</br>Query email is required';
			}
			if (header_email1.trim('') != '') {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if( !re.test(header_email1)){
					validate += '</br>Support email is not valid';
				}
			}
			if (reservation_email1.trim('') != '') {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if( !re.test(reservation_email1)){
					validate += '</br>Contact email is not valid';
				}
			}
			if (order_email.trim('') != '') {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if( !re.test(order_email)){
					validate += '</br>Order email is not valid';
				}
			}
			if (sells_email.trim('') != '') {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if( !re.test(sells_email)){
					validate += '</br>Sells email is not valid';
				}
			}
			if (query_email1.trim('') != '') {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if( !re.test(query_email1)){
					validate += '</br>Query email is not valid';
				}
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

			var form = $(this).parents('form:first');
			var formData = new FormData(form[0]);
			$.ajax({
				url: "<?php echo BASE_URL?>/admin/create-contact-details",
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