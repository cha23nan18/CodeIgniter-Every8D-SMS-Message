<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('SMSHttp.php');
/**
 * av8d SMS api 
 *
 * @package default/libraries
 * @author ruru.chen@studybank.com.tw
 **/
class SMSAv8d
{
	/**
	 * api keys
	 *
	 * @var string
	 **/
	private $_username = '';
	private $_password = '';
	
	/**
	 * api data
	 *
	 * @var string
	 **/
	protected $_subject		= '';
	protected $_content 	= '';
	protected $_mobile 		= '';
	protected $_sendTime	= '';
	
	/**
	 * sms api object
	 *
	 * @var object
	 **/
	protected $_sms_api;
	
	/**
	 * __construct
	 *
	 * @return void
	 * @author ruru.chen@studybank.com.tw
	 **/
	function __construct()
	{
		$ci = & get_instance();
        $ci->load->config('sms');
        
    	$this->_username = $ci->config->item("av8d_api_key");
        $this->_password = $ci->config->item("av8d_api_secret");

        $this->_sms_api = new SMSHttp();
	}
	
	/**
	 * send the sms message
	 *
	 * @return bool
	 * @author ruru.chen@studybank.com.tw
	 **/
	public function send_message($to, $subject, $message, $sendtime='')
	{
		$this->_mobile = $to;
		$this->_subject = $subject;
		$this->_content = $message;
		$this->_sendTime = $sendtime;
		
		return $this->_send();
	}
	
	/**
	 * send
	 *
	 * @return bool
	 * @author ruru.chen@studybank.com.tw
	 **/
	private function _send()
	{
		
		return $this->_sms_api->sendSMS($this->_username, $this->_password, $this->_subject, $this->_content, $this->_mobile, $this->_sendTime);
	}
	
	/**
	 * Account - Get Balance
     * Retrieve your current account balance.
	 *
	 * @return float
	 * @author ruru.chen@studybank.com.tw
	 **/
	public function get_balance()
	{
		$_result = $this->_sms_api->getCredit($this->_username, $this->_password);
		
		return $_result 
					? $this->_sms_api->credit
					: FALSE;
	}
	
	/**
	 * get error message
	 *
	 * @return sting
	 * @author ruru.chen@studybank.com.tw
	 **/
	public function get_error_message()
	{
		return $this->_sms_api->processMsg;
	}
		
} // END class SMSAv8d