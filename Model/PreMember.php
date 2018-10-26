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
		//idの値が単純なためHMAC方式を使用
		$id_hash = hash_hmac ('sha256' , $this->field('id'), ID_KEY);
		//衝突を避けるために同じハッシュ値にならないようにダブルハッシュする
		while($check = $this->find('all',array('fields'=>array('id'),'conditions'=>array('id_hash'=>$id_hash)))){
			//上書き登録かどうかを確認
			if($this->field('id') != $check[0]['PreMember']['id']){
				$id_hash = Security::hash( $id_hash, 'sha256', true);
			}else{
				break;
			}
		}
		return $id_hash;
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

	//トランザクション//
	function begin() {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$db->begin($this);
	}

	function commit() {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$db->commit($this);
	}

	function rollback() {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$db->rollback($this);
	}
	////
	
	//テーブルロック
	function Lock($type="WRITE"){
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$q = "LOCK TABLE {$this->useTable} {$type};";
		return $this->query($q);
	}
	function UnLock(){
		return $this->query("UNLOCK TABLES");
	}
}
