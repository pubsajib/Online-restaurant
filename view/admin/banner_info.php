<?php require_once "view/base/admin/header.php"?>

        <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                        <div class="common-parent">
							<div class="common-parent">
								<div class="panel panel-default">
									<div class="panel-heading">
										Banner Info
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-8 col-sm-offset-2">
												<!-- add category input-->
												<form id="" action="" method="post" class="margin-top-100">
													<div class="form-group">
														<input type="text" id="" name="" class="form-control search-input" placeholder="Enter Page Title">
													</div>

													<div class="form-group">
														<input type="text" id="" name="" class="form-control search-input" placeholder="Enter Page Menu">
													</div>

													<button type="" class="btn btn-success pull-right">save</button>
												</form>
											</div>
										</div>

									</div>
								</div>
								
								<!-- add category table-->
								<div class="table-responsive margin-top-40">          
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">Page Title</th>
												<th class="text-center">Page Menu</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">
													<p>About Us</p>
												</td>
												<td class="text-center">
													<p>About Us</p>
												</td>
												<td class="text-center">
													<span class="action-icon">
														<a class="btn btn-primary" id="" href="javascript:;" title="Edit" data-toggle="modal" data-target="#editModal">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</a>
													</span>
													
													<span class="action-icon">
														<a class="btn btn-danger" id="" href="javascript:;" title="Delete">
															<i class="fa fa-minus-circle" aria-hidden="true"></i>
														</a>
													</span>
												</td>
											</tr>
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

    </div>
    <!-- /#wrapper -->
	
	
	/*Category edit modal*/
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Banner Info</h4>
                </div>

                <div class="modal-body">
                    <form id="" action=""> 
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
											<label>Page Title</label>
                                            <input type="text" class="form-control" id="">
                                        </div>

                                        <div class="form-group">
											<label>Page Menu Name</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </div>
    </div>


<?php require_once "view/base/admin/footer.php"?>