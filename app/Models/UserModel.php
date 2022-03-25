<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'User_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"User_Id",
		"Name",
		"Email",
		"Mobile",
		"Role",
		"Designation",
		"Password",
		"Employee_Id",
		"Is_Active",
		"Created_On",
		"Last_Update_On",
		];
	
	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';
	protected $updatedField         = 'Last_Update_On';

}
