<div class="container">

<div class="row">
                <div class="col-md-12" id="title">
                        <div class="box">
                                <h1>
                                        <?php echo __('Users'); ?><br>
                                </h1>
                        </div>
                </div>
</div>
	<div class="users index">
		<table class="table s-tbl" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('username'); ?></th>
					<th><?php echo $this->Paginator->sort('password'); ?></th>
					<th><?php echo $this->Paginator->sort('group_id'); ?></th>
					<th><?php echo $this->Paginator->sort('address'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
					</td>
					<td><?php echo h($user['User']['address']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
					<td class="actions"> 
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?></button>
							<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?></button>
							<button type="button" class="btn btn-default"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?></button>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<div class ="box">
			<div class="btn-toolbar" role="toolbar">
				<button class="btn square_btn" role="group"><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></button>
				<button class="btn square_btn" role="group"><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));?></button>
			</div>
		</div>
	</div>
</div>
