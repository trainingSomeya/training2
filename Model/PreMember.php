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
		/*	array(
				'rule' => 'isUnique', 
				'message' => '入力されたメールアドレスは既に登録されています'
			), */
		),
	);

	public function getActivationHash() {
		// ユーザIDの有無確認
		if (!isset($this->id)) {
			return false;
		}
		// 更新日時をハッシュ化
		return Security::hash( $this->field('modified'), 'md5', true);
	}

}
