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

        $offerModel         = new Offer();
        $productModel       = new Product();
        $categoryModel      = new Category();
        $variationModel     = new Variation();
        $subProductModel    = new SubProduct();

        $validProducts      = [];
        $invalidProducts    = [];

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
            if ( $data['sub_products'] ) {
                foreach ( $data['sub_products'] as $product ) {
                    $invalidProducts[] = $product->product_id;
                    $product->product_id = $product->product_id.'_'.$product->sub_product_id;
                    $product->name = $product->product_name.'( '.$product->name.' )';
                    $data['allProducts'][] = $product;
                }
            }
            $invalidProducts = array_unique($invalidProducts);
            if ( $data['products'] ) {
                foreach ($data['products'] as $product) {
                    if (!in_array($product->product_id, $invalidProducts)) $data['allProducts'][] = $product;
                }
            }
        }
        $data['extraProducts'] = $this->AllExtraProductLists($invalidProducts);
        // echo "<pre>"; print_r($data['sub_products']); echo "</pre>"; exit();
        $this->view('admin/products', $data);
    }

    public function productDetails()
    {
        $productId = $_GET['product_id'];
        //echo $productId; exit();
        $productModel           = new Product();
        $productOfferModel      = new ProductOffer();
        $productExtraModel      = new ProductExtra();
        $productVariationModel  = new ProductVariation();
        $productBundleModel     = new ProductBundle();

        $data = ['product_id' => $productId];
        $product = $productModel->getWhere($data, [], 'single');
        $activeData = ['product_id' => $productId, 'is_active'=>'Active'];

        // Offers
        $product->offers = [];
        $product->offers = $productOfferModel->getWhere($activeData, ['offered_product_id', 'quantity']); 

        // Extras
        $extraData = '';
        $extras = $productExtraModel->getWhere($activeData, ['extra_product_id']);
        if ( $extras ) {
            $counter = 0; 
            foreach ( $extras as $extra ) {
                $extra = explode('_', $extra->extra_product_id);
                if ($extra) {
                    $extraData[$counter]['product_id'] = $extra[0];
                    if ( isset($extra[1]) ) $extraData[$counter]['sub_product_id'] = @$extra[1];
                    else $extraData[$counter]['sub_product_id'] = '';
                }
                $counter++;
            }
        }
        $product->extras = $extraData;

        // Variations
        $product->variations = [];
        $variations = $productVariationModel->getWhere($data, ['variation_id']);
        if ( $variations ) {
            foreach ( $variations as $variation ) {
                $product->variations[] = $variation->variation_id;
            }
        }

        // Bundles
        $product->bundles = [];
        $product->bundles = $productBundleModel->getWhere($activeData, ['bundle_product_id', 'number_of_each_step', 'order_of_step']); 

        echo json_encode(['status'=> 200, 'message' => '', 'product' => $product]);

        return;
    }

    public function createProduct() {
        $productModel           = new Product();
        $productOfferModel      = new ProductOffer();
        $productExtraModel      = new ProductExtra();
        $productVariationModel  = new ProductVariation();
        $productBundleModel     = new ProductBundle();
        $date                   = new \DateTime();
        $data = array(
            'category_id' => $_POST['category_id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            //'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
            'display_order' => trim($_POST['display_order']) != '' ? trim($_POST['display_order']) : 0,
            'is_active' => true/*$_POST['is_active']*/,
            'created_at' => $date->format('Y-m-d h:i:s'),
        );
        if ( isset($_POST['isExtra']) && trim($_POST['isExtra']) == 'True' ) $data['is_extra'] = $_POST['isExtra'];
        else { $data['is_extra'] = "False"; }
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
            $productId = $_POST['product_id'];
            $where = ['product_id' => $_POST['product_id']];
            $productModel->update($data, $where);
            $data['products'] = $productModel->getProductsWithCategory();
            $deactiveData = ['is_active'=>'Inactive'];

            // Update offers data
            $productOfferModel->update($deactiveData, $where);
            if ( isset($_POST['offers']) && !empty($_POST['offers']) ) {
                $offersChecked = $_POST['offersChecked'];
                $offersQuantity = $_POST['offersQuantity'];
                foreach ($offersChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductOffer = [];
                        $ProductOffer['product_id'] = $productId;
                        $ProductOffer['offered_product_id'] = $value;
                        $ProductOffer['quantity'] = $offersQuantity[$key];
                        $productOfferModel->save($ProductOffer);
                    }
                }
            }

            // Update extra data
            $productExtraModel->update($deactiveData, $where);
            if ( isset($_POST['extras']) && !empty($_POST['extras']) ) {
                $productExtraModel = new ProductExtra();
                foreach ($_POST['extras'] as $value) {
                    $ProductOffer = [];
                    $ProductOffer['product_id'] = $productId;
                    $ProductOffer['extra_product_id'] = $value;
                    $productExtraModel->save($ProductOffer);
                }
            }

            // Update variations data
            $deleteWhere = ['product_id' => $productId];
            $productVariationModel->delete($deleteWhere);
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $productId;
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            // Update bundles data
            $productBundleModel->update($deactiveData, $where);
            if ( isset($_POST['bundles']) && !empty($_POST['bundles']) ) {
                $bundlesChecked         = $_POST['bundlesChecked'];
                $bundleOrderOfStep      = $_POST['bundleOrderOfStep'];
                $bundleNumberOfEachStep = $_POST['bundleNumberOfEachStep'];
                foreach ($bundlesChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductBundle = [];
                        $ProductBundle['product_id'] = $productId;
                        $ProductBundle['bundle_product_id'] = $value;
                        $ProductBundle['number_of_each_step'] = $bundleNumberOfEachStep[$key];
                        $ProductBundle['order_of_step'] = $bundleOrderOfStep[$key];
                        $productBundleModel->save($ProductBundle);
                    }
                }
            }

            $return = ['status'=> 200, 'message' => 'Successfully Updated!', 'products' => $data['products']];
        } else {
            // Create new product
            $productModel->save($data);
            $data['productID'] = (int) $productModel->getLastInsertedId();
            // Insert offers data
            if ( isset($_POST['offers']) && !empty($_POST['offers']) ) {
                $offersChecked = $_POST['offersChecked'];
                $offersQuantity = $_POST['offersQuantity'];
                foreach ($offersChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductOffer = [];
                        $ProductOffer['product_id'] = $data['productID'];
                        $ProductOffer['offered_product_id'] = $value;
                        $ProductOffer['quantity'] = $offersQuantity;
                        $productOfferModel->save($ProductOffer);
                    }
                }
            }

            // Insert extra data
            if ( isset($_POST['extras']) && !empty($_POST['extras']) ) {
                foreach ($_POST['extras'] as $value) {
                    $ProductOffer = [];
                    $ProductOffer['product_id'] = $data['productID'];
                    $ProductOffer['extra_product_id'] = $value;
                    $productExtraModel->save($ProductOffer);
                }
            }

            // Insert variations data
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $data['productID'];
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            // Insert bundles data
            if ( isset($_POST['bundles']) && !empty($_POST['bundles']) ) {
                $bundlesChecked         = $_POST['bundlesChecked'];
                $bundleOrderOfStep      = $_POST['bundleOrderOfStep'];
                $bundleNumberOfEachStep = $_POST['bundleNumberOfEachStep'];
                foreach ($bundlesChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductBundle = [];
                        $ProductBundle['product_id'] = $data['productID'];
                        $ProductBundle['bundle_product_id'] = $value;
                        $ProductBundle['number_of_each_step'] = $bundleNumberOfEachStep[$key];
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

        $validProducts      = [];
        $invalidProducts    = [];

        $data['products'] = $productModel->getProductsWithCategory();
        $data['sub_products'] = $subProductModel->getSubProductsWithProduct();
        $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);
        
        $joinTables = [['tableName' => 'variations', 'constraintKey' => 'variation_id']];
        foreach ($data['sub_products'] as $subProduct) {
            $where = ['product_id'=>$subProduct->product_id.'_'.$subProduct->sub_product_id];
            $variations = $productVariationModel->getJoinedData($joinTables, $where);
            $variationNames = '';
            $variationIds = [];
            if ( $variations ) {
                $counter = 0;
                foreach ($variations as $variation) {
                    $variationIds[$counter]['variation_id'] = $variation->variation_id;
                    $variationIds[$counter]['variation_name'] = $variation->variation_name;
                    $variationNames .= $variation->variation_name .', ';
                    $counter++;
                }
            }
            $subProduct->variations = $variationIds;
            $subProduct->variationNames = rtrim( $variationNames, ', ');
        }

        // Making single array for all products and subproducts
        if ( $data['products'] || $data['sub_products'] ) {
            if ( $data['sub_products'] ) {
                foreach ( $data['sub_products'] as $product ) {
                    $invalidProducts[] = $product->product_id;
                    $product->product_id = $product->product_id.'_'.$product->sub_product_id;
                    $product->subProduct_name = $product->name;
                    $product->name = $product->product_name.'( '.$product->name.' )';
                    $data['allProducts'][] = $product;
                }
            }
            $invalidProducts = array_unique($invalidProducts);
            if ( $data['products'] ) {
                foreach ($data['products'] as $product) {
                    if (!in_array($product->product_id, $invalidProducts)) $data['allProducts'][] = $product;
                }
            }
        }
        $data['extraProducts'] = $this->AllExtraProductLists($invalidProducts);
        // echo "<pre>". print_r($data['allProducts'], true) ."</pre>"; exit();
        $this->view('admin/sub_products', $data);
    }

    public function subProductDetails() {
        $productId = $_GET['product_id'];
        //echo $productId; exit();
        $subProductModel = new SubProduct();
        $productVariationModel  = new ProductVariation();
        $productOfferModel      = new ProductOffer();
        $productExtraModel      = new ProductExtra();
        $productBundleModel     = new ProductBundle();
        $data = ['sub_product_id' => $productId];
        $subProduct = $subProductModel->getWhere($data, [], 'single');
        $activeData = ['product_id' => $subProduct->product_id.'_'.$subProduct->sub_product_id, 'is_active'=>'Active'];

        $variationNames = '';
        $variationIds = [];
        $joinTables = [['tableName' => 'variations', 'constraintKey' => 'variation_id']];
        $where = ['product_id'=>$subProduct->product_id.'_'.$subProduct->sub_product_id];
        $variations = $productVariationModel->getJoinedData($joinTables, $where);
        if ( $variations ) {
            foreach ($variations as $variation) {
                $variationIds[] = $variation->variation_id;
                $variationNames .= $variation->variation_name .', ';
            }
        }
        $subProduct->variations = $variationIds;
        $subProduct->variationNames = rtrim( $variationNames, ', ');


        // Offers
        $subProduct->offers = [];
        $subProduct->offers = $productOfferModel->getWhere($activeData, ['offered_product_id', 'quantity']);

        // Extras
        $extraData = '';
        $extras = $productExtraModel->getWhere($activeData, ['extra_product_id']);
        if ( $extras ) {
            $counter = 0;
            foreach ( $extras as $extra ) {
                $extra = explode('_', $extra->extra_product_id);
                if ($extra) {
                    $extraData[$counter]['product_id'] = $extra[0];
                    if ( isset($extra[1]) ) $extraData[$counter]['sub_product_id'] = @$extra[1];
                    else $extraData[$counter]['sub_product_id'] = '';
                }
                $counter++;
            }
        }
        $subProduct->extras = $extraData;

        // Bundles
        $subProduct->bundles = [];
        $subProduct->bundles = $productBundleModel->getWhere($activeData, ['bundle_product_id', 'number_of_each_step', 'order_of_step']);



        //echo "<pre>"; print_r($subProduct); echo "</pre>"; die();

        echo json_encode(['status'=> 200, 'message' => '', 'product' => $subProduct]);

        return;
    }

    public function createSubProduct() {
        $subProductModel        = new SubProduct();
        $variationModel         = new Variation();
        $productOfferModel      = new ProductOffer();
        $productExtraModel      = new ProductExtra();
        $productBundleModel     = new ProductBundle();
        $productVariationModel  = new ProductVariation();
        $date                   = new \DateTime();

        $product_id = isset($_POST['product_id']) && !empty(trim($_POST['product_id']))? $_POST['product_id']: 1;
        $data = array(
            'product_id' => $_POST['product_id'],
            'name' => $_POST['name'],
            //'description' => $_POST['description'],
            //'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
            'display_order' => trim($_POST['display_order']) != '' ? trim($_POST['display_order']) : 0,
            'created_at' => $date->format('Y-m-d h:i:s'),
        );
        if ( isset($_POST['isExtra']) && trim($_POST['isExtra']) == 'True' ) { $data['is_extra'] = $_POST['isExtra']; }
        else { $data['is_extra'] = "False"; }
        
        if (isset($_POST['sub_product_id'])) {
            //echo "<pre>"; print_r($data); echo "</pre>"; exit();
            $subProductId = $_POST['sub_product_id'];
            $where = ['sub_product_id' => $_POST['sub_product_id']];
            $subProductModel->update($data, $where);
            $deactiveData = ['is_active'=>'Inactive'];

            $customWhere = ['product_id' => $product_id.'_'.$subProductId];
            $productVariationModel->delete($customWhere);
            // Update variations data
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $product_id.'_'.$subProductId;
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            // Update offers data
            $productOfferModel->update($deactiveData, $customWhere);
            if ( isset($_POST['offers']) && !empty($_POST['offers']) ) {
                $offersChecked = $_POST['offersChecked'];
                $offersQuantity = $_POST['offersQuantity'];
                foreach ($offersChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductOffer = [];
                        $ProductOffer['product_id'] = $product_id.'_'.$subProductId;
                        $ProductOffer['offered_product_id'] = $value;
                        $ProductOffer['quantity'] = $offersQuantity;
                        $productOfferModel->save($ProductOffer);
                    }
                }
            }

            // Update extra data
            $productExtraModel->update($deactiveData, $customWhere);
            if ( isset($_POST['extras']) && !empty($_POST['extras']) ) {
                $productExtraModel = new ProductExtra();
                foreach ($_POST['extras'] as $value) {
                    $ProductOffer = [];
                    $ProductOffer['product_id'] = $product_id.'_'.$subProductId;
                    $ProductOffer['extra_product_id'] = $value;
                    $productExtraModel->save($ProductOffer);
                }
            }

            // Update bundles data
            $productBundleModel->update($deactiveData, $customWhere);
            if ( isset($_POST['bundles']) && !empty($_POST['bundles']) ) {
                $bundlesChecked         = $_POST['bundlesChecked'];
                $bundleOrderOfStep      = $_POST['bundleOrderOfStep'];
                $bundleNumberOfEachStep = $_POST['bundleNumberOfEachStep'];
                foreach ($bundlesChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductBundle = [];
                        $ProductBundle['product_id'] = $product_id.'_'.$subProductId;
                        $ProductBundle['bundle_product_id'] = $value;
                        $ProductBundle['number_of_each_step'] = $bundleNumberOfEachStep[$key];
                        $ProductBundle['order_of_step'] = $bundleOrderOfStep[$key];
                        $productBundleModel->save($ProductBundle);
                    }
                }
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
            $subProductId = (int) $subProductModel->getLastInsertedId();
            $productID_subProductID = $product_id.'_'.$subProductId;

            // Insert offers data
            if ( isset($_POST['offers']) && !empty($_POST['offers']) ) {
                $offersChecked = $_POST['offersChecked'];
                $offersQuantity = $_POST['offersQuantity'];
                foreach ($offersChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductOffer = [];
                        $ProductOffer['product_id'] = $productID_subProductID;
                        $ProductOffer['offered_product_id'] = $value;
                        $ProductOffer['quantity'] = $offersQuantity;
                        $productOfferModel->save($ProductOffer);
                    }
                }
            }

            // Insert extra data
            if ( isset($_POST['extras']) && !empty($_POST['extras']) ) {
                foreach ($_POST['extras'] as $value) {
                    $ProductOffer = [];
                    $ProductOffer['product_id'] = $productID_subProductID;
                    $ProductOffer['extra_product_id'] = $value;
                    $productExtraModel->save($ProductOffer);
                }
            }

            // Insert variations data
            if ( isset($_POST['variations']) && !empty($_POST['variations']) ) {
                foreach ($_POST['variations'] as $value) {   
                    $ProductVariations = [];
                    $ProductVariations['product_id'] = $productID_subProductID;
                    $ProductVariations['variation_id'] = $value;
                    $productVariationModel->save($ProductVariations);
                }
            }

            // Insert bundles data
            if ( isset($_POST['bundles']) && !empty($_POST['bundles']) ) {
                $bundlesChecked         = $_POST['bundlesChecked'];
                $bundleOrderOfStep      = $_POST['bundleOrderOfStep'];
                $bundleNumberOfEachStep = $_POST['bundleNumberOfEachStep'];
                foreach ($bundlesChecked as $key => $value) {
                    if ( $value != 0 ) {
                        $ProductBundle = [];
                        $ProductBundle['product_id'] = $productID_subProductID;
                        $ProductBundle['bundle_product_id'] = $value;
                        $ProductBundle['number_of_each_step'] = $bundleNumberOfEachStep[$key];
                        $ProductBundle['order_of_step'] = $bundleOrderOfStep[$key];
                        $productBundleModel->save($ProductBundle);
                    }
                }
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
        $offer_array = $_POST['offer_array'];
        if ($_POST['productId']) {
            $productOfferModel = new ProductOffer();
            $offers = $productOfferModel->getProductRealtedOffers($_POST['productId']);
            $MaxOffer = $productOfferModel->getRaw('select max(quantity) as quantity from product_offer where product_offer.product_id = "'.$_POST['productId'].'" AND is_active = "Active"');
            if (!$offers) { echo 404; exit(); }
            // $data = ['product_id' => 5];
            // $product = $productModel->getWhere($data, [], 'single');
            // echo json_encode($product);
            $totalPrice = 0;
            $html = '';
            foreach ($offers as $key => $offer) {
                $offer_products = $offer->offered_product_id;
                $op_explode = explode('_',$offer_products);
                if(count($op_explode)==1){
                    $productModel = new Product();
                    $data = ['product_id' => $op_explode[0]];
                    $product = $productModel->getWhere($data, [], 'single');
                    $totalPrice += $product->price;
                    $html .= '<li class="offers add" id="'.$product->product_id.'" class="offeredProductContainer"><div class="row">';
                    $html .= '<div class="col-sm-7 col-xs-12"> <p><strong>'. $product->name .'</strong></p> </div>';
                    // $html .= '<div class="col-sm-5 col-xs-12"> <p class="offer-list-des">Ignored by shahin vai 21071108.</p> </div>';
                    $html .= '</div> </li>';
                }
                else{
                    $productModel = new Product();
                    $subProductModel = new SubProduct();
                    $productData = ['product_id' => $op_explode[0]];
                    $product = $productModel->getWhere($productData, [], 'single');
                    $subProductData = ['sub_product_id' => $op_explode[1]];
                    $subProduct = $subProductModel->getWhere($subProductData, [], 'single');
                    $totalPrice += $product->price;
                    $html .= '<li class="offers add" id="'.$subProduct->product_id.'_'.$subProduct->sub_product_id.'" class="offeredProductContainer"><div class="row">';
                    $html .= '<div class="col-sm-7 col-xs-12"> <p><strong>'. $product->name.'('. $subProduct->name .')</strong></p> </div>';
                    // $html .= '<div class="col-sm-5 col-xs-12"> <p class="offer-list-des">Ignored by shahin vai 21071108.</p> </div>';
                    $html .= '</div> </li>';
                }
            }
            //include 'http://localhost/online_restaurant/view/customer/productContentModal.php';
            //echo ['max_offer'=>$MaxOffer[0]->quantity,'html'=>$html];
            echo json_encode(['max_offer'=>$MaxOffer[0]->quantity,'html'=>$html]);
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
    public function AllExtraProductLists($invalidProducts=[])
    {
        if (!$this->isAdminLoggedIn()) { $this->redirect('admin/login'); }

        $data[] = [];
        $productModel = new Product();
        $subProductModel = new SubProduct();
        $categoryModel = new Category();
        if ($invalidProducts) {
            $sql = "SELECT * FROM `products` WHERE `is_extra` = 'True' AND `product_id` NOT IN (". implode(',', $invalidProducts) .")";
            $data = $productModel->getRaw($sql);
        } else {
            $data = $productModel->getWhere(['is_extra'=>'True']);  
        }
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
}
