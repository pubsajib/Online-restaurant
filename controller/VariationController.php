<?php
namespace App\controller;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:28 PM
 */
use App\model\Variation;
use App\model\Product;

require_once 'BaseController.php';
require_once 'model/User.php';
require_once 'model/Customer.php';
require_once 'model/Variation.php';
require_once 'model/Product.php';

class VariationController extends BaseController
{
    public function lists()
    {
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $variationModel = new Variation();
        $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);
        $this->view('admin/variation', $data);
    }

    public function variationDetails()
    {
        $variationId = $_GET['variation_id'];
        //echo $productId; exit();
        $variationModel = new Variation();
        $data = array(
            'variation_id' => $variationId,
        );
        $variation = $variationModel->getWhere($data, [], 'single');
        echo json_encode(['status'=> 200, 'message' => '', 'variation' => $variation]);

        return;
    }

    public function createvariation()
    {
        //echo "<pre>"; var_dump(); echo "</pre>";
        //echo "<pre>"; var_dump($_POST['variation_name']); echo "</pre>";
        //exit();

        //echo $imageName; return;
        $variationModel = new Variation();
        $data = [];


        if (isset($_POST['variation_id'])) {
            $where = ['variation_id' => $_POST['variation_id']];
            $data = array(
                'variation_name' => $_POST['variation_name'],
                'display_order' => $_POST['display_order'],
                'is_active' => true,
            );
            $variationModel->update($data, $where);

            //$data['variations'] = $variationModel->getWhere(['is_active' => 'true']);

            $return = ['status'=> 200, 'message' => 'Successfully Updated!', 'variations' => ''];
        } else {
            foreach ($_POST['variation_name'] as $key=>$item) {
                $data = array(
                    'variation_name' => $item,
                    'display_order' => $_POST['display_order'][$key],
                    'is_active' => true/*$_POST['is_active']*/,
                );
                $variationModel->save($data);
            }


            $data['variations'] = $variationModel->getWhere(['is_active' => 'true']);

            $return = ['status'=> 200, 'message' => 'Successfully Created!', 'variations' => $data['variations']];
        }

        echo json_encode($return);
        exit();
    }

    public function variationDelete()
    {
        $variationModel = new Variation();
        $where = ['variation_id' => $_POST['variation_id']];
        $data = array('is_active' => 'False', );

        $data2 = array(
            // 'is_active' => False,
            'is_active' => 'Delete',
        );

        $variations = '';
        $productModel = new Product();
        //var_dump($where);exit();
        $returnedCat = $variationModel->update($data, $where);
        $returnedProd = $productModel->update($data2, $where);
        if ($returnedCat['status'] == 200 && $returnedProd['status'] == 200) {
            $variations = $variationModel->getWhere(['is_active' => 'true']);
            $return = ['status'=> 200, 'message' => 'Successfully deleted!', 'variations' => $variations];
        } else {
            $return = ['status'=> 500, 'message' => $returnedCat['message'], 'variations' => $variations];
        }

        echo json_encode($return);

        return;
    }
}