<?php
/**
 * Changedata Fixture
 */
class ChangedataFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'changedatas';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'filename' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'delete_flag' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created' => '2019-03-15 15:33:16',
			'post_id' => 1,
			'filename' => 'Lorem ipsum dolor sit amet',
			'delete_flag' => 1
		),
	);

}
