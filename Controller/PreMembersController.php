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
			if($check=$this->PreMember->find('first',array('fields'=>array('id'), 'conditions'=>array('mail'=>$mail)))){
				$this->request->data['PreMember']['id']=$check[0]['PreMember']['id'];
				$this->request->data['PreMember']['flag']=0;//fragをリセット
			}

			$this->PreMember->begin();//トランザクション処理開始
			$this->PreMember->create();
			try{
				if( $this->PreMember->save( $this->request->data)){

					$urltoken = $this->PreMember->get_token();//urlトークンの作成
					$this->PreMember->set('urltoken', $urltoken);
					$this->PreMember->save();
					$controller = 'users';
					$action = 'add';

					//idの暗号化
					//$id_encrypt = $this->PreMember->id_encrypt($this->PreMember->id);		

					//idのハッシュ化
					$this->PreMember->Lock();
					$id_hash = $this->PreMember->getActivationHash();
					$this->PreMember->set('id_hash', $id_hash);
					if(!$this->PreMember->save()){
						throw new Exception();
					}
					$this->PreMember->UnLock();
					/////

					// 本登録用URLの作成
					$url =	DS . $controller;   
					$url =	$url . DS . $action;         
					//$url = $url . DS . $id_encrypt;//暗号化id
					$url =  $url . DS . $id_hash;
					$url =	$url . DS . $urltoken;
					$url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与

					$tomail = $this->request->data['PreMember']['mail'];
					
					//非同期でのメールの送信(php)
					//exec("nohup php -c '' 'php/mail.php' '$tomail' '$url' > /dev/null &");
					
					//非同期でのメールの送信(cakephp)
					exec("/var/www/blog/app/Console/cake mail $tomail $url > /dev/null &");
					
					$this->Flash->success(__('I sent an e-mail. Please confirm.'));
					$this->PreMember->commit();

					/*
					//テンプレートの文章に代入する変数
					$ary_vars = array (
						'url' => $url
					);
					$email = new CakeEmail('gmail');
					$email->template('my_template', 'my_layout');
					$email->viewVars($ary_vars);
					$email->emailFormat('text');
					$email->from('someya.training@gmail.com');
					$email->to($tomail);
					$email->subject('登録用URLの送信について');	
					
					if($email->send()){
						$this->Flash->success(__('I sent an e-mail. Please confirm.'));
						$this->PreMember->commit();
					}else{
						throw new Exception();
					}
					 */
				}else{
					throw new Exception();
				}

			}catch(Exception $e){
				$this->Flash->error(__('Failed to send mail. Please send again.'));
				//var_dump($this->PreMember->getDataSource()->getLog());
				$this->PreMember->UnLock();
				$this->PreMember->rollback();
			}

		}
		$this->render();
	}

	public function beforeFilter() {
		parent::beforeFilter();
		// 登録を許可する
		$this->Auth->allow('index');
	}
}
