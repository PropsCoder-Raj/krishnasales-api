<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\UserModel;

class Customers extends BaseController
{
	protected $userModel;
	public function __construct(){
		$this->userModel = new UserModel();
	}
	
	public function index()
	{
	}

	public function get_all_customers()
	{
		$data = $this->userModel->query("SELECT a.*, b.Name AS EmpName FROM users a, users b WHERE a.Employee_Id = b.User_Id AND a.Role = 3;")->getResultArray();
		$ar = array("status"=>"success","message"=>"Customers Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_customers_count()
	{
		$data = $this->userModel->where('Role',3)->countAllResults();
		$ar = array("status"=>"success","message"=>"Customer Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_customers_active_count()
	{
		$data = $this->userModel->where('Role',3)->where('Is_Active',1)->countAllResults();
		$ar = array("status"=>"success","message"=>"Customer Data","data"=>$data);
		echo json_encode($ar);
	}

	public function delete_customer($id){
		$this->userModel->delete($id);
		$ar = array("status"=>"success","message"=>"Customer Deleted");
		echo json_encode($ar);
	}

	public function create_customer(){
		$item = [
			'Name' => $this->request->getPost('Name'),
			'Email' => $this->request->getPost('Email'),
			'Mobile' => $this->request->getPost('Mobile'),
			'Password' => $this->request->getPost('Password'),
			'Employee_Id' => $this->request->getPost('Employee_Id'),
			'Role' => 3
		];

		if($this->userModel->insert($item)){
			$ar = array("status"=>"success","message"=>"Customer Created");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Database Error");
			echo json_encode($ar);
		}
	}

	public function update_customer($id){
		$item = [
			'Name' => $this->request->getPost('Name'),
			'Email' => $this->request->getPost('Email'),
			'Mobile' => $this->request->getPost('Mobile'),
			'Password' => $this->request->getPost('Password'),
			'Employee_Id' => $this->request->getPost('Employee_Id'),
			'Status' => $this->request->getPost('Status')
		];
		if($this->userModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"Data Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Data Not Updated");
			echo json_encode($ar);
		}
	}


}
