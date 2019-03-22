<div class="container">

	<div class="row">
		<div class="col-md-12" id="title">
			<div class="box">
				<h1>
					<?php echo __('Datas'); ?><br>
				</h1>
				<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('Add Data'), array('action' => 'add')); ?></button>
			</div>
		</div>
	</div>
	<div class="datas index">
		<table class="table s-tbl" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo __($this->Paginator->sort('id')); ?></th>
					<th><?php echo __($this->Paginator->sort('filename')); ?></th>
					<th><?php echo __($this->Paginator->sort('created')); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datas as $data): ?>
				<tr>
					<td><?php echo h($data['Changedata']['id']); ?>&nbsp;</td>
					<td><?php echo h($data['Changedata']['filename']); ?>&nbsp;</td>
					<td><?php echo h($data['Changedata']['created']); ?>&nbsp;</td>
					<td class="actions"> 
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default"><?php echo $this->Form->postLink(__('Change Data'), array('action' => 'edit', $data['Changedata']['id']), array('confirm' => __('Are you sure you want to change data # %s?', $data['Changedata']['id']))); ?></button>
							<button type="button" class="btn btn-default"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $data['Changedata']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $data['Changedata']['id']))); ?></button>
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
