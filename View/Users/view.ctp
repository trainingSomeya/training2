<div class="container">
<div class="row">
                <div class="col-md-12" id="title">
                        <div class="box">
                                <h1>
                                        <?php echo __('User'); ?><br>
                                </h1>
                        </div>
                </div>
</div>
	<div class="users view">
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Username'); ?></dt>
			<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Password'); ?></dt>
			<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Group'); ?></dt>
			<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
			</dd>
		</dl>
	</div>
		<div class="related">
		<h3><?php echo __('Related Posts'); ?></h3>
		<?php if (!empty($user['Post'])): ?>
		<table class="table" cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($user['Post'] as $post): ?>
			<tr>
				<td><?php echo $post['id']; ?></td>
				<td><?php echo $post['user_id']; ?></td>
				<td><?php echo $post['title']; ?></td>
				<td><?php echo $post['body']; ?></td>
				<td><?php echo $post['created']; ?></td>
				<td><?php echo $post['modified']; ?></td>
				<td class="actions">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?></button>
						<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?></button>
						<button type="button" class="btn btn-default"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['id']))); ?></button>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>

			</div>
</div>
