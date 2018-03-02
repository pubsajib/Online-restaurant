<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 4:26 PM
 */

$route = array(
    'register' => array(
        'AuthenticationController',
        'register',
        'get',
    ),
    'admin/login' => array(
        'AuthenticationController',
        'adminLogin',
        'get',
    ),
    'admin/logout' => array(
        'AuthenticationController',
        'adminLogout',
        'get',
    ),
    'admin-login' => array(
        'AuthenticationController',
        'checkAdminLogin',
        'post',
    ),
    'create-admin' => array(
        'AuthenticationController',
        'createAdmin',
        'post',
    ),
    //customer register
    'customer-register' => array(
        'AuthenticationController',
        'customerRegister',
        'get',
    ),
    'create-customer' => array(
        'AuthenticationController',
        'createCustomer',
        'post',
    ),
    //customer login
    'login' => array(
        'AuthenticationController',
        'customerLogin',
        'get',
    ),
    'customer-login' => array(
        'AuthenticationController',
        'checkCustomerLogin',
        'post',
    ),
    'logout' => array(
        'AuthenticationController',
        'customerLogout',
        'get',
    ),

    //admin section
    'admin' => array(
        'HomeController',
        'index',
        'get',
    ),
    //product crud
    'admin/products' => array(
        'ProductController',
        'lists',
        'get',
    ),
    'admin/create-product' => array(
        'ProductController',
        'createProduct',
        'post',
    ),
    'admin/product-offers' => array(
        'ProductController',
        'productOffers',
        'post',
    ),
    'admin/product-extras' => array(
        'ProductController',
        'productExtras',
        'post',
    ),
    'admin/product-details' => array(
        'ProductController',
        'productDetails',
        'get',
    ),
    'admin/product-delete' => array(
        'ProductController',
        'productDelete',
        'post',
    ),
    'admin/activate-product' => array(
        'ProductController',
        'activateProduct',
        'post',
    ),
    //sub product crud
    'admin/sub_products' => array(
        'ProductController',
        'subProductLists',
        'get',
    ),
    
    'admin/create-sub_products' => array(
        'ProductController',
        'createSubProduct',
        'post',
    ),
    'admin/sub_product-details' => array(
        'ProductController',
        'subProductDetails',
        'get',
    ),
    'admin/sub_product-delete' => array(
        'ProductController',
        'subProductDelete',
        'post',
    ),
    //offer crud
    'admin/create-product-offer' => array(
        'ProductController',
        'createProductOffer',
        'post',
    ),
    'admin/activate-offer' => array(
        'ProductController',
        'activateOffer',
        'post',
    ),
    //category product
    'admin/category' => array(
        'CategoryController',
        'lists',
        'get',
    ),
    'admin/create-category' => array(
        'CategoryController',
        'createCategory',
        'post',
    ),
    'admin/category-details' => array(
        'CategoryController',
        'categoryDetails',
        'get',
    ),
    'admin/category-delete' => array(
        'CategoryController',
        'categoryDelete',
        'post',
    ),
	//settings route
	'admin/opening-closing-time' => array(
        'SettingsController',
        'openingClosingTime',
        'get',
    ),
	/*'admin/delivery-charge' => array(
        'SettingsController',
        'deliveryCharge',
        'get',
    ),*/
	/*'admin/delivery-minimum' => array(
        'SettingsController',
        'deliveryMinimum',
        'get',
    ),*/
    'admin/delivery-and-collection' => array(
        'SettingsController',
        'deliveryAndCollection',
        'get',
    ),
    /*'admin/payment-option' => array(
        'SettingsController',
        'paymentOption',
        'get',
    ),*/
    'admin/banner-info' => array(
        'SettingsController',
        'bannerInfo',
        'get',
    ),
    'admin/delivery-time' => array(
        'SettingsController',
        'deliveryTime',
        'get',
    ),
    //postcode
    'admin/post-code' => array(
        'PostcodeController',
        'postcode',
        'get',
    ),
    'admin/create-postcode' => array(
        'PostcodeController',
        'createPostcode',
        'post',
    ),
    'admin/postcode-delete' => array(
        'PostcodeController',
        'deletePostcode',
        'post',
    ),
    

    //Delivery charge
    /*
     * Commented by 14010303
     * */
    'admin/delivery-charge' => array(
        'DeliveryChargeController',
        'deliveryCharge',
        'get',
    ),
    'admin/create-delivery-charge' => array(
        'DeliveryChargeController',
        'createDeliveryCharge',
        'post',
    ),
    'admin/delivery-charge-delete' => array(
        'DeliveryChargeController',
        'deleteDeliveryCharge',
        'post',
    ),

    //Delivery minimum
    /*
     * Commented by 14010303
     * */
    'admin/delivery-minimum' => array(
        'DeliveryChargeController',
        'deliveryMinimum',
        'get',
    ),
    'admin/create-delivery-minimum' => array(
        'DeliveryChargeController',
        'createDeliveryMinimum',
        'post',
    ),
    'admin/delivery-minimum-delete' => array(
        'DeliveryChargeController',
        'deleteDeliveryMinimum',
        'post',
    ),

    //Delivery Collection
    /*
     * Commented by 14010303
     * */
    'admin/delivery-collection' => array(
        'DeliveryCollectionController',
        'deliveryCollection',
        'get',
    ),
    'admin/create-delivery-collection' => array(
        'DeliveryCollectionController',
        'createDeliveryCollection',
        'post',
    ),


    //Payment Option
    /*
     * Commented by 14010303
     * */
    'admin/payment-option' => array(
        'PaymentOptionController',
        'paymentOption',
        'get',
    ),
    'admin/create-payment-option' => array(
        'PaymentOptionController',
        'createPaymentOption',
        'post',
    ),

    //Estimated delivery time
    /*
     * Commented by 14010303
     * */
    'admin/estimated-delivery-time' => array(
        'DeliveryTimeController',
        'deliveryTime',
        'get',
    ),
    'admin/create-delivery-time' => array(
        'DeliveryTimeController',
        'createDeliveryTime',
        'post',
    ),
    'admin/delivery-time-delete' => array(
        'DeliveryTimeController',
        'deleteDeliveryMinimum',
        'post',
    ),

    //Opening hour
    /*
     * Commented by 14010303
     * */
    'admin/opening-hour' => array(
        'OpeningHourController',
        'openingHour',
        'get',
    ),
    'admin/update-opening-hour' => array(
        'OpeningHourController',
        'updateOpeningHour',
        'post',
    ),
    //admin customer info
    /*
     * Commented by 14010303
     * */
    'admin/customer-info' => array(
        'CustomerController',
        'customerInfo',
        'get',
    ),
    //admin about-us
    'admin/about-us' => array(
        'AboutUsController',
        'index',
        'get',
    ),
    'admin/create-about-us' => array(
        'AboutUsController',
        'createAboutUs',
        'post',
    ),
    //admin contact-us
    'admin/contact-details' => array(
        'ContactUsController',
        'index',
        'get',
    ),
    'admin/create-contact-details' => array(
        'ContactUsController',
        'createContactDetails',
        'post',
    ),
    //admin discount
    'admin/discounts' => array(
        'DiscountController',
        'index',
        'get',
    ),
    'admin/create-discount-details' => array(
        'DiscountController',
        'createDiscountDetails',
        'post',
    ),

    // admin order rport

    'admin/order-report' => array(
        'OrderController',
        'orderReport',
        'get',
    ),

    //admin banner
    'admin/banner' => array(
        'BannerController',
        'index',
        'get',
    ),
    'admin/create-banner-details' => array(
        'BannerController',
        'createBannerDetails',
        'post',
    ),

    //customer routes
    '/' => array(
        'CustomerController',
        'index',
        'get',
    ),
    'order' => array(
        'CustomerController',
        'order',
        'get',
    ),
    'order-history' => array(
        'OrderController',
        'orderHistory',
        'get',
    ),
    'order/send-order-history-model-body' => array(
        'OrderController',
        'sendOrderHistoryModelBody',
        'get',
    ),
    'order/order.php' => array(
        'OrderController',
        'orderInfo',
        'get',
    ),
    'order/order_callback.php' => array(
        'OrderController',
        'orderCallback',
        'get',
    ),
    'order/check-product-offers' => array(
        'OrderController',
        'checkProductOffers',
        'post',
    ),
    'order/get-offer-type' => array(
        'OrderController',
        'getOfferTypes',
        'post',
    ),
    'order/get-product-bundle' => array(
        'OrderController',
        'getProductBundle',
        'post',
    ),
    'order/get-offer-extra' => array(
        'OrderController',
        'getOfferExtra',
        'post',
    ),
    'order/get-product-extra' => array(
        'OrderController',
        'getProductExtra',
        'post',
    ),
    'contact-us' => array(
        'CustomerController',
        'contactUs',
        'get',
    ),
    'send-email' => array(
        'CustomerController',
        'sendContactEmail',
        'post',
    ),
    'about-us' => array(
        'CustomerController',
        'aboutUs',
        'get',
    ),
    'checkout' => array(
        'CustomerController',
        'checkOut',
        'post',
    ),
    'add-to-cart' => array(
        'CustomerController',
        'addToCart',
        'post',
    ),
    'remove-from-cart' => array(
        'CustomerController',
        'removeFromCart',
        'post',
    ),
    'place-order' => array(
        'CustomerController',
        'placeOrder',
        'post',
    ),
    'paypal-return' => array(
        'CustomerController',
        'paypalReturn',
        'get',
    ),
    'delivery-address' => array(
        'CustomerController',
        'deliveryAddress',
        'post',
    ),
    'messages' => array(
        'CustomerController',
        'messages',
        'get',
    ),
    'cart' => array(
        'CartController',
        'index',
        'get',
    ),
    'profile' => array(
        'CustomerController',
        'profile',
        'get',
    ),
    'change-password' => array(
        'CustomerController',
        'changeCustomerPassword',
        'get',
    ),
    'update-password' => array(
        'CustomerController',
        'updateCustomerPassword',
        'post',
    ),
    'change-address' => array(
        'CustomerController',
        'changeCustomerAddrss',
        'get',
    ),
    'update-address' => array(
        'CustomerController',
        'updateCustomerAddrss',
        'post',
    ),
    'update-customer-address' => array(
        'CustomerController',
        'updateCustomerAddrss',
        'get',
    ),
    'get-address-by-postcode' => array(
        'CustomerController',
        'getAddressByPostcode',
        'post',
    ),
    'check-time-availability' => array(
        'CustomerController',
        'checkAvailableOpeningTime',
        'post',
    ),
    'forget-password' => array(
        'CustomerController',
        'forgetPassword',
        'get',
    ),
    'post-forget-password' => array(
        'CustomerController',
        'postForgetPassword',
        'post',
    ),
    'reset-password' => array(
        'CustomerController',
        'resetPassword',
        'get',
    ),
    'post-reset-password' => array(
        'CustomerController',
        'postResetPassword',
        'post',
    ),
    'common-error-message' => array(
        'CustomerController',
        'commonErrorMessage',
        'get',
    ),
    //variation product
    'admin/variation' => array(
        'VariationController',
        'lists',
        'get',
    ),
    'admin/create-variation' => array(
        'VariationController',
        'createvariation',
        'post',
    ),
    'admin/variation-details' => array(
        'VariationController',
        'variationDetails',
        'get',
    ),
    'admin/variation-delete' => array(
        'VariationController',
        'variationDelete',
        'post',
    ),

);
