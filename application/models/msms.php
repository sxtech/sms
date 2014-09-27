<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msms extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 添加短信信息
	 */
	function add_sms($data)
	{
		return $this->db->insert('sms', $data);
	}
	
	/**
	 * 锁表
	 */
	function locktable()
	{
		return $this->db->query("LOCK TABLES sms WRITE");
	}

	/**
	 * 解锁
	 */
	function unlocktable()
	{
		return $this->db->query("UNLOCK TABLES");
	}
	
}

/* End of file madmin.php */
/* Location: ./application/models/madmin.php */
?>
