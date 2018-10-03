<div class="container">
	<div class="groups form">
		<?php echo $this->Form->create('Group',array('inputDefaults'=>array('class'=>'form-control'))); ?>
		<form>
			<legend><?php echo __('Add Group'); ?></legend>
			<div class="form-group"><?php echo $this->Form->input('name');?></div>
			<div class="form-group"><?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary btn-lg')); ?></div>
		</form>
	<?php echo $this->Form->end(); ?>
</div>
</div>
