<?php
App::uses('AppController', 'Controller');
/**
 * Changedatas Controller
 *
 */
class ChangedatasController extends AppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');	
	
	public function index(){
		$this->Changedata->recursive = 0;
        $this->set('datas', $this->Paginator->paginate());
	}
	public function add(){
		if ($this->request->is('post')) {
			$this->Changedata->create();
//debug($this->request->data);
			//exit;

            if ($this->Changedata->saveall($this->request->data)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }
	}
	public function edit($id = null){
		$db_user = "root";
		$db_pass = "password";
		$db_host = "localhost";
		$db_name = "blogtest";
		$db_type = "mysql";
		$options = array('conditions' => array('Changedata.' . $this->Changedata->primaryKey => $id));
		$thisdata = $this->Changedata->find('first', $options);
		$table_name = "postal_codes";
		$options = array('conditions' => array('Changedata.' . $this->Changedata->primaryKey => $id));
		$this->request->data = $this->Changedata->find('first', $options);

		if ($this->request->is(array('post', 'put'))) {
			$dsn = $this->Changedata->create_dsn($db_type, $db_host, $db_name);
			try{
				$pdo = new PDO($dsn,$db_user,$db_pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
				$this->Flash->success(__('Success.Connect.'));
			}catch(PDOException $Exception){
				die('error:'.$Exception->getMessage());
			}

			try{
				$pdo->beginTransaction();
        $sql = " DELETE FROM {$table_name};";
				$stmh = $pdo->prepare($sql);
						$stmh->execute();
				
				$sql = "INSERT INTO {$table_name} (jiscode, zipcode, state, city, street, changed, cause) VALUES (:jiscode, :zipcode, :state, :city, :street, :changed, :cause)";
				$stmh = $pdo->prepare($sql);

				$row = 1;
				if (($handle = fopen("../address_data/{$thisdata['Changedata']['id']}/{$thisdata['Changedata']['filename']}", "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$num = count($data);
						if($num != 8){
							throw new PDOException();
						}
						$params = array(':jiscode' => $data[1], ':zipcode' => $data[2], ':state' => $data[3], ':city' => $data[4], ':street' => $data[5], ':changed' => $data[6], ':cause' => $data[7]);
						// SQLを実行
						$stmh->execute($params);
						$row++;
					}
					fclose($handle);
				}
				$pdo->commit();
				$this->Flash->success(__("Change data ".$row));
			}catch(PDOException $Exception){
				$pdo->rollBack();
				$this->Flash->error(__('Change data error. Please, try again.'));
			}
		}

		return $this->redirect(array('action' => 'index'));
	}

	public function view(){
	}
	public function delete($id = null){
		 $this->Changedata->id = $id;
        if (!$this->Changedata->exists()) {
            throw new NotFoundException(__('Invalid data'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Changedata->delete()) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));

	}		

}
