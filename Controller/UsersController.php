<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator','Flash','Search.Prg','Auth' => array(
		'authenticate' => array(
			'Form' => array( 
				// 認証されるには、Userのdelete_flagが0
				'scope' => array( 'User.delete_flag' => 0),
                )
			)
		),);
	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add($id_encrypt=null,$urltoken=null) {
		//$id =  $this->User->PreMember->id_decrypt($id_encrypt);//暗号化の場合、復号

		//ハッシュ化の場合、引数から検索
		$id = $this->User->PreMember->find('first',array('fields'=>array('id'),'conditions'=>array('id_hash'=>$id_encrypt)))['PreMember']['id'];
		$premembers=$this->User->PreMember->find('first',array('conditions'=>array('id'=>$id)));
		//idが存在しているか、一度使われていないか、urlのトークンが有効かで判断
		if($premembers && $premembers['PreMember']['flag'] != 1 && $urltoken==$premembers['PreMember']['urltoken']){
			$this->set('premembers',$premembers);

			if ($this->request->is('post')) {
				$this->User->create();

				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved.'));
					//暗号化を使用している場合は一度使用したurlは削除
					//$this->User->PreMember->delete($premembers['PreMember']['id']);
					//ハッシュ化を使用している場合はflagを1に
					$this->User->PreMember->save(['id'=>$id ,'flag'=>1]);
					return $this->redirect(array('controller'=>'users','action' => 'login'));//login画面へ
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}
		}else{
			$this->Flash->error(__('Invalid url. please try again.'));
			return $this->redirect(array('controller'=>'pre_members','action' => 'index'));
		}

		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		
		//論理削除
		if($this->request->is('delete')||$this->request->is('post')){
			$data = array('id' => $id,'delete_flag' => true);
			$this->User->save($data);
		}
		//物理削除
		//if ($this->User->delete()) {
		//	$this->Flash->success(__('The user has been deleted.'));
		//} else {
		//	$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		//}
		return $this->redirect(array('action' => 'index'));
	}

	public function search(){
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$zipcode = "0.".$this->request->data('zipcode');
			$options = array('conditions'=>array('zipcode'=>$zipcode));
			if($result = $this->User->PostalCode->find('all',$options)){
				return json_encode($result);
			}
			return json_encode(null);
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();
		// ユーザー自身による登録とログアウトを許可する
		// 郵便番号検索,dataaddを一時的に許可、後でaclの修正
		$this->Auth->allow('add', 'logout','search','dataadd');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Your username or password was incorrect.'));
		}
	}

	public function logout() {
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}

	/*public function dataadd() {
		$db_user = "root";
		$db_pass = "password";
		$db_host = "localhost";
		$db_name = "blogtest";
		$db_type = "mysql";

		if ($this->request->is(array('post', 'put'))) {
			$table_name = $this->request->data['User']['table_name'];
			$dsn = $this->User->create_dsn($db_type, $db_host, $db_name);

			try{
				$pdo = new PDO($dsn,$db_user,$db_pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
				echo "接続しました。";
			}catch(PDOException $Exception){
				die('error:'.$Exception->getMessage());
			}

			try{
				$pdo->beginTransaction();
				$this->User->create_table($table_name);
				$sql = "INSERT INTO {$table_name} (jiscode, zipcode, state, city, street, changed, cause) VALUES (:jiscode, :zipcode, :state, :city, :street, :changed, :cause)";
				$stmh = $pdo->prepare($sql);

				$row = 1;
				//if (($handle = fopen("../table/KEN_ALL-UTF-SI.CSV", "r")) !== FALSE) {
				if (($handle = fopen("../address_data/18/KEN_ALL-UTF-TEST.CSV", "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$num = count($data);
						if($num != 8){
							break;	
						}
						$params = array(':jiscode' => $data[1], ':zipcode' => $data[2], ':state' => $data[3], ':city' => $data[4], ':street' => $data[5], ':changed' => $data[6], ':cause' => $data[7]);
						// SQLを実行
						$stmh->execute($params);
						$row++;
					}
					fclose($handle);
				}
				$pdo->commit();
				echo "合計".$row."件作成";
			}catch(PDOException $Exception){
				$pdo->rollBack();
				echo "error";
			}
		}

		}*/


/* public function initDB() {
	$group = $this->User->Group;
	//管理者グループには全てを許可する
	$group->id = 1;
	$this->Acl->allow($group, 'controllers');

	//マネージャグループには posts と widgets に対するアクセスを許可する
	$group->id = 2;
	$this->Acl->deny($group, 'controllers');
	$this->Acl->allow($group, 'controllers/Posts');
	$this->Acl->allow($group, 'controllers/Widgets');

	//ユーザグループには posts と widgets に対する追加と編集を許可する
	$group->id = 3;
	$this->Acl->deny($group, 'controllers');
	$this->Acl->allow($group, 'controllers/Posts/add');
	$this->Acl->allow($group, 'controllers/Posts/edit');
	$this->Acl->allow($group, 'controllers/Widgets/add');
	$this->Acl->allow($group, 'controllers/Widgets/edit');
	//馬鹿げた「ビューが見つからない」というエラーメッセージを表示させないために exit を追加します
	echo "all done";
	exit;
} */

}
