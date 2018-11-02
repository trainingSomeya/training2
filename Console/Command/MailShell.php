<?php
App::uses('CakeEmail','Network/Email');
class MailShell extends AppShell{
	public function main(){
		$tomail = $this->args[0];
		$url = $this->args[1];
		//テンプレートの文章に代入する変数
		$ary_vars = array (
			'url' => $url
		);
		$email = new CakeEmail('gmail');
		$email->template('my_template', 'my_layout');
		$email->viewVars($ary_vars);
		$email->emailFormat('text');
		$email->from('someya.training@gmail.com');
		$email->to($tomail);
		$email->subject('登録用URLの送信について');
		if($email->send()){
			$this->log("send to " .$tomail .", status: success",MAIL_LOG);
		}else{
			$this->log("send to " .$tomail .", status: error",MAIL_LOG);
		}
	}
}
?>
