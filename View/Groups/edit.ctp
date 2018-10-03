<div class="container">
	<div class="groups form">
		<?php echo $this->Form->create('Group'); ?>
		<form>
			<legend><?php echo __('Edit Group'); ?></legend>
			<div class="form-group"><?php echo $this->Form->input('id'); ?></div>
			<div class="form-group"><?php echo $this->Form->input('name'); ?></div>
			<div class="form-group"><?php echo $this->Form->end(__('Submit')); ?></div>
		</form>
	</div>
</div>
