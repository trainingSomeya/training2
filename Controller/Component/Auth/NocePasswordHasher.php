<?php

App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class NocePasswordHasher extends AbstractPasswordHasher {
    public function hash($password) {
		return $password;
	}

    public function check($password, $checkPassword) {
		return $checkPassword === $this->hash($password);
	}
}
