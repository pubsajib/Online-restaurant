
<form id="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="<?php echo $business_email; ?>">
    <input type="hidden" name="lc" value="<?php echo $currency; ?>">
    <input type="hidden" name="item_name_1" value="<?php echo $item_name; ?>">
    <input type="hidden" name="amount_1" value="<?php echo $total_amount; ?>">
    <input type="hidden" name="return" value="<?php echo $return_url; ?>">
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_url; ?>">
</form>

<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
<script>
    $(document).ready(function(){
        //alert('hello');
        $('#paypal_form').submit();
    });
</script>