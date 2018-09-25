<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Post $Post
 */
class Tag extends AppModel {
public $name = 'Tag';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tagname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Post' => array(
			'className' => 'Post',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'post_id',
			'unique' => true,
			'with' => 'PostsTag'
		)
	);

}
