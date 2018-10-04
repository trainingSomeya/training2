<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator','Search.Prg');
	public $presetVars = true;

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		//categoriesテーブルから種別テーブルリストを取得する
		$this->set('list',$this->Post->Category->find('list',array('fields'=>array('categoryname','categoryname'))));
		//tagsテーブルから種別テーブルリストを取得する
		$this->set('tags',$this->Post->Tag->find('list',array('fields'=>array('tagname','tagname'))));
		//$this->Post->recursive = 0;
		$this->Prg->commonProcess();
		$this->paginate = array('conditions' => $this->Post->parseCriteria($this->passedArgs));
		$this->set('posts', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
		// ログインユーザーの情報を取得
		$user = $this->Auth->user();
		$this->set('user', $user);
		//var_dump($user);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->saveall($this->request->data)) {
				$this->request->data['Post']['user_id'] = $this->Auth->user('id');
		/*	 ob_start();//チェック
				var_dump($this->request->data);
				$result = ob_get_contents();
				ob_end_clean();
				$fp = fopen("./upload/dump.txt", "a+" );
				fputs($fp, $result);
				fclose( $fp );      */

				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}
		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
		$this->set(compact('users'));
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find('list',array('fields'=>array('id','tagname')));
		$this->set(compact('tags'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function jqtest() {

	}

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}	


}
