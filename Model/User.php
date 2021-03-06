<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {

	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
			'emailExists' => array( 'rule' => array('isUnique',array('username','delete_flag'), false), 'message' => '既に登録されています'),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PostalCode',
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $hasOne = array(
		'PreMember'
	);

	public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
          $this->data['User']['password']
        );
        return true;
	}

	public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
	}

	////////動的テーブルの作成テスト////////////
	public function create_table($table_name){
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		$q = "CREATE TABLE if not exists {$table_name}(
			id int(11) unsigned not null auto_increment , 
			jiscode varchar(6) collate utf8_bin not null default '', 
			zipcode decimal(8,7) unsigned not null default 0, 
			state varchar(100) collate utf8_bin not null default '', 
			city varchar(100) collate utf8_bin not null default '', 
			street varchar(100) collate utf8_bin not null default '', 
			changed tinyint(3) unsigned not null default 0, 
			cause tinyint(3) unsigned not null default 0, 
			primary key (id), 
			key zipcode (zipcode))engine=Innodb default character set utf8 collate utf8_bin comment '郵便番号'";
		return $db->query($q);
	}

	public function create_dsn($db_type, $db_host, $db_name){
		$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
		return $dsn;
	}

	//////////////////////

	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}

	//論理削除のため、findの前にフラグが立っているものを検索対象から除外
	public function beforeFind($queryData){
		$queryData['conditions']['delete_flag'] = false;
		return $queryData;
	}
}
