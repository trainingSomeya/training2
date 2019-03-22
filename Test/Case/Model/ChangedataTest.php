<?php
App::uses('Changedata', 'Model');

/**
 * Changedata Test Case
 */
class ChangedataTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.changedata',
		'app.post',
		'app.user',
		'app.group',
		'app.postal_code',
		'app.pre_member',
		'app.category',
		'app.image',
		'app.tag',
		'app.posts_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Changedata = ClassRegistry::init('Changedata');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Changedata);

		parent::tearDown();
	}

}
