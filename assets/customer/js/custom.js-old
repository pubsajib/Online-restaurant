//top nav
$(function() {
    $(window).scroll(function(){
        if($(this).scrollTop() > 50) {
            $('.navbar').addClass('is-sticky');
        }
		if($(this).scrollTop() < 50) {
            $('.navbar').removeClass('is-sticky');
        }
    });
});  

//scroll spy
if ($(window).width() > 768) {
		$(window).on( 'scroll', function(){
		$('.category').each(function(){
			var windowScroll = $(window).scrollTop();
			var elementScroll = $(this).offset().top;
			var distance = elementScroll-windowScroll;

			if(distance<120){
				var id = $(this).attr('id');
				id = '#'+id;
				
				$('.clicker').each(function(){
					var href = $(this).attr('href');
					if(id==href){
						$('.clicker').parent().removeClass('active');
						$(this).parent().addClass('active');
					}
				});
			}
		});
	});
}

/*for login/registration*/
$(function() {
	$('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
			$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
			$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

/*For modal show hide*/
$("#mobileCartToggle").click(function(){
	$("#lab-slide-bottom-popup").toggleClass("in show");
	$('body').toggleClass('scroll-inactive');
});

//xs nav collapse
$('.nav a').click(function() {
  $('.navbar-collapse').collapse('hide');  
});

//recaptcha
$(function() {
	$('#defaultReal').realperson({length: 4});
});

$("#addCloseBtn").click(function(){
	$(this).parent("#showAddress").addClass("hidden");
	$("#findAddress").prop('disabled', false);
});


/*Left menu panel sticky*/
var stickyTop = $('#sticky-row').offset().top-90;
$(window).on( 'scroll', function(){
	if ($(window).scrollTop() >= stickyTop) {
		$('.wrapper-left').addClass("sticky-wrapper-left");
		$('.wrapper-right').addClass("sticky-wrapper-right");
	} else {
		$('.wrapper-left').removeClass("sticky-wrapper-left");
		$('.wrapper-right').removeClass("sticky-wrapper-right");
	}
});

/*Right menu panel sticky*/
var stickyTopRight = $('#sticky-row').offset().top-60;
$(window).on( 'scroll', function(){
	if ($(window).scrollTop() >= stickyTopRight) {
		$('.wrapper-right').addClass("sticky-wrapper-right");
	} else {
		$('.wrapper-right').removeClass("sticky-wrapper-right");
	}
});

/*Click menu to color change*/
$(document).on("click",".clicker",function(){
	$(".wrapper-left li").removeClass("active");
	$(this).parent("li").addClass("active");
});

/*Click menu to hide emptycart*/
$(document).on("click",".ui-order-btn a",function(){
	$(".ui-empty-cart").addClass("hidden");
});


/*Click to call menu*/
$('a.clicker[href^="#"]').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top-100
        }, 1000);
    }
});


/*order increment/decrement*/
$(document).on("click",".amont-td>i",function(){
	$(this).parents(".hobtr").remove();
});

$(document).on("click",".cust-plus-increment",function(){
	var itemNumber=$(this).parent(".spinner").children(".increse-val").val();
	itemNumber=parseInt(itemNumber);

	itemNumber++;
	
	$(this).parents(".custom-spinner").children(".qnt-idn").html(itemNumber);
	$(this).parent(".spinner").children(".increse-val").val(itemNumber);
});

$(document).on("click",".cust-plus-decrement",function(){
	var itemNumber=$(this).parent(".spinner").children(".increse-val").val();
	itemNumber=parseInt(itemNumber);
	
	itemNumber--;
	if(itemNumber==0)
	{
		$(this).parents(".hobtr").remove();
	}
	else{
		$(this).parents(".custom-spinner").children(".qnt-idn").html(itemNumber);
		$(this).parent(".spinner").children(".increse-val").val(itemNumber);
	}
});


/*Offer increment/decrement*/

$(document).on('click','.offer-add',function(){
	$(this).parents('li').find('.extra-collespe-panel').toggleClass('in');
});

$(document).on("click",".offer-plus-increment",function(){
	var itemNumber=$(this).parents(".offer-spiner").find(".increse-val").val();
	var itemVal=$(this).parents(".spinner").find(".product_price").val();
	var itemPVal=$(this).parents(".extra-collespe-panel").find(".extra-price").html();
	var extraPrice=$(this).parents(".modal-content").find("#extra-order-total-amount").html();

	itemNumber=parseInt(itemNumber);
	itemVal=parseInt(itemVal);
	extraPrice=parseInt(extraPrice);

	itemNumber++;
	var itemFinalVal = parseInt(itemVal*itemNumber);
	extraPrice=parseInt(extraPrice+itemVal);

	$(this).parents(".hobtr").find(".qnt-idn").html(itemNumber);
	$(this).parents(".hobtr").find(".increse-val").val(itemNumber);
	$(this).parents(".row").find(".extra-price").html(itemFinalVal);
	$(this).parents(".modal-content").find("#extra-order-total-amount").html(extraPrice);
});

$(document).on('click','.SkipExtra',function(){
	$('#ExtraList').modal('show');
	$('body').css('paddingRight','0');
});


$(document).on("click",".offer-plus-decrement",function(){
	var itemNumber=$(this).parents(".offer-spiner").find(".increse-val").val();
	var itemVal=$(this).parents(".spinner").find(".product_price").val();
	var itemPVal=$(this).parents(".extra-collespe-panel").find(".extra-price").html();
	var extraPrice=$(this).parents(".modal-content").find("#extra-order-total-amount").html();

	itemNumber=parseInt(itemNumber);
	itemVal=parseInt(itemVal);
	extraPrice=parseInt(extraPrice);

	itemNumber--;

	if(itemNumber>=1){
		var itemFinalVal = parseInt(itemPVal-itemVal);
		extraPrice=parseInt(extraPrice-itemVal);

		$(this).parents(".hobtr").find(".qnt-idn").html(itemNumber);
		$(this).parents(".hobtr").find(".increse-val").val(itemNumber);
		$(this).parents(".row").find(".extra-price").html(itemFinalVal);
		$(this).parents(".modal-content").find("#extra-order-total-amount").html(extraPrice);
	}
	else{
		$(this).parents(".hobtr").find(".qnt-idn").html(1);
	}
});

$(document).on('click','.extra-rmv',function(){
	$(this).parents('.extra-collespe-panel').removeClass('in');
});

$(document).on('click','#edit-extra',function(){
	$('#addExtra').modal('show');
	$('body').css('paddingRight','0');
});	

$(document).on('click','#SkipOffers, .offer-close',function(){
	$('#addExtra').modal('show');
	$('body').css('paddingRight','0');
});

$(document).on('click','.addExtraCart',function(){
	$('#offerList').modal('show');
	$('body').css('paddingRight','0');
});

$('#addExtra').on('hidden.bs.modal', function (){
   	$('body').css('paddingRight','0');
 });

//ads offer click to select
// $(document).on('click','.offer-list>li',function(){
// 	$(this).parent('.offer-list').children('li').removeClass('active');
// 	$(this).addClass('active');
// });
//selected offer list
