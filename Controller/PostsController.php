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
		$this->layout = 'post';
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

		$this->set('image_num', $this->Post->Image->find('count', array('conditions' => array('Image.post_id' => $this->Post->find('first', $options)['Post']['id']))));

		//var_dump($user);
		//
		//	var_dump($this->Post->find('first', $options));

		/*$post = $this->Post->find('first', $options);

		$fileid	= $this->Image->id;
		$file = $this->Image->filename;
		$image = "{ROOT}image/files/{model}/{field}/" .$fileid. $file;

		if (!file_exists($image)) {
			throw new NotFoundException();
		}
		return new CakeResponse(array('type' => 'image/png', 'body' => readfile($image)));*/

		/* $post = $this->Post->find('first', $options);

		$this->autoRender = false;

		$mime_type = "image/png";
		$file_path = "image/files/image/filename/".$post['Image'][0]['id'].'/'.$post['Image'][0]['filename'];

		$this->response->type($mime_type);
		$this->response->file($file_path);
		//	echo $this->response; */

	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			$img_num = count($this->request->data['Image']);
			for($i=0;$i<=$img_num;$i++){
				if($this->request->data['Image'][$i]['filename']['error']!=0){
					unset($this->request->data['Image'][$i]);
				}
			}
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
			$this->Post->id = $id;
			$img_num = count($this->request->data['Image']);
			for($i=0;$i<=$img_num;$i++){
				if($this->request->data['Image'][$i]['filename']['error']!=0){
					unset($this->request->data['Image'][$i]);
				}
			}
			if ($this->Post->saveall($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}

		// ログインユーザーの情報を取得
		$user = $this->Auth->user();
		$this->set('user', $user);

		$this->set('image_num', $this->Post->Image->find('count', array('conditions' => array('Image.post_id' => $this->Post->find('first', $options)['Post']['id']))));
		$this->set('post', $this->Post->find('first', $options));
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find('list',array('fields'=>array('id','tagname')));
		$this->set(compact('tags'));
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

		//論理削除
		if($this->request->is('delete')||$this->request->is('post')){
			$data = array('id' => $id,'delete_flag' => true);
			$this->Post->save($data);
		}
		//物理削除
		#		if ($this->Post->delete()) {
		#			$this->Flash->success(__('The post has been deleted.'));
		#		} else {
		#			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		#		}
		return $this->redirect(array('action' => 'index'));
	}

	public function jqtest() {

	}

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index', 'view','img_delete');
	}	
	//論理削除対応に変更
	public function image($id = null, $num = 0) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));

		//$post = $this->Post->find('first', $options);
		$image = $this->Post->Image->find('all', array('conditions' => array('Image.post_id' => $this->Post->find('first', $options)['Post']['id'])));

		$this->autoRender = false;

		$mime_type = "image/png";
		//$file_path = "image/files/image/filename/".$post['Image'][$num]['id'].'/'.$post['Image'][$num]['filename'];
		$file_path = "image/files/image/filename/".$image[$num]['Image']['id'].'/'.$image[$num]['Image']['filename'];

		echo $file_path;
		$this->response->type($mime_type);
		$this->response->file($file_path);
		//		echo $this->response;
	}

	public function img_delete(){
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$num = $this->request->data('delete_img_num');
			$post_id = $this->request->data('delete_post_id');
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $post_id));
			$post = $this->Post->find('first', $options);
			$img_options = array('conditions' => array($this->Post->primaryKey => $post['Image'][$num]['id']));
			$result = $this->Post->Image->find('first',$options);

			//論理削除
			$data = array('id' => $post['Image'][$num]['id'],'delete_flag' => true);
			if($this->Post->Image->save($data)){
				return json_encode($post['Image'][$num]['filename']);
			}
			//物理削除
			#	if($this->Post->Image->delete($post['Image'][$num]['id'])){
			#		return json_encode($post['Image'][$num]['filename']);
			#	}
			return json_encode(null);
		}
	}
}



