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
	public $components = array('Paginator','Flash','Search.Prg','Auth');

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
		$id = $this->User->PreMember->find('first',array('fields'=>array('id'),'conditions'=>array('id_hash'=>$id_encrypt)))['PreMember']['id'];//ハッシュ化の場合、引数から検索
		$premembers=$this->User->PreMember->find('first',array('conditions'=>array('id'=>$id)));
		//idが存在しているか、flagが有効であるか、urltokenが有効かで判断
		if($premembers && $premembers['PreMember']['flag'] != 1 && $urltoken==$premembers['PreMember']['urltoken']){
			$this->set('premembers',$premembers);

			if ($this->request->is('post')) {
				$this->User->create();

				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved.'));
					//$this->User->PreMember->delete($premembers['PreMember']['id']);//暗号化を使用している場合は一度使用したurlは削除

					$this->User->PreMember->save(['id'=>$id ,'flag'=>1]);//ハッシュ化を使用している場合はflagを1に
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
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
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
		$this->Auth->allow('add', 'logout');
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
