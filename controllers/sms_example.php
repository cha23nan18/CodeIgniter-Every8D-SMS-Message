<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms_Example extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * av8d
     *
     * @return void
     * @author ruru.chen@studybank.com.tw
     **/
    public function index()
    {
    	$this->load->library('smsav8d');

    	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    	echo "<h1>Every8D Text Message</h1>";
    	
    	if ($_POST) {
       
    		$subject = 'Studybank Test';
    		$content = 'test message, 中文訊息測試';
    		$to	 = $this->input->post('mobile');
    		
    		//傳送簡訊
			if($this->smsav8d->send_message($to, $subject, $content)){
				echo "<h3>傳送簡訊成功</h3>";
			}
			else {
				echo "<h3>傳送簡訊失敗，" . $this->smsav8d->get_error_message() . "</h3>";
			}
        }

        echo "<h3>傳送簡訊成功，餘額為：" . $this->smsav8d->get_balance() . "<h3/>";
        echo "<form method='post' accept-charset='utf-8' action='/sms_example/av8d'>";
        echo "<input type='text' name='mobile'>";
        echo "<input type='submit' value='send'>";
        echo "</form>";
    }
}
/* End of file example.php */
/* Location: ./application/controllers/example.php */
