<div class="container">
	<div class="row box">
		<div class="posts form">
			<?php echo $this->Form->create('Post',array('inputDefaults'=>array('class'=>'form-control'))); ?>
			<form>
				<legend><?php echo __('Edit Post'); ?></legend>
				<div class="form-group"><?php echo $this->Form->input('id'); ?></div>
				<div class="form-group"><?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users)); ?></div>
				<div class="form-group"><?php echo $this->Form->input('title'); ?></div>
				<div class="form-group"><?php echo $this->Form->input('body');?></div>
				<div class="form-group"><?php echo $this->Form->end(__('Submit')); ?></div>
			</form>
		</div>
	</div>
</div>
