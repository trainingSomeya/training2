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
		return Security::hash( $this->field('modified'), 'sha256', true);
	}*/
	
	public function getActivationHash() {
		// ユーザIDの有無確認
		if (!isset($this->id)) {
			return false;
		}
		// idをハッシュ化
		return Security::hash( $this->field('id'), 'sha256', true);
	}

	//32バイトのトークンを作成
	public function get_token() {
		$TOKEN_LENGTH = 16;//16*2=32バイト
		$bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
		return bin2hex($bytes);//16進数に変換
	}
	
	//暗号化
	public function id_encrypt($id){
		return bin2hex(openssl_encrypt($id,'aes-256-ecb',ID_KEY));//記号が含まれないように16進数に変換
	}
	//復号
	public function id_decrypt($id_encrypt){
		return openssl_decrypt(hex2bin($id_encrypt),'aes-256-ecb',ID_KEY);//16進数から元に戻す
	}
}
