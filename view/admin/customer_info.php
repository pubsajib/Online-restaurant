<?php require_once "view/base/admin/header.php"?>
<?php //print "<pre>";print_r($data);exit;?>
    <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="common-parent">
                    	<div class="customerInfoTable-parent">
                    		<!-- table content end-->
                    		<div clas="row">
                                <div class="col-sm-12 col-xs-12 no-padding">
                                    <div class="row margin-bottom-20">
                                        <form action="">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <!--label for="dp1"></label-->
                                                    <input type="text" name="" class="form-control" placeholder="Name" id=""/>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-xs-12">
                                                <div class="form-group">
                                                    <!--label for="dp2"></label-->
                                                    <input type="text" name="" class="form-control" placeholder="Post Code" id=""/>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-xs-6">
                                                <input type="text" name="" class="form-control" placeholder="Phone" id=""/>
                                            </div>

                                            <div class="col-sm-1 col-xs-6">
                                                <button class="btn btn-success">
                                                	Search
                                                	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                	
                                                </button>
                                            </div>
                                        </form>

                                            <div class="col-sm-3 col-xs-6">
                                                <span class="pull-right">
                                                    <a href="javascript:;" id="exportPdf" class="btn btn-default download-btn" title="pdf">
                                                        <img src="<?php echo BASE_URL?>/assets/customer/img/pdf.png">
                                                    </a>
                                                </span>

                                                <span class="pull-right">
                                                    <a href="javascript:;" id="exportCsv" class="btn btn-default download-btn" title="csv">
                                                        <img src="<?php echo BASE_URL?>/assets/customer/img/csv.png">
                                                    </a>
                                                </span>
                                                <span class="pull-right">
                                                    <a href="javascript:;" id="exportPrint" class="btn btn-default download-btn" title="print">
                                                        <img src="<?php echo BASE_URL?>/assets/customer/img/print.png">
                                                    </a>
                                                </span>
                                            </div>  
                                        
                                    </div><!-- /.row -->

                                    <div class="table-responsive order-history-table">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Fast Name</th>
                                                    <th>Last Name</th>
                                                    <th style="width:200px">Address 1</th>
                                                    <th style="width:200px">Address 2</th>
                                                    <th>Post Code</th>
                                                    <th>Email Address</th>
                                                    <th>Phone Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
												if(isset($data['customers']) && !empty($data['customers'])) {
													foreach ($data['customers'] as $key => $val) {
											?>
                                                <tr>
                                                    <td><?php echo $val->customer_id ?></td>
                                                    <td><?php echo $val->first_name ?></td>
                                                    <td><?php echo $val->last_name ?></td>
                                                    <td><?php echo $val->address1 ?></td>
                                                    <td><?php echo $val->address2 ?></td>
                                                    <td><?php echo $val->postcode ?></td>
                                                    <td><?php echo $val->email ?></td>
                                                    <td><?php echo $val->phone ?></td>
                                                </tr>
											<?php
													}
												}
											?>
                                            </tbody>
                                        </table>

										<table id="tableCsv" hidden class="table table-bordered table-hover table-striped">
											<thead>
											<tr>
												<th>Customer ID</th>
												<th>Fast Name</th>
												<th>Last Name</th>
												<th style="width:200px">Address 1</th>
												<th style="width:200px">Address 2</th>
												<th>Post Code</th>
												<th>Email Address</th>
												<th>Phone Number</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(isset($data['print_customers']) && !empty($data['print_customers'])) {
												foreach ($data['print_customers'] as $key => $val) {
													?>
													<tr>
														<td><?php echo $val->customer_id ?></td>
														<td><?php echo $val->first_name ?></td>
														<td><?php echo $val->last_name ?></td>
														<td><?php echo $val->address1 ?></td>
														<td><?php echo $val->address2 ?></td>
														<td><?php echo $val->postcode ?></td>
														<td><?php echo $val->email ?></td>
														<td><?php echo $val->phone ?></td>
													</tr>
													<?php
												}
											}
											?>
											</tbody>
										</table>

                                    </div>

									<?php
									if(isset($data['pagination']) && !empty($data['pagination'])){
										if (strpos("$_SERVER[REQUEST_URI]", 'start_date') !== false) {
											if (strpos("$_SERVER[REQUEST_URI]", 'page') !== false) {
												$url = preg_replace("^&page=(\d+)^", "", "$_SERVER[REQUEST_URI]");
												$url .= "&page=";
											}else{
												$url = "$_SERVER[REQUEST_URI]"."&page=";
											}
										}else{
											$url = "?page=";
										}
										?>
										<nav aria-label="Page navigation">
											<ul class="pagination">
												<li>
													<a href="<?php echo $url; ?>0" aria-label="Previous">
														<span aria-hidden="true">&laquo;</span>
													</a>
												</li>

												<?php foreach ($data['pagination'] as $k=>$v){ ?>
													<li><a href="<?php echo $url.$v; ?>"><?php echo $v+1; ?></a></li>
												<?php } ?>

												<li>
													<a href="<?php echo $url.$data['max_pagination']; ?>" aria-label="Next">
														<span aria-hidden="true">&raquo;</span>
													</a>
												</li>
											</ul>
										</nav>
									<?php } ?>

                                </div>
                            </div>
                            <!-- table content end-->
						</div>
                    </div>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<script src="<?php echo BASE_URL?>/assets/customer/js/jquery.tabletoCSV.js"></script>
	<script src="<?php echo BASE_URL?>/assets/customer/js/jspdf.debug.js"></script>
	<script src="<?php echo BASE_URL?>/assets/customer/js/autotable.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
		    //customer info data table
			$('#customerInfoTable').DataTable( {
				"paging":   true,
				"ordering": false,
				"info":     false,
				
			});
		});

		$('#exportPdf').click(function () {
			var doc = new jsPDF('p', 'pt');

            doc.setFontSize(20);
            doc.text(220, 20, 'Customer Information');

			var elem = document.getElementById("tableCsv");
			var res = doc.autoTableHtmlToJson(elem);
			doc.autoTable(res.columns, res.data);
			var ts = new Date().getTime();

			doc.save(ts+".pdf");
		});

		$('#exportCsv').click(function () {
			$("#tableCsv").tableToCSV();
		});

		$('#exportPrint').click(function () {
			var divToPrint=document.getElementById("tableCsv");
			divToPrint.removeAttribute( "hidden" );
			newWin= window.open("");
			newWin.document.write(divToPrint.outerHTML);
			newWin.print();
			newWin.close();
			$("#tableCsv").hide();
		});

    </script>
	
<?php require_once "view/base/admin/footer.php"?>