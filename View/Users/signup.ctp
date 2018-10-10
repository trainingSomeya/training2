<?php
    echo $this->Form->create( 'User', array( 'type'=>'post', 'url'=>'signup'));
    // ユーザ名
    echo $this->Form->text( 'username', array( 'maxlength' => '255', 'type' => 'email'));
    // パスワード
    echo $this->Form->text( 'password', array( 'maxlength' => '50', 'type' => 'password'));
    // パスワード確認用
    echo $this->Form->text( 'password_confirm', array( 'maxlength' => '50', 'type' => 'password'));
    echo $this->Form->end( 'Signup');
?>
