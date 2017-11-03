<?php require_once "view/base/admin/header.php"?>
<!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="">
                            <!--warning-->
                            <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <!--warning end-->
                            <div class="col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="col-sm-12 col-xs-12 checkout-content">
                                        <div class="">
                                            <?php if(isset($data['date_invalid_message']) && $data['date_invalid_message'] != ''){?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?php echo $data['date_invalid_message']; ?>
                                                </div>
                                            <?php } ?>
                                            <h3 class="no-margin-top">Order Report</h3>
                                            <hr>

                                            <div clas="row">
                                                <div class="col-sm-12 col-xs-12 no-padding">

                                                    <div class="row margin-bottom-20">
                                                        <form action="">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <!--label for="dp1"></label-->
                                                                    <input type="text" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo isset($_GET['start_date'])?$_GET['start_date']:'';?>" id="dp1"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <!--label for="dp2"></label-->
                                                                    <input type="text" name="end_date" class="form-control" placeholder="End Date" value="<?php echo isset($_GET['end_date'])?$_GET['end_date']:'';?>" id="dp2"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <!--label for="dp2"></label-->
                                                                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo isset($_GET['email'])?$_GET['email']:'';?>" id="email"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <!--label for="dp2"></label-->
                                                                    <input type="text" name="mobile" class="form-control" placeholder="Mobile No" value="<?php echo isset($_GET['mobile'])?$_GET['mobile']:'';?>" id="mobile"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <!--label for="dp2"></label-->
                                                                    <input type="text" name="order_id" class="form-control" placeholder="Order ID" value="<?php echo isset($_GET['order_id'])?$_GET['order_id']:'';?>" id="order_id"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                <input class="btn btn-success pull-left" type="submit" value="Submit" placeholder="Submit">
                                                            </div>

                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-6">
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
                                                        </form>

                                                    </div><!-- /.row -->

                                                    <div class="table-responsive order-history-table">
                                                        <table id="tablePdf" class="table table-bordered table-hover table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Order ID</th>
                                                                <th>Order Type</th>
                                                                <th>Customer ID</th>
                                                                <th>Email Address</th>
                                                                <th>Delivery Address</th>
                                                                <th>Estimated Dispatch Time</th>
                                                                <th>Pay by</th>
                                                                <th>Total Price</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(isset($data['order_history']) && !empty($data['order_history'])) {
                                                                foreach ($data['order_history'] as $key => $val) {
                                                                    $delivery_address = $val->delivery_address.', '.$val->delivery_city_town.', '.$val->delivery_postcode;
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="javascript:;" class="pull-left" id="myBtn">
                                                                                <i class="fa fa-plus-circle"
                                                                                   aria-hidden="true"></i>&nbsp;
                                                                                <?php echo $val->order_id; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $val->order_process_type_name; ?></td>
                                                                        <td><?php echo $val->customer_id; ?></td>
                                                                        <td><?php echo $val->email; ?></td>
                                                                        <td><?php echo $delivery_address; ?></td>
                                                                        <td><?php echo $val->printer_delivery_time; ?></td>
                                                                        <td><?php echo $val->payment_type; ?></td>
                                                                        <td><?php echo $val->total; ?></td>
                                                                        <td><?php echo $val->order_status; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <table id="tableCsv" hidden class="table table-bordered table-hover table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Order Type</th>
                                                            <th>Customer ID</th>
                                                            <th>Email Address</th>
                                                            <th>Delivery Address</th>
                                                            <th>Estimated Dispatch Time</th>
                                                            <th>Pay by</th>
                                                            <th>Total Price</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        if(isset($data['print_order_history']) && !empty($data['print_order_history'])) {
                                                            foreach ($data['print_order_history'] as $key => $val) {
                                                                $delivery_address = $val->delivery_address.', '.$val->delivery_city_town.', '.$val->delivery_postcode;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $val->order_id; ?></td>
                                                                    <td><?php echo $val->order_process_type_name; ?></td>
                                                                    <td><?php echo $val->customer_id; ?></td>
                                                                    <td><?php echo $val->email; ?></td>
                                                                    <td><?php echo $delivery_address; ?></td>
                                                                    <td><?php echo $val->printer_delivery_time; ?></td>
                                                                    <td><?php echo $val->payment_type; ?></td>
                                                                    <td><?php echo $val->total; ?></td>
                                                                    <td><?php echo $val->order_status; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }?>
                                                        </tbody>
                                                    </table>

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

                                            <div class="clearfix"></div>
                                            <!--div style="height:300px;"></div-->

                                            <!-- The Modal -->
                                            <div id="myModal" class="modal">
                                            	<div class="modal-dialog report-modal modal-lg">
                                                <!-- Modal content -->
                                                <div class="modal-content">

                                                    <div class="modal-body">

                                                        <span class="order-history-close pull-right close">&times;</span> <br>

                                                        <div class="table-responsive order-history-table">
                                                            <table class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>Order ID</th>
                                                                    <th>Order Type</th>
                                                                    <th>Customer ID</th>
                                                                    <th>Email Address</th>
                                                                    <th>Delivery Address</th>
                                                                    <th>Estimated Dispatch Time</th>
                                                                    <th>Pay by</th>
                                                                    <th>Total Price</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="inner-table">

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="table-responsive order-history-table inner_modal">

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
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "view/base/admin/footer.php"?>

<script src="<?php echo BASE_URL?>/assets/customer/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL?>/assets/customer/js/jquery.tabletoCSV.js"></script>
<script src="<?php echo BASE_URL?>/assets/customer/js/jspdf.debug.js"></script>
<script src="<?php echo BASE_URL?>/assets/customer/js/autotable.js"></script>
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/customer/css/jquery-ui.css" />
<script>
    $( "#dp1" ).datepicker();
    $( "#dp2" ).datepicker();

    $('[id^=myBtn]').click(function() {
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var tr = $(this).closest('tr').html();
        var new_tr = "<tr>" + tr + "</tr>";

        var name = $(this).closest('tr').children(':eq(0)').html();
        var order_id = name.replace ( /[^\d.]/g, '' );

        var base_url = "<?= BASE_URL;?>";
        var url = base_url+"/order/send-order-history-model-body?order_id="+order_id;

        $.ajax({
            url: url,
            success: function(result){
                console.log(result);
                modal.style.display = "block";
                $(".inner_modal").html(result);
                $(".inner-table").html(new_tr);
            }
        });
    });

    $('.close').click(function () {
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    });

    $('#exportPdf').click(function () {
        var doc = new jsPDF('p', 'pt');
        var elem = document.getElementById("tableCsv");

        doc.setFontSize(20);
        doc.text(250, 20, 'Order History');

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

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            var modal = document.getElementById('myModal');
            modal.style.display = "none";
        }
    }
</script>