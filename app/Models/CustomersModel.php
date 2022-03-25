<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'customers';
	protected $primaryKey           = 'Customer_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['Customer_Name', 'Email', 'Mobile', 'Username', 'Password', 'Employee_Name', 'Status'];
	
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';

}
