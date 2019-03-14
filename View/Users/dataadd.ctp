<div class="container">
	<div class="users form">
		<?php echo $this->Form->create('User'); ?>
		<form>
			<legend><?php echo __('Add table test'); ?></legend>
			<div class="form-group"><?php echo $this->Form->input('table_name'); ?></div>
			<div class="form-group"><?php echo $this->Form->end(__('Submit')); ?></div>
		</form>
	</div>
</div>
