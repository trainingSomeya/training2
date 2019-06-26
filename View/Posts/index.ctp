<div class="container">	

	<!-- 各ブログの内容表示とインフォメーション　-->
	<div class="row">
		<div class="col-md-12" id="title">
			<div class="box">
				<h1>
					<?php echo __('Posts'); ?><br>
				</h1>
			</div>
		</div>

	</div>
	<div class="row">
		<!-- 各ブログの内容表示 -->
		<div class="col-md-8">
			<?php foreach ($posts as $post): ?>
			<!-- チェック用 -->
			<!-- <?php var_dump($post); ?>&nbsp; -->
			<div class="box">
				<!-- タイトル部分 -->
				<h2><?php echo h($post['Post']['title']); ?>&nbsp;<br>
					<small style="font-size: medium;"><?php echo h("Category: ".$post['Category']['categoryname']); ?>&nbsp;
						<?php echo $this->Html->link("UserName: ".$post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?><br>
						<?php echo h("Created: ".$post['Post']['created']); ?>&nbsp;
						<?php echo h("Modified: ".$post['Post']['modified']); ?>&nbsp;</small></h2>
				<!-- 本文とタグとアクション --> 
				<p><?php echo h($post['Post']['body']); ?></p>
				<p>
				<?php 
						   echo h("Tag: ");
						   foreach ($post['Tag'] as $tag):
						   echo h($tag['tagname']."\n"); 
						   endforeach;
						   ?>&nbsp;</p>
				<p class="actions">
				<?php echo h("Actions: "); ?>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?></button>
					<button type="button" class="btn btn-default"><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?></button> 
					<button type="button" class="btn btn-default"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?></button>
				</div>
				</p>
			</div>
			<?php endforeach; ?>

			<!-- ページ数の表示 -->
			<div class ="box">
				<p>
				<?php
				 echo $this->Paginator->counter(array(
				 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				 ));
				 ?>	</p>
			</div>
			<div class ="box">
				<div class="btn-toolbar" role="toolbar">
					<button class="btn square_btn" role="group"><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></button>
					<button class="btn square_btn" role="group"><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));?></button>
				</div>
			</div>
		</div>
		<!-- インフォメーション -->
		<div class="col-md-4">
			<div class="box">
				<div class="well">
					<h3><?php echo __('About'); ?></h3>
					<p><?php echo __('Bootstrapの練習のためのブログぺージ');
					 //echo $this->element('sql_dump') ?></p>
				</div>
			</div>
		</div>

	</div>
</div>
</div>
