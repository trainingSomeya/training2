<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Changedata');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($changedata['Changedata']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($changedata['Changedata']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Post'); ?></dt>
			<dd>
				<?php echo $this->Html->link($changedata['Post']['title'], array('controller' => 'posts', 'action' => 'view', $changedata['Post']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Filename'); ?></dt>
			<dd>
				<?php echo h($changedata['Changedata']['filename']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Delete Flag'); ?></dt>
			<dd>
				<?php echo h($changedata['Changedata']['delete_flag']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Changedata')), array('action' => 'edit', $changedata['Changedata']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Changedata')), array('action' => 'delete', $changedata['Changedata']['id']), null, __('Are you sure you want to delete # %s?', $changedata['Changedata']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Changedatas')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Changedata')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Posts')), array('controller' => 'posts', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Post')), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

