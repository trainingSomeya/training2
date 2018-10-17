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
			if($check=$this->PreMember->find('all',array(
				'fields'=>array('id'),
				'conditions'=>array('mail'=>$mail)
			))){
				//var_dump($check);
				//var_dump($check[0]['PreMember']['id']);
				$this->request->data['PreMember']['id']=$check[0]['PreMember']['id'];
				//var_dump($this->request->data);
			}
			$this->PreMember->create();
			if( $this->PreMember->save( $this->request->data)){
				$hash = $this->PreMember->getActivationHash(); //ハッシュ値
				$this->PreMember->set('urltoken', $hash);
				$this->PreMember->save();
				$controller = 'users';
				$action = 'add'; 
				// 本登録用URLの作成
				$url =
					DS . $controller .    
					DS . $action .         
					DS . $this->PreMember->id     .  //仮ユーザーのID
					DS . $hash;
				$url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与

				//読み込む設定ファイルの変数名を指定
				$email = new CakeEmail('gmail');
				$email->from('someya.training@gmail.com');
				$email->to($this->request->data['PreMember']['mail']);
				$email->subject('Regarding the issue of url for registration');
				//メール送信する
				$email->send('登録用のURLです。'."\n".$url); 
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
