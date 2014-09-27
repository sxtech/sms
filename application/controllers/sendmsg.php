<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * sendmsg
 * 
 * @package     sendmsg
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Fire
 *
 */

class Sendmsg extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		
		$this->load->model('Msms');
		
		$this->load->config('sms');
		
		#error_reporting(E_ERROR);
				
		#$this->output->enable_profiler(TRUE);
	}
	
	//设备连接测试
	function conn_test()
	{
		//创建OCX类对象
		$dllsms = new COM("szhto.SzhtoDLL") or die("Unable to instanciate Word");
		//打开通讯端口
		$open=$dllsms->YhOpenModem($this->config->item('port'),"9600,N,8,1",$this->config->item('register'));

		//关闭通讯端口
		$dllsms->YhCloseModem();

		echo $open;
	}
	
	//发送短信
	function send_msg()
	{
		$data['tel']     = $this->input->get('tel',TRUE);        //电话
		$data['content'] = iconv("UTF-8", "GBK//IGNORE", $this->input->get('content',TRUE));    //内容
		//创建OCX类对象
		$dllsms = new COM("szhto.SzhtoDLL") or die("Unable to instanciate Word");
		//打开通讯端口
		$open=$dllsms->YhOpenModem($this->config->item('port'),"9600,N,8,1",$this->config->item('register'));

		if (substr($open,0,2) != '-1'){
			$dllsms->Waittime = $this->config->item('waittime');      //等待时间30s
			//返回结果
			$data['result'] = $dllsms->YhSendSms($this->config->item('mytel'),$data['tel'],$data['content'],8);
			if ($data['result'] == '-1'){
				$data['valid'] = 0;
			}else{
				$data['valid'] = 1;
			}
			$data['sendtime'] = mdate("%Y-%m-%d %H:%i:%s");           //发送时间
			
			$res = $this->Msms->add_sms($data);
		}else {
			$data['result'] = '-2';
		}
		//关闭通讯端口
		$dllsms->YhCloseModem();

		echo $data['result'];
	}

}

