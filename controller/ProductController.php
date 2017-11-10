<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:28 PM
 */

namespace App\controller;
use App\model\Category;
use App\model\Offer;
use App\model\Product;
use App\model\ProductOffer;
use App\model\ProductExtra;
use App\model\SubProduct;
use App\model\Variation;
use App\model\ProductVariation;
use App\model\ProductBundle;

class ProductController extends BaseController
{
    public function lists()
    {
        if (!$this->isAdminLoggedIn()) { $this->redirect('admin/login'); }

        $offerModel     = new Offer();
        $productModel   = new Product();
        $categoryModel  = new Category();
        $variationModel = new Variation();
        $subProductModel = new SubProduct();

        $data['products'] = $productModel->getProductsWithCategory();
        $joinTables = [['tableName' => 'products', 'constraintKey' => 'product_id']];
        $offers = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id where products.is_active != "Delete"');
        $data['offers'] = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id where products.is_active != "Delete" and offer.is_active = "Active"');
        if ( $data['products']  ) {
            foreach ($data['products'] as $product) {
                $product->offer = null;
                if (!empty($offers)) {
                    foreach ($offers as $offer) {
                        if ($product->product_id == $offer->product_id) {
                            $product->offer = $offer;
                            //echo "<pre>"; print_r($offer); echo "</pre>";exit();
                        }
                    }
                }
            }
        }
        //echo "<pre>"; print_r($data['products']); echo "</pre>";exit();
        $data['categories'] = $categoryModel->getWhere(['is_active' => 'true']);
        $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);
        $data['sub_products'] = $subProductModel->getSubProductsWithProduct();

        // Making single array for all products and subproducts
        if ( $data['products'] || $data['sub_products'] ) {
            if ( $data['products'] ) {
                foreach ($data['products'] as $product) {
                    $data['allProducts'][] = $product;
                }
            }
            if ( $data['sub_products'] ) {
                foreach ( $data['sub_products'] as $product ) {
                    $product->product_id = $product->product_id.'_'.$product->sub_product_id;
                    $data['allProducts'][] = $product;
                }
            }
        }
        $data['extraProducts'] = $this->AllExtraProductLists();
        // echo "<pre>"; print_r($data['extraProducts']); echo "</pre>"; exit();
        $this->view('admin/products', $data);
    }

    public function productDetails()
    {
        $productId = $_GET['product_id'];
        //echo $productId; exit();
        $productModel = new Product();
        $data = array(
            'product_id' => $productId,
        );
        $product = $productModel->getWhere($data, [], 'single');
        echo json_encode(['status'=> 200, 'message' => '', 'product' => $product]);

        return;
    }

    public function createProduct() {
        $productModel = new Product();
        $date = new \DateTime();
        $data = array(
            'category_id' => $_POST['category_id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            //'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
            'display_order' => $_POST['display_order'],
            'is_active' => true/*$_POST['is_active']*/,
            'created_at' => $date->format('Y-m-d h:i:s'),
        );
        if ( isset($_POST['isExtra']) && !empty($_POST['isExtra']) ) { $data['is_extra'] = 'True'; }
        if (!empty($_FILES['image_name']['name'])) {
            $image = $_FILES['image_name'];
            $targetDir = BASE_DIR.'/assets/img/products/';
            $uploadImage = $this->uploadImageFile($image, $targetDir);
            if ($uploadImage['status'] == 200) {
                $imageName = $uploadImage['originalName'];
            } else {
                echo json_encode(['status'=> 500, 'message' => $uploadImage['message']]);
                return;
            }
            $data['image_name'] = $imageName;
        }

        if (isset($_POST['product_id'])) {
            // Update existing product
            $where = ['product_id' => $_POST['product_id']];
            $productModel->update($data, $where);
            $data['products'] = $productModel->getProductsWithCategory();

            $return = ['status'=> 200, 'message' => 'Successfully Updated!', 'products' => $data['products']];
        } else {
            // Create new product
            $productModel->save($data);
            $data['productID'] = (int) $productModel->getLastInsertedId();
            // Insert offers data
            if ( isset($_POST['offers']) && !empty($_POST['offers']) ) {
                $productOfferModel = new ProductOffer();
                $offersChecked = $_POST['offersChecked'];
                $offersQuantity = $_POST['offersQuantity'];
                foreach ($offersChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductOffer = [];
                        $ProductOffer['product_id'] = $data['productID'];
                        $ProductOffer['offered_product_id'] = $value;
                        $ProductOffer['quantity'] = $offersQuantity[$key];
                        $productOfferModel->save($ProductOffer);
                    }
                }
            }

            // Insert extra data
            if ( isset($_POST['extras']) && !empty($_POST['extras']) ) {
                $productExtraModel = new ProductExtra();
                foreach ($_POST['extras'] as $value) {
                    $ProductOffer = [];
                    $ProductOffer['product_id'] = $data['productID'];
                    $ProductOffer['extra_product_id'] = $value;
                    $productExtraModel->save($ProductOffer);
                }
            }

            // Insert variations data
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                $productVariationModel = new ProductVariation();
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $data['productID'];
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            // Insert bundles data
            if ( isset($_POST['bundles']) && !empty($_POST['bundles']) ) {
                $productBundleModel     = new ProductBundle();
                $bundlesChecked         = $_POST['bundlesChecked'];
                $bundleOrderOfStep      = $_POST['bundleOrderOfStep'];
                $bundleNumberOfEachStep = $_POST['bundleNumberOfEachStep'];
                foreach ($bundlesChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductBundle = [];
                        $ProductBundle['product_id'] = $data['productID'];
                        $ProductBundle['bundle_product_id'] = $value;
                        $ProductBundle['number_of_each_step'] = $bundleOrderOfStep[$key];
                        $ProductBundle['order_of_step'] = $bundleOrderOfStep[$key];
                        $productBundleModel->save($ProductBundle);
                    }
                }
            }

            $data['products'] = $productModel->getProductsWithCategory();

            $offerModel = new Offer();
            $offers = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id');
            foreach ($data['products'] as $product) {
                $product->offer = null;
                foreach ($offers as $offer) {
                    if ($product->product_id == $offer->product_id) {
                        $product->offer = $offer;
                    }
                }
            }
            $return = ['status'=> 200, 'message' => 'Successfully Created', 'products' => $data['products']];
        }
        echo json_encode($return);
        exit();
    }

    public function productDelete()
    {
        $productModel = new Product();
        $where = ['product_id' => $_POST['product_id']];
        $data = array(
            //'is_active' => false,
            'is_active' => 'Delete',
        );
        $products = '';
        //var_dump($where);exit();
        $returnedData = $productModel->update($data, $where);
        $offerModel = new Offer();
        $offerModel->update(['is_active' => 'Inactive'], ['product_id' => $_POST['product_id']]);
        if ($returnedData['status'] == 200) {
            $products = $productModel->getProductsWithCategory();

            $offerModel = new Offer();
            $offers = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id');
            foreach ($products as $product) {
                $product->offer = null;
                foreach ($offers as $offer) {
                    if ($product->product_id == $offer->product_id) {
                        $product->offer = $offer;
                        //echo "<pre>"; print_r($offer); echo "</pre>";exit();
                    }
                }
            }
            $return = ['status'=> 200, 'message' => 'Successfully deleted', 'products' => $products];
        } else {
            $return = ['status'=> 500, 'message' => $returnedData['message'], 'products' => $products];
        }

        echo json_encode($return);

        return;
    }

    public function createProductOffer()
    {
        //echo "<pre>";print_r($_POST); echo "</pre>";exit();
        $data = array(
            'product_id' => $_POST['product_id'],
            'offer_price' => $_POST['offer_price'],
            'offer_description' => $_POST['offer_description'],
            'is_active' => 'Inactive',
        );
        $offerModel = new Offer();
        if (isset($_POST['offer_id']) && $_POST['offer_id'] != '') {
            $where = ['offer_id' => $_POST['offer_id']];
            $returnData = $offerModel->update($data, $where);
            $data['offer_id'] = $_POST['offer_id'];
        } else {
            $returnData = $offerModel->save($data);
            if ($returnData['status'] == 200) {
                $data['offer_id'] = $offerModel->getLastInsertedId();
            }
        }

        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => 'Successfully saved', 'data' => $data]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Internal server error, please try again']);
        }

        exit();
    }

    public function activateOffer()
    {
        //echo "<pre>";print_r($_POST); echo "</pre>";exit();
        if ($_POST['is_active'] == 'true') {
            $isActive = 'Active';
            $msg = 'Offer is successfully Activated';
        } else {
            $isActive = 'Inactive';
            $msg = 'Offer is successfully Deactivated';
        }
        $data = array(
            'is_active' => $isActive,
        );
        //echo "<pre>";print_r($_POST['offer_id']); echo "</pre>";exit();
        if (isset($_POST['offer_id']) && $_POST['offer_id'] != '') {
            $offerModel = new Offer();
            //print_r(count($offers));exit();
            $offer = $offerModel->getWhere(['offer_id' => $_POST['offer_id']], [], 'single');
            $productModel = new Product();
            $product = $productModel->getWhere(['product_id' => $offer->product_id], [], 'single');
            if ($product->is_active != 'True') {
                echo json_encode(['status' => 500, 'message' => 'The product is not active']);
                exit();
            }

            $returnData = $offerModel->update($data, ['offer_id' => $_POST['offer_id']]);
            if ($returnData['status'] == 200) {
                $offers = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id where products.is_active != "Delete" and offer.is_active = "Active"');
                $offerNumber = count($offers);
                echo json_encode(['status' => 200, 'message' => $msg, 'offerNumber' => $offerNumber]);
            } else {
                echo json_encode(['status' => 500, 'message' => 'Internal server error!']);
            }
        } else {
            echo json_encode(['status' => 500, 'message' => 'Offer is not been set yet for this product']);
        }

        exit();
    }

    public function activateProduct()
    {
        //echo "<pre>";print_r($_POST); echo "</pre>";exit();
        $deactivateOffer = false;
        $data2 = array();
        if ($_POST['is_active'] == 'true') {
            $isActive = 'True';
            $msg = 'Product is successfully Activated';
        } else {
            $isActive = 'False';
            $msg = 'Product is successfully Deactivated';
            $deactivateOffer = true;
            $data2 = array(
                'is_active' => 'Inactive',
            );
        }
        $data = array(
            'is_active' => $isActive,
        );
        //echo "<pre>";print_r($data); echo "</pre>";exit();

        if (isset($_POST['product_id']) && $_POST['product_id'] != '') {
            $productModel = new Product();
            $offerModel = new Offer();
            $returnData = $productModel->update($data, ['product_id' => $_POST['product_id']]);
            if ($deactivateOffer) {
                $returnOfferData = $offerModel->update($data2, ['product_id' => $_POST['product_id']]);
            }
            if ($returnData['status'] == 200) {
                /*$products = $productModel->getProductsWithCategory();

                $offerModel = new Offer();
                $offers = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id');
                foreach ($products as $product) {
                    $product->offer = null;
                    foreach ($offers as $offer) {
                        if ($product->product_id == $offer->product_id) {
                            $product->offer = $offer;
                            //echo "<pre>"; print_r($offer); echo "</pre>";exit();
                        }
                    }
                }*/
                echo json_encode(['status' => 200, 'message' => $msg, 'deactivateOffer' => $deactivateOffer]);
            } else {
                echo json_encode(['status' => 500, 'message' => 'Internal server error!']);
            }
        } else {
            echo json_encode(['status' => 500, 'message' => 'No product Id found']);
        }

        exit();
    }

    /*#########################################################################################################*/
    /*######################################### Sub product section ###########################################*/
    /*#########################################################################################################*/

    public function subProductLists()
    {
        if (!$this->isAdminLoggedIn()) { $this->redirect('admin/login'); }

        $productModel = new Product();
        $subProductModel = new SubProduct();
        $categoryModel = new Category();
        $variationModel = new Variation();
        $productVariationModel  = new ProductVariation();

        $data['products'] = $productModel->getProductsWithCategory();
        $data['sub_products'] = $subProductModel->getSubProductsWithProduct();
        $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);
        
        $joinTables = [['tableName' => 'variations', 'constraintKey' => 'variation_id']];
        foreach ($data['sub_products'] as $subProduct) {
            $where = ['product_id'=>$subProduct->sub_product_id];
            $variations = $productVariationModel->getJoinedData($joinTables, $where);
            $variationNames = '';
            $variationIds = [];
            if ( $variations ) {
                foreach ($variations as $variation) {
                    $variationIds[] = $variation->variation_id;
                    $variationNames .= $variation->variation_name .', ';
                }
            }
            $subProduct->variations = $variationIds;
            $subProduct->variationNames = rtrim( $variationNames, ', ');
        }

        $this->view('admin/sub_products', $data);
    }

    public function subProductDetails() {
        $productId = $_GET['product_id'];
        //echo $productId; exit();
        $subProductModel = new SubProduct();
        $data = array(
            'sub_product_id' => $productId,
        );
        $subProduct = $subProductModel->getWhere($data, [], 'single');
        echo json_encode(['status'=> 200, 'message' => '', 'product' => $subProduct]);

        return;
    }

    public function createSubProduct()
    {
        $subProductModel        = new SubProduct();
        $variationModel         = new Variation();
        $productVariationModel  = new ProductVariation();
        $date                   = new \DateTime();

        $data = array(
            'product_id' => $_POST['product_id'],
            'name' => $_POST['name'],
            //'description' => $_POST['description'],
            //'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
            'display_order' => $_POST['display_order'],
            'created_at' => $date->format('Y-m-d h:i:s'),
        );
        if ( isset($_POST['isExtra']) && !empty($_POST['isExtra']) ) { $data['is_extra'] = 'True'; }
        if (isset($_POST['sub_product_id'])) {
            $subProductId = $_POST['sub_product_id'];
            $where = ['sub_product_id' => $_POST['sub_product_id']];
            $subProductModel->update($data, $where);

            // Update variations data
            if ( isset($_POST['variations']) ) {
                $newNariations = $_POST['variations'];
                $where = ['product_id'=>$subProductId];
                $productVariationModel->deleteData($where);
                
                // if ( !empty($newNariations) ) {
                //     foreach ($newNariations as $value) {   
                //         $ProductVariations = [];
                //         $ProductVariations['product_id'] = $data['subProductID'];
                //         $ProductVariations['variation_id'] = $value;
                //         $productVariationModel->update($ProductVariations, $where);
                //     }
                // }
            }

            // Return data for front end
            $data = [];
            $data['sub_products'] = $subProductModel->getSubProductsWithProduct();
            $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);
            $joinTables = [['tableName' => 'variations', 'constraintKey' => 'variation_id']];
            foreach ($data['sub_products'] as $subProduct) {
                $where = ['product_id'=>$subProduct->sub_product_id];
                $variations = $productVariationModel->getJoinedData($joinTables, $where);
                $variationNames = '';
                $variationIds = [];
                if ( $variations ) {
                    foreach ($variations as $variation) {
                        $variationIds[] = $variation->variation_id;
                        $variationNames .= $variation->variation_name .', ';
                    }
                }
                $subProduct->variations = $variationIds;
                $subProduct->variationNames = rtrim( $variationNames, ', ');
            }
            $return = ['status'=> 200, 'message' => 'Successfully Updated!', 'products' => $data['sub_products']];
        } else {
            $subProductModel->save($data);
            $data['subProductID'] = (int) $subProductModel->getLastInsertedId();

            // Insert variations data
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                $productVariationModel = new ProductVariation();
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $data['subProductID'];
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            $data['sub_products'] = $subProductModel->getSubProductsWithProduct();
            $return = ['status'=> 200, 'message' => 'Successfully Created!', 'products' => $data['sub_products']];
        }

        echo json_encode($return);
        exit();
    }

    public function subProductDelete()
    {
        $subProductModel = new SubProduct();
        $where = ['sub_product_id' => $_POST['product_id']];
        $sub_products = '';
        // var_dump($where);exit();
        $returnedData = $subProductModel->delete($where);
        if ($returnedData['status'] == 200) {
            $sub_products = $subProductModel->getSubProductsWithProduct();
            $return = ['status'=> 200, 'message' => 'Successfully deleted', 'products' => $sub_products];
        } else {
            $return = ['status'=> 500, 'message' => $returnedData['message'], 'products' => $sub_products];
        }

        echo json_encode($return);

        return;
    }

    public function productOffers()
    {
        $productModel = new Product();
        if ($_POST['productId']) {
            $productOfferModel = new ProductOffer();
            $offers = $productOfferModel->getProductRealtedOffers($_POST['productId']);
            if (!$offers) { echo 404; exit(); }
            // $data = ['product_id' => 5];
            // $product = $productModel->getWhere($data, [], 'single');
            // echo json_encode($product);
            $totalPrice = 0;
            $html = '';
            $html .= '<div class="all-offer-list allOfferList">
                        <div class="row offer-list-title">
                            <div class="col-sm-6">
                                <p><strong>Select option</strong></p>
                            </div>    
                            <div class="col-sm-6">
                                <p></p>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="">
                                <ul class="offer-list">';
            foreach ($offers as $key => $offer) {
                $data = ['product_id' => $offer->offered_product_id];
                $product = $productModel->getWhere($data, [], 'single');
                $totalPrice += $product->price;
                $html .= '<li class="offers add" id="'.$product->product_id.'" class="offeredProductContainer"><div class="row">';
                $html .= '<div class="col-sm-7 col-xs-12"> <p><strong>'. $product->name .'</strong></p> </div>';
                // $html .= '<div class="col-sm-5 col-xs-12"> <p class="offer-list-des">Ignored by shahin vai 21071108.</p> </div>';
                $html .= '</div> </li>';
            }

            $html .= '</ul>
                                </div>
                            </div>
                        </div>';
            //include 'http://localhost/online_restaurant/view/customer/productContentModal.php';
            echo $html;
            // echo json_encode($offers[0]);
        } else{
            echo 404;
        }
        exit();
    }
    public function productExtras()
    {
        echo "productExtras";
        exit();
    }
    public function AllExtraProductLists()
    {
        if (!$this->isAdminLoggedIn()) { $this->redirect('admin/login'); }
        $data[] = [];
        $productModel = new Product();
        $subProductModel = new SubProduct();
        $categoryModel = new Category();
        $data = $productModel->getWhere(['is_extra'=>'True']);
        $sub_products = $subProductModel->getWhere(['is_extra'=>'True']);
        if ( $sub_products ) {
            foreach ( $sub_products as $product ) {
                $product->product_id = $product->product_id.'_'.$product->sub_product_id;
                $data[] = $product;
            }
        }
        // echo "<pre>"; print_r($data); echo "</pre>"; exit();
        return $data;
    }
    public function AllProductLists2()
    {
        if (!$this->isAdminLoggedIn()) { $this->redirect('admin/login'); }

        $productModel = new Product();
        $subProductModel = new SubProduct();
        $categoryModel = new Category();
        $data['products'] = $productModel->getProductsWithCategory();
        $data['sub_products'] = $subProductModel->getSubProductsWithProduct();
        return $data;
    }
}