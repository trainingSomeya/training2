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
		$this->PreMember->create();
		if( $this->PreMember->save( $this->request->data)){
			$hash = $this->PreMember->getActivationHash(); //ハッシュ値
			$this->PreMember->set('urltoken', $hash);
			$this->PreMember->save();
			// ユーザアクティベート(本登録)用URLの作成
			$url =
				DS . 'users' .          // コントローラ
				DS . 'add'.             // アクション
				DS . $this->PreMember->id     .  //仮ユーザーのID
				DS . $hash;
			$url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与

				//読み込む設定ファイルの変数名を指定
				$email = new CakeEmail('gmail');
				$email->from('someya.training@gmail.com');
				$email->to($this->request->data['PreMember']['mail']);
				//メール送信する
				$email->send($url); 
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
