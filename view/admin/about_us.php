<?php require_once "view/base/admin/header.php"?>
    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
            	<div class="col-sm-12 col-xs-12">
            		<div class="common-parent">
            			<div class="panel panel-default">
							<div class="panel-heading">
								About Us
							</div>
							<div class="panel-body">
			            		<form id="add_about_us" method="post" action="" class="">

									<!--warning-->
									<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<!--warning end-->

									<input type="hidden" name="page_id" class="form-control" id="" value="<?php echo $aboutUs->page_id?>">
								  	<div class="form-group">
								    	<label for="">Heading</label>
								    	<input type="text" class="form-control" name="content_heading" id="content_heading" value="<?php echo $aboutUs->content_heading?>">
								  	</div>

								  	<div class="form-group">
								    	<label for="">Content</label>
								    	<textarea class="form-control" rows="3" name="content" id="content"><?php echo $aboutUs->content?></textarea>
								  	</div>

								  	<button class="btn btn-success pull-right" type="button" id="btn_create_about_us">Submit</button>
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
		$('#btn_create_about_us').click(function (ev) {
			ev.preventDefault();
			if ($(this).hasClass('disabled')) {
				return;
			}
			$(this).addClass('disabled');
			var btn = $(this);

			var validate = '';
			var content_heading = $('#content_heading').val();
			var content = $('#content').val();
			if (content_heading.trim('') == '') {
				validate += 'Content heading is required';
			}
			if (content.trim('') == '') {
				validate += '</br>Content is required';
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
			var formData = new FormData(form[0]);
			$.ajax({
				url: "<?php echo BASE_URL?>/admin/create-about-us",
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
