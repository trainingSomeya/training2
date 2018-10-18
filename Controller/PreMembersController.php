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
	public $components = array('Paginator','Flash','Search.Prg','Auth','Security');

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
			}
			$this->PreMember->create();
			if( $this->PreMember->save( $this->request->data)){
				$urltoken = $this->PreMember->get_token();//urlトークンの作成
				$this->PreMember->set('urltoken', $urltoken);
				$id_hash = $this->PreMember->getActivationHash();//idのハッシュ化
				$this->PreMember->set('id_hash', $id_hash);
				$this->PreMember->save();
				$controller = 'users';
				$action = 'add';

				// 本登録用URLの作成
				$url =
					DS . $controller .    
					DS . $action .         
					DS . $id_hash .
					DS . $urltoken;
				$url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与

				//読み込む設定ファイルの変数名を指定
				$email = new CakeEmail('gmail');
				$email->from('someya.training@gmail.com');
				$email->to($this->request->data['PreMember']['mail']);
				$email->subject('登録用URLの送信について');
				//メール送信する
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
