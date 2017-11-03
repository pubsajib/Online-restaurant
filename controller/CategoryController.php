<?php
namespace App\controller;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:28 PM
 */
use App\model\Category;
use App\model\Product;

require_once 'BaseController.php';
require_once 'model/User.php';
require_once 'model/Customer.php';
require_once 'model/Category.php';
require_once 'model/Product.php';

class CategoryController extends BaseController
{
    public function lists()
    {
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $categoryModel = new Category();
        $data['categories'] = $categoryModel->getWhere(['is_active' => 'true']);
        $this->view('admin/category', $data);
    }

    public function categoryDetails()
    {
        $categoryId = $_GET['category_id'];
        //echo $productId; exit();
        $categoryModel = new Category();
        $data = array(
            'category_id' => $categoryId,
        );
        $category = $categoryModel->getWhere($data, [], 'single');
        echo json_encode(['status'=> 200, 'message' => '', 'category' => $category]);

        return;
    }

    public function createCategory()
    {
        //echo "<pre>"; var_dump(); echo "</pre>";
        //echo "<pre>"; var_dump($_POST['category_name']); echo "</pre>";
        //exit();

        //echo $imageName; return;
        $categoryModel = new Category();
        $data = [];


        if (isset($_POST['category_id'])) {
            $where = ['category_id' => $_POST['category_id']];
            $data = array(
                'category_name' => $_POST['category_name'],
                'display_order' => $_POST['display_order'],
                'is_active' => true,
            );
            $categoryModel->update($data, $where);

            //$data['categories'] = $categoryModel->getWhere(['is_active' => 'true']);

            $return = ['status'=> 200, 'message' => 'Successfully Updated!', 'categories' => ''];
        } else {
            foreach ($_POST['category_name'] as $key=>$item) {
                $data = array(
                    'category_name' => $item,
                    'display_order' => $_POST['display_order'][$key],
                    'is_active' => true/*$_POST['is_active']*/,
                );
                $categoryModel->save($data);
            }


            $data['categories'] = $categoryModel->getWhere(['is_active' => 'true']);

            $return = ['status'=> 200, 'message' => 'Successfully Created!', 'categories' => $data['categories']];
        }

        echo json_encode($return);
        exit();
    }

    public function categoryDelete()
    {
        $categoryModel = new Category();
        $where = ['category_id' => $_POST['category_id']];
        $data = array(
            'is_active' => 'False',
        );

        $data2 = array(
            //'is_active' => false,
            'is_active' => 'Delete',
        );

        $categories = '';
        $productModel = new Product();
        //var_dump($where);exit();
        $returnedCat = $categoryModel->update($data, $where);
        $returnedProd = $productModel->update($data2, $where);
        if ($returnedCat['status'] == 200 && $returnedProd['status'] == 200) {
            $categories = $categoryModel->getWhere(['is_active' => 'true']);
            $return = ['status'=> 200, 'message' => 'Successfully deleted!', 'categories' => $categories];
        } else {
            $return = ['status'=> 500, 'message' => $returnedCat['message'], 'categories' => $categories];
        }

        echo json_encode($return);

        return;
    }
}