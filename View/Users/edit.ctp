<div class="container">
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<form>
		<legend><?php echo __('Edit User'); ?></legend>

 <div class="form-group"><?php echo $this->Form->input('id'); ?></div>
 <div class="form-group"><?php echo $this->Form->input('username'); ?></div>
 <div class="form-group"><?php echo $this->Form->input('password'); ?></div>
 <div class="form-group"><?php echo $this->Form->input('group_id'); ?></div>

	</form>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
