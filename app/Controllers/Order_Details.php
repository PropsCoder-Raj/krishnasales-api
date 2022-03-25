<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\UserorderModel;
use App\Models\OrderModel;

class Order_Details extends BaseController
{
	protected $userorderModel, $orderModel;
	public function __construct(){
		$this->userorderModel = new UserorderModel();
		$this->orderModel = new OrderModel();
	}

	public function index()
	{
	}
	
	public function get_all_user_orders()
	{
		$data = $this->userorderModel->get()->getResultArray();
		$ar = array("status"=>"success","message"=>"User Order Found","data"=>$data);
		echo json_encode($ar);
	}

	public function delete_user_order($id){
		$this->userorderModel->delete($id);
		$ar = array("status"=>"success","message"=>"Delete User Orders","data"=>"Null");
		echo json_encode($ar);
	}

	public function get_user_order($id){
			$data = $this->userorderModel->query("SELECT userOrders.*, item_master.*, item_master.Item_Id AS Item_Uid, userOrders.Discount AS MainDiscount FROM userOrders, item_master WHERE $id = userOrders.Order_Id AND userOrders.Item_Id = item_master.Item_Id;")->getResultArray();
			$ar = array("status"=>"success","message"=>"User Data","data"=>$data);
			echo json_encode($ar);
	}
	
	public function create_user_order(){
			$item = [
				'Order_Id' => $this->request->getPost('Order_Id'),
				'Item_Id' => $this->request->getPost('Item_Id'),
                'Qty' => $this->request->getPost('Qty'),
                'Price' => $this->request->getPost('Price'),
                'Discount' => $this->request->getPost('Discount'),
                'Vat' => $this->request->getPost('Vat'),
			];
			if($this->userorderModel->insert($item)){
				$ar = array("status"=>"success","message"=>"User Orders Created");
				echo json_encode($ar);
			} else{
				$ar = array("status"=>"error","message"=>"User Orders Not Created");
				echo json_encode($ar);
			}
	}

	public function update_user_order($id){
		$item = [
            'Order_Id' => $this->request->getPost('Order_Id'),
				'Item_Id' => $this->request->getPost('Item_Id'),
                'Qty' => $this->request->getPost('Qty'),
                'Price' => $this->request->getPost('Price'),
                'Discount' => $this->request->getPost('Discount'),
                'Vat' => $this->request->getPost('Vat'),
        ];
		if($this->userorderModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"User Orders Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Data Not Updated");
			echo json_encode($ar);
		}
	}

	public function showUserOrder($id = null){
		$data = $this->userorderModel->find($id);
		if($data){
			$ar = array("status"=>"success","message"=>"User Found","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"No User Found");
			echo json_encode($ar);
		}
	}
}

