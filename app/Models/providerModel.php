<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'providers';
	protected $primaryKey           = 'Provider_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['User_Id', 'Category_Id','Description'];
	
}
