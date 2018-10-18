<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class PreMember extends AppModel {

	public $displayField = 'mail';

	public $validate = array(
		'mail' => array(
			array(
				'rule' => 'notBlank', 
				'message' => 'メールアドレスを入力してください'
			), 
			array(
				'rule' => 'email', 
				'message' => '正しいメールアドレスを入力してください'
			), 
		),
	);

	/*public function getActivationHash() {
		// ユーザIDの有無確認
		if (!isset($this->id)) {
			return false;
		}
		// 更新日時をハッシュ化
		return Security::hash( $this->field('modified'), 'md5', true);
	}*/
	
	public function getActivationHash() {
		// ユーザIDの有無確認
		if (!isset($this->id)) {
			return false;
		}
		// idをハッシュ化
		return Security::hash( $this->field('id'), 'md5', true);
	}

	//32バイトのトークンを作成
	function get_token() {
		$TOKEN_LENGTH = 16;//16*2=32バイト
		$bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
		return bin2hex($bytes);//16進数に変換
	}

}
