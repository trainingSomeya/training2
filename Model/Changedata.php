<?php
App::uses('AppModel', 'Model');
/**
 * Changedata Model
 *
 * @property Post $Post
 */
class Changedata extends AppModel {
var $actsAs = array(
        'Upload.Upload' => array(
            'filename' => array(
                'path' => '{ROOT}address_data/'
            )
        )
    );

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'changedatas';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	
	);

	///////テーブルデータの書き換え////////////
	//このままではロールバックしない
    /*public function reset_table($table_name){
        $db = ConnectionManager::getDataSource($this->useDbConfig);
        $q = " DELETE FROM {$table_name};";
        return $db->query($q);
	}*/

    public function create_dsn($db_type, $db_host, $db_name){
        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
        return $dsn;
    }

    //////////////////////

}
