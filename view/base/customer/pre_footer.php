<!-- Footer -->
<footer id="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="bloc-cms">
                    <img src="<?php echo BASE_URL?>/assets/customer/img/logo.png" alt="">
                    <p>
                        Lorem sit amet, ectetr iscinit. Vestibulum vel sum er, suscipieros quis by lorem.<br /><br />
                        Sed ventis nisl a auris laoreet, at ncidnt lectus volutpat. Etiam...
                    </p>
                    <a href="">Read More</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="open-hours">
                    <span class="foot-title">Opening Hours</span>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">MONDAY :</div> <div class="pull-left"> <?php echo get_opening_time('monday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">TUESDAY : </div> <div class="pull-left"> <?php echo get_opening_time('tuesday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">WEDNESDAY : </div> <div class="pull-left"> <?php echo get_opening_time('wednesday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">THURSDAY : </div> <div class="pull-left"> <?php echo get_opening_time('thursday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">FRIDAY : </div> <div class="pull-left"> <?php echo get_opening_time('friday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">SATURDAY : </div> <div class="pull-left"> <?php echo get_opening_time('saturday',$contacts);?></div></div>
                    <div class="margin-bottom-5 clearfix"><div class="pull-left opening-day">Sunday  : </div> <div class="pull-left"> <?php echo get_opening_time('sunday',$contacts);?></div></div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                <div class="last-tweet">
                    <span class="foot-title">Latest Tweets</span>
                    <div class="item-tweet">
                        <i class="fa fa-twitter"></i>
                        <div>
                            <p>Sed ventis nisl a au at ncidnt ctus volutpat. <a href="">https://twitter.com</a>
                            </p>
                            <span>
    										2 Hours ago
    									</span>
                        </div>
                    </div>
                    <div class="item-tweet">
                        <i class="fa fa-twitter"></i>
                        <div>
                            <p>Sed ventis nisl a au at ncidnt ctus volutpat. <a href="">https://twitter.com</a>
                            </p>
                            <span>
    										2 Hours ago
    									</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-sm hidden-xs">
                <div class="instagram">
                    <span class="foot-title">Instragram</span>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/22.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/23.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/24.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/23.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/24.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="">
                        <img src="<?php echo BASE_URL?>/assets/customer/img/22.jpg" alt="">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <p>

            <span>Powered by :</span>
            <span><a href="http://www.atitonline.co.uk/" target="_blank"><img class="copyright-logo" src="/assets/customer/img/footer-logo.png">| AT IT (UK) LTD</a></span>

        </p>
        <a class="footer_navigation" href="">Top</a>
    </div>
</footer>
<!-- End Footer -->

<?php
function get_opening_time($day,$contacts){
    if($contacts['opening_times'][$day]['is_open']==0){
        return "<p>Closed</p>";
    }
    else if($contacts['opening_times'][$day]['times'][0]['start_time']=="24 hours"){
        return "<p>24 hours</p>";
    }
    else{
        $opening_hour = '';
        foreach($contacts['opening_times'][$day]['times'] as $time){
            $opening_hour .= "<p>".$time['start_time']." - ".$time['end_time']."</p>";
        }
        return $opening_hour;
    }
}
?>

</div>
<!-- End Site Wrapper -->

<!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>

    <!-- Contribute JS Files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>  -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --> 

<script type="text/javascript" src="<?php echo BASE_URL?>/assets/customer/js/egprojets.lib.js"></script>
<!-- End Contribute JS Files -->

<!-- Custom JS Files -->
<script type="text/javascript" src="<?php echo BASE_URL?>/assets/customer/js/egprojets.custom.js"></script>

<!-- google map JS Files -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<!-- Custom JS Files -->

<script type="text/javascript" src="<?php echo BASE_URL?>/assets/customer/js/custom.js"></script>


<!-- captcha JS Files -->
<script type="text/javascript" src="<?php echo BASE_URL?>/assets/customer/js/jquery.plugin.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL?>/assets/customer/js/jquery.realperson.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//$(".site-loader").hide();
	});
</script>