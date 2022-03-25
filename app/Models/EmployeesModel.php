<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'employees';
	protected $primaryKey           = 'Employee_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['Employee_Name', 'Email', 'Mobile', 'Designation', 'Username', 'Password', 'Status'];
	
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';

}
