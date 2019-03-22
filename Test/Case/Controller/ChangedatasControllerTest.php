<?php
App::uses('ChangedatasController', 'Controller');

/**
 * ChangedatasController Test Case
 */
class ChangedatasControllerTest extends ControllerTestCase {

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

}
