<div class="container">
	<div class="row">
		<div class="post form box">
			<?php echo $this->Form->create('PreMember',array('inputDefaults'=>array('div'=>'form-group','class'=>'form-control'),'type'=>'file','enctype'=>'multipart/form-data')); ?>

			<legend><?php echo __('New User', array('type' => 'file'));?></legend>
			<?php
		     echo $this->Form->input('mail',array('label'=>'Mail Address'));
		     echo $this->Form->end('送信');
		     ?>
		</div>
	</div>
</div>
