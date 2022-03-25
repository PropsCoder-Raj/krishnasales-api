<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\UserModel;

class Employees extends BaseController
{
	protected $userModel;
	public function __construct(){
		$this->userModel = new UserModel();
	}

	public function index()
	{
	}

	public function get_total_customer_count($id)
	{
		$data = $this->userModel->where('Employee_Id',$id)->countAllResults();
		$ar = array("status"=>"success","message"=>"Customers Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_all_employees(){
		$data = $this->userModel->where('Role',2)->get()->getResultArray();
		$ar = array("status"=>"success","message"=>"Employee Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_employees_count()
	{
		$data = $this->userModel->where('Role',2)->countAllResults();
		$ar = array("status"=>"success","message"=>"Employee Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_total_employees_active_count()
	{
		$data = $this->userModel->where('Role',2)->where('Is_Active',1)->countAllResults();
		$ar = array("status"=>"success","message"=>"Employee Data","data"=>$data);
		echo json_encode($ar);
	}

	public function delete_employee($id){
		$this->userModel->delete($id);
		$ar = array("status"=>"success","message"=>"Employee Deleted");
		echo json_encode($ar);
	}

	public function get_employee($id = null){
		$data = $this->userModel->find($id);
		$ar = array("status"=>"success","message"=>"Single Employee Data","data"=>$data);
		echo json_encode($ar);
	}
	
	public function create_employee(){
			$item = [
				'Name' => $this->request->getPost('Name'),
				'Email' => $this->request->getPost('Email'),
				'Mobile' => $this->request->getPost('Mobile'),
				'Designation' => $this->request->getPost('Designation'),
				'Password' => $this->request->getPost('Password'),
				'Role' => 2,
			];

			if($this->userModel->insert($item)){
				$ar = array("status"=>"success","message"=>"Employee Created");
				echo json_encode($ar);
			} else{
				$ar = array("status"=>"error","message"=>"Emoloyee Not Created");
				echo json_encode($ar);
			}
			
	}

	public function update_employee($id){
		$item = [
			'Name' => $this->request->getPost('Name'),
			'Email' => $this->request->getPost('Email'),
			'Mobile' => $this->request->getPost('Mobile'),
			'Designation' => $this->request->getPost('Designation'),
			'Password' => $this->request->getPost('Password'),
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

