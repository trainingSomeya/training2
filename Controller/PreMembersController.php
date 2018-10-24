<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class PreMembersController extends AppController {

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
		if ($this->request->is('post')) {
			$mail=$this->request->data['PreMember']['mail'];
			//すでにあるメールアドレスなら上書き
			if($check=$this->PreMember->find('all',array('fields'=>array('id'), 'conditions'=>array('mail'=>$mail)))){
				$this->request->data['PreMember']['id']=$check[0]['PreMember']['id'];
				$this->request->data['PreMember']['flag']=0;//fragをリセット
			}
			$this->PreMember->create();
			if( $this->PreMember->save( $this->request->data)){
				$urltoken = $this->PreMember->get_token();//urlトークンの作成
				$this->PreMember->set('urltoken', $urltoken);
				$this->PreMember->save();
				$controller = 'users';
				$action = 'add';
				
				//idの暗号化
				//$id_encrypt = $this->PreMember->id_encrypt($this->PreMember->id);				
				
				//idのハッシュ化
				$id_hash = $this->PreMember->getActivationHash();
				$this->PreMember->set('id_hash', $id_hash);
				$this->PreMember->save();
				
				// 本登録用URLの作成
				$url =	DS . $controller;   
				$url =	$url . DS . $action;         
				//$url = 	$url . DS . $id_encrypt;//暗号化id
				$url =  $url . DS . $id_hash;
				$url =	$url . DS . $urltoken;
				$url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与

				//読み込む設定ファイルの変数名を指定
				$email = new CakeEmail('gmail');
				$email->from('someya.training@gmail.com');
				$email->to($this->request->data['PreMember']['mail']);
				$email->subject('登録用URLの送信について');
				if($email->send('登録用のURLです。'."\n".$url)){
				$this->Flash->success(__('I sent an e-mail. Please confirm.'));
				}

			}else{
				$this->Flash->error(__('Failed to send mail. Please send again.'));
			}
		}
		$this->render();
	}

	public function beforeFilter() {
		parent::beforeFilter();
		// ユーザー自身による登録を許可する
		$this->Auth->allow('index');
	}
}
