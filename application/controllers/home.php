<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Kakou 登录管理控制器
 * 
 * @package     Kakou
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Fire
 *
 */
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
	}

	/* 首页  */
	function index()
	{
		echo 'Hello';
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
?>
