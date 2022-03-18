<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller{

	public $sms_username;
	public $sms_password;
	public $char_limit;
	public $footer;

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form','url','text'));

        $this->sms_username = "sms";
		$this->sms_password = "admin";
		$this->char_limit = 160;
        $this->footer = "To reply, type {username} [space] your message and send to ".SMS_SHORT_CODE_ALL;
    }

    public function outbox(){
    	$return_status = "success";
    	$return_message = "Your message will be sent shortly.";
    	$applicant_id = "59";
    	$recipient = substr("9151913096", -10);
    	$message = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
    	//$message = "this is a short string.";
    	//$message = "Kim Ki-taek (Song Kang-ho), an unemployed driver, lives with his wife Choong-sook (Jang Hye-jin), son Ki-woo (Choi Woo-shik) and daughter Ki-jeong (Park So-Dam) in a shabby semi-basement apartment. The family struggles to make ends meet by working low-paying gigs. One day Ki-woo's friend Min-hyuk (Park Seo-joon) visits the family. As he plans to study abroad, Min-Hyuk suggests Ki-woo takes over his job as an English tutor for a wealthy family, which Ki-woo accepts.";

    	if(trim($message) <> ''){
    		if(is_numeric($recipient)){
	    		if(isset($_SESSION['rs_user']['username'])){
	    			/*ADD FOOTER AT END OF MESSAGE*/
	    			$footer = str_replace("{username}", $_SESSION['rs_user']['username'], $this->footer);
	    			$message .= " ".$footer;
	    		}

		    	/*LIMIT STRING CHARACTERS*/
		    	$string =  str_split($message, $this->char_limit);

		    	$n = 1;
		    	foreach($string as $v){
		    		$part_no = $n."/".count($string);

		    		if(dbsetdata("insert into applicant_sms_outbox (applicant_id, sender, recipient, message, part_no, add_date, add_by ) values ({$applicant_id}, '{$_SESSION['rs_user']['username']}', '{$recipient}', '".addslashes($v)."', '{$part_no}', NOW(), '{$_SESSION['rs_user']['username']}')")){
		    			/*SUCCESS*/
		    		}else{
		    			/*ERROR*/
		    			$return_message = "Unable to send message.";
		    			$return_status = "error";
		    			break;
		    		}

		    		$n++;
		    	}
    		}else{
    			$return_message = "Invalid mobile no.";
    			$return_status = "error";
    		}
    	}else{
    		$return_message = "Message cannot be empty.";
    		$return_status = "error";
    	}

    	echo json_encode(array('status'=>$return_status, 'message'=>$return_message));
    }

	/*SEND SMS INSTANTLY*/
    public function send($msg_data = array()){
    	switch(SMS_PROVIDER){
    		case 'local':
		    	$recipient = "09151913096";
		    	$message = urlencode("test sms only ".date("h:i:s a"));
		    	$url = "http://130.105.85.43:8585/sendsms?username={$this->sms_username}&password={$this->sms_password}&phonenumber={$recipient}&message={$message}";
		    	// var_dump($url);
		    	// exit();
		    	// $url = "http://130.105.85.43:8585/sendsms?username=sms&password=admin&phonenumber=09151913096&message=test";

		    	$result = file_get_contents($url);
		    	var_dump($result);
    			break;

			case 'globe':
				$url = SMS_SENDING_URL.$msg_data['token'];

				$data = array(
				    'address'  => $msg_data['mobile_no'],
				    'message'  => $msg_data['message'],
				);

				$options = array(
				    'http' => array(
				        'method'  => 'POST',
				        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				        'content' => http_build_query($data),
				    )
				);

				$context  = stream_context_create( $options );
				if($result = file_get_contents( $url, false, $context )){
					return 1; //SENT
				}else{
					return 2; //RE-SEND
				}
				// var_dump($result);
				// exit();
				// $response = json_decode( $result );
    			break;
    	}
    }

    public function subscription(){
		/*NEW SUBSCRIBER VIA WEB*/
    	if(isset($_GET['code']) && $_GET['code'] <> ''){
			$data = array(
			    'app_id'  => SMS_APP_ID,
			    'app_secret'  => SMS_APP_SECRET,
			    'code' => $_GET['code']
			);

			$options = array(
			    'http' => array(
			        'method'  => 'POST',
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'content' => http_build_query($data),
			    )
			);

			$context  = stream_context_create( $options );
			$result = file_get_contents( SMS_ACC_TOKEN_URL, false, $context );
			$response = json_decode( $result );

			if(isset($response->error)){
				/*ERROR*/
			}else{
				$record = getdata("select * from applicant_sms_subscription where mobile_no = '".$response->subscriber_number."'");
				if(count($record) > 0){
					/*RECORD EXISTS*/
				}else{
					/*GET APPLICANT ID*/
					$applicant_id = "";
					$app = getdata("select * from applicant_general_info where mobile_no = '0".$response->subscriber_number."'");

					if(count($app) > 0){
						$applicant_id = $app[0]['id'];
					}

					/*CREATE RECORD*/
		    		if(dbsetdata("insert into applicant_sms_subscription (applicant_id, mobile_no, token, add_date, add_by ) values ('".$applicant_id."', '".$response->subscriber_number."', '".$response->access_token."', NOW(), 'system')")){
		    		}
				}
			}

			http_response_code(200);
			echo "You are now subscribed to ".COMPANY_LONG_NAME;
    	}else if(isset($_GET['access_token']) && $_GET['access_token'] <> ''){
    		/*NEW SUBSCRIBER VIA SMS*/

			/*GET APPLICANT ID*/
			$applicant_id = "";
			$app = getdata("select * from applicant_general_info where mobile_no = '0".$_GET['subscriber_number']."'");

			if(count($app) > 0){
				$applicant_id = $app[0]['id'];
			}

			/*CREATE RECORD*/
    		if(dbsetdata("insert into applicant_sms_subscription (applicant_id, mobile_no, token, add_date, add_by ) values ('".$applicant_id."', '".$_GET['subscriber_number']."', '".$_GET['access_token']."', NOW(), 'system')")){
    		}
    	}else{
	    	/*SOMEONE UNSUBSCRIBED*/
			if(isset($_POST)){
				$data = json_decode(file_get_contents('php://input'), true);

				/*CHECK IF RECORD EXISTS*/
				$record = getdata("select * from applicant_sms_subscription where mobile_no = '".$data['unsubscribed']['subscriber_number']."' and token = '".$data['unsubscribed']['access_token']."'");

				if(count($record) > 0){
					/*DELETE RECORD*/
					dbsetdata("delete from applicant_sms_subscription where id = '".$record[0]['id']."'");
				}

				return http_response_code(200);
			}
    	}
    }

    public function test(){
    	//SAMPLE POST DATA
    	$data = array(
    		'token' => 'GFd-zeMfxVXXvkPnzNpgEgpmgjr67JTCs40MmrIkvSs',
    		'mobile_no' => '9151913096',
    		'message' => 'testing sms only '.date("Y-m-d h:i:s")
    	);

    	//SEND TO APPLICANT
    	$sms_status = $this->send($data);

    	//SAVE TO OUTBOX
    	//insert into outbox (status) values ({$sms_status});
    }

    public function incoming(){
    	switch(SMS_PROVIDER){
    		case 'globe':
	    	$data = json_decode(file_get_contents('php://input'), true);

	    	foreach($data['inboundSMSMessageList']['inboundSMSMessage'] as $info){
	    		if(trim($info['message']) <> ''){
	    			$mobile_no = substr($info['senderAddress'], -10);

					/*CHECK IF RECORD EXISTS*/
					$record = getdata("select * from applicant_sms_subscription where mobile_no = '".$mobile_no."'");

					if(count($record) > 0){
						$applicant_id = $record[0]['applicant_id'];
					}else{
						/*ANONYMOUS*/
						$applicant_id = 0;
					}

			    	/*CHECK IF MSG IS MULTIPART*/
			    	if($data['inboundSMSMessageList']['numberOfMessagesInThisBatch'] > 1){
			    		$part_no = "(".$info['multipartSeqNum']."/".$data['inboundSMSMessageList']['numberOfMessagesInThisBatch'].") ";
			    	}else{
			    		$part_no = "";
			    	}

					/*CHECK FOR SPECIFIC RECIPIENT*/
					$this_msg = explode(" ", $info['message']);
					$prefix = trim($this_msg[0]);
					$recipient = "";

					if($prefix != ''){
						$user = getdata("select username from settings_users where username = '{$prefix}'");
						if(count($user) > 0){
							$recipient = $user[0]['username'];
						}
					}

					/*INSERT INTO DB*/
					dbsetdata("insert into applicant_sms_inbox (applicant_id, sender, recipient, message, add_date, add_by) values ('".$applicant_id."', '".$mobile_no."', '".$recipient."', '".$part_no.$info['message']."', '".date("Y-m-d h:i:s", strtotime($info['dateTime']))."', 'system')");
	    		}
	    	}

			return http_response_code(200);
			break;
		}
    }
}
