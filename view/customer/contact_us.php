<?php require_once "view/base/customer/header.php"?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<!-- Section Main -->
<section id="breadcrumb" data-background="assets/customer/img/main3.jpg" class="parallax-window orderBreadcrumb hidden-xs">
    <div>
        <!--span class="section-suptitle text-center">Food Lover</span-->
        <h1 class="section-title white-font text-center">Contact us</h1>
        <!--ul>
            <li><a href="">Home</a></li>
            <li>Contact us</li>
        </ul-->
    </div>
</section>
<!-- End Section Main -->

<?php

?>

<!-- Section Contact -->
<section id="contact-detail" class=" padd-100">
    <h2 class="section-title sep-type-2 text-center">Contact Details</h2>
    <p class="section-resume">
        We accept reservations for parties of up to 8 people. for parties of 10 or more. please call at <br />
        <span><?php echo $contacts['reservation_phone1'];?></span> or email us at <a href=""><?php echo $contacts['reservation_email1'];?></a>.
    </p>
    <div id="map"></div>
    <!--div id="maps"></div-->
    <div class="container padd-bottom-100 padd-top-120">
        <div class="row">
            <div class="col-sm-4">
                <div class="item-contact">
                    <i class="fa fa-phone"></i>
                    <b>Phone</b>
                    <p><?php echo $contacts['contact_phone1'];?></p>
                    <p><?php echo $contacts['contact_phone2'];?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item-contact">
                    <i class="fa fa-map-marker"></i>
                    <b>Address</b>
                    <p>
                        <?php echo $contacts['contact_street'];?> <br />
                        <?php echo $contacts['contact_city'];?> <br />
                        <?php echo $contacts['contact_postcode'];?>
                    </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="item-contact">
                    <i class="fa fa-envelope"></i>
                    <b>Email</b>
                    <!--p>
                        <a href=""><?php echo $contacts['contact_email1'];?></a>
                    </p-->
                    <p>
                        <a href=""><?php echo $contacts['contact_email2'];?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <span class="section-suptitle text-center">Fill Enquiry</span>
    <h2 class="section-title sep-type-2 text-center">any questions?</h2>
    <p class="section-resume">
        This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
    </p>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-reservation">
                    <form id="email_form" action="" method="post">

                        <!--warning-->
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <!--warning end-->

                        <input type="hidden" name="to_email" value="<?php echo $contacts['query_email1'];?>"/>
                        <div class="column">
									<span>
										<input type="text" name="name" id="name" placeholder="Name" class="required-field">
									</span>
                            <span>
										<input type="text" name="email" id="email" placeholder="Email Adress" class="required-field">
									</span>
                        </div>
                        <div class="column">
									<span>
										<input type="text" name="subject" id="subject" placeholder="Subject" class="required-field">
									</span>
                            <span>
										<input type="text" name="phone" id="phone" placeholder="Your Phone" class="required-field">
									</span>
                        </div>
                        <div class="column">
                            <textarea name="message" id="message" placeholder="Message" class="required-field"></textarea>
                        </div>
                        <p class="text-center padd-top-30">
                            <button type="button" class="btn-food" id="send_email_button">Send</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section Contact -->

<?php require_once "view/base/customer/pre_footer.php"?>

<?php require_once "view/base/customer/footer.php"?>


<script>
    function initMap() {
        var uluru = {lat: 51.526437, lng: -0.0376224};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHfiOQo1pIMv1u7y6lSRh-ktUjmHzpyS8&callback=initMap">
</script>

<script>

    $(function () {
        $('#send_email_button').click(function (ev) {
            ev.preventDefault();
            if ($(this).hasClass('disabled')) {
                return;
            }
            $(this).addClass('disabled');
            var btn = $(this);

            var validate = '';

            var email = $('#email').val();
            var message = $('#message').val();

            if (email.trim('') == '') {
                validate += 'email is required</br>';
            }
            if (email.trim('') != '') {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailReg.test(email)){
                    validate += 'email is not valid</br>';
                }
            }
            if (message.trim('') == '') {
                validate += 'message is required';
            }

            if (validate != '') {
                btn.removeClass('disabled');
                $('.alert-success').hide();
                $('.alert-danger').show();
                $('.alert-danger').html(validate);
                $('html, body').animate({scrollTop: $(".form-reservation").offset().top-100}, 300);
                setTimeout(function () {
                    $('.alert-danger').hide();
                }, 3000);
                return;
            }

            var form = $(this).parents('form:first');
            var formData = new FormData( form[0]);
            $.ajax({
                url: "<?php echo BASE_URL?>/send-email",
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

                        $('#email_form')[0].reset();

                        setTimeout(function () {
                            $('.alert-success').hide();
                            //window.location.href="<?php echo BASE_URL?>/admin/delivery-collection";
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
