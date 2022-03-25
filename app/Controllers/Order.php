<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\OrderModel;

class Order extends BaseController
{
	protected $orderModel;
	public function __construct(){
		$this->orderModel = new OrderModel();
	}

	public function index()
	{
	}

	public function get_all_orders(){
		$data = $this->orderModel->query("SELECT orders.*, a.*, DATE_FORMAT(Order_Date, '%d %M %Y') As Order_Date_Format, b.Name AS EmpName FROM  orders, users a, users b WHERE a.Employee_Id = b.User_Id AND a.User_Id = orders.Customer_Id ORDER BY Order_Date DESC;")->getResultArray();
		$ar = array("status"=>"success","message"=>"Orders Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_user_latest_seven_days_order($id){
		if(!empty($id)){
			$data = $this->orderModel->query("SELECT orders.*, a.*, DATE_FORMAT(Order_Date, '%d %M %Y') As Order_Date_Format, b.Name AS EmpName FROM  orders, users a, users b WHERE a.Employee_Id = b.User_Id AND a.User_Id = orders.Customer_Id AND orders.Customer_Id = '$id' AND orders.Order_Date >= DATE_ADD(CURDATE(), INTERVAL -7 DAY) ORDER BY Order_Date DESC;")->getResultArray();
			$ar = array("status"=>"success","message"=>"User Data","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}

	public function get_user_order($id){
		if(!empty($id)){
			$data = $this->orderModel->query("SELECT orders.*, a.*, DATE_FORMAT(Order_Date, '%d %M %Y') As Order_Date_Format, b.Name AS EmpName FROM  orders, users a, users b WHERE a.Employee_Id = b.User_Id AND a.User_Id = orders.Customer_Id AND orders.Customer_Id = '$id' ORDER BY Order_Date DESC;")->getResultArray();
			$ar = array("status"=>"success","message"=>"User Data","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}

	public function get_total_orders_count(){
		$data = $this->orderModel->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_pending_count(){
		$data = $this->orderModel->where('Status',0)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_confirm_count(){
		$data = $this->orderModel->where('Status',1)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_Cancel_count(){
		$data = $this->orderModel->where('Status',2)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}



	public function get_total_orders_count_from_user($id){
		$data = $this->orderModel->where('Customer_Id',$id)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_pending_count_from_user($id){
		$data = $this->orderModel->where('Status',0)->where('Customer_Id',$id)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_confirm_count_from_user($id){
		$data = $this->orderModel->where('Status',1)->where('Customer_Id',$id)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_Cancel_count_from_user($id){
		$data = $this->orderModel->where('Status',2)->where('Customer_Id',$id)->countAllResults();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}





	public function get_total_orders_count_from_employee($id){
		$data = $this->orderModel->query("SELECT orders.*, users.*, DATE_FORMAT(Order_Date, '%d %M %Y') As Order_Date_Format FROM  orders, users WHERE users.Employee_Id = $id AND users.User_Id = orders.Customer_Id ORDER BY Order_Date DESC;")->getResultArray();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_pending_count_from_employee($id){
		$data = $this->orderModel->query("SELECT orders.*, b.* FROM  orders, users b WHERE b.Employee_Id = $id AND b.User_Id = orders.Customer_Id AND orders.Status = '0'")->getResultArray();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_confirm_count_from_employee($id){
		$data = $this->orderModel->query("SELECT orders.*, b.* FROM  orders, users b WHERE b.Employee_Id = $id AND b.User_Id = orders.Customer_Id AND orders.Status = '1'")->getResultArray();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_orders_Cancel_count_from_employee($id){
		$data = $this->orderModel->query("SELECT orders.*, b.* FROM  orders, users b WHERE b.Employee_Id = $id AND b.User_Id = orders.Customer_Id AND orders.Status = '2'")->getResultArray();
		$ar = array("status"=>"success","message"=>"Order Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_user_latest_seven_days_order_employee($id){
		if(!empty($id)){
			$data = $this->orderModel->query("SELECT orders.*, users.*, DATE_FORMAT(Order_Date, '%d %M %Y') As Order_Date_Format FROM  orders, users WHERE users.Employee_Id = $id AND users.User_Id = orders.Customer_Id AND orders.Order_Date >= DATE_ADD(CURDATE(), INTERVAL -7 DAY) ORDER BY Order_Date DESC;")->getResultArray();
			$ar = array("status"=>"success","message"=>"User Data","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}



	public function delete_order($id){
		$this->orderModel->delete($id);
		$ar = array("status"=>"success","message"=>"Delete Order","data"=>"Null");
		echo json_encode($ar);
	}
	
	public function create_order(){
			$item = [
				'Unique_Id' => $this->request->getPost('Unique_Id'),
				'Customer_Id' => $this->request->getPost('Customer_Id'),
				'Amount' => $this->request->getPost('Amount'),
				'Remark' => $this->request->getPost('Remark'),
			];

			if($this->orderModel->insert($item)){
				$ar = array("status"=>"success","message"=>"Orders Created");
				echo json_encode($ar);
			} else{
				$ar = array("status"=>"error","message"=>"Orders Not Created");
				echo json_encode($ar);
			}
	}

	public function update_order($id){
		$item = [
			'Unique_Id' => $this->request->getPost('Unique_Id'),
			'Customer_Id' => $this->request->getPost('Customer_Id'),
			'Amount' => $this->request->getPost('Amount'),
		];
		if($this->orderModel->update($id,$item)){
			$ar = array("status"=>"error","message"=>"Order Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Data Not Updated");
			echo json_encode($ar);
		}
	}

	public function update_order_status($id){
		$item = [
			'Status' => $this->request->getPost('Status'),
		];
		if($this->orderModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"Order Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Data Not Updated");
			echo json_encode($ar);
		}
	}

	public function showUserOrder($id = null){
		$data = $this->orderModel->find($id);
		if($data){
			$ar = array("status"=>"success","message"=>"Order Found","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"No User Found");
			echo json_encode($ar);
		}
	}
}

