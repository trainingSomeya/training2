<div class="container">
	<!-- ヘッダー部分  ナビゲーションバー　-->
	<nav class="navbar navbar-custom navbar-fixed-top">
		<div class="row">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarAction">
					<span class="sr-only">Action navigation</span><!-- 音声ブラウザ用 -->
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navbarAction">
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
					<li><?php echo $this->Form->postLink(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?> </li>
					<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
					<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row">
		<div class="col-md-12" id="title">
			<div class="box">
				<h1>
					<?php echo __('Post'); ?><br>
				</h1>
			</div>
		</div>
	</div>

	<div class="posts view">
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
			<?php echo $this->Html->link($post['User']['id'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Body'); ?></dt>
			<dd>
			<?php echo h($post['Post']['body']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
			<?php echo h($post['Post']['created']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
			<?php echo h($post['Post']['modified']); ?>
			&nbsp;
			</dd>
			<dt><?php echo __('Image'); ?></dt>
			<dd>
			<?php
			if($post['Image'][0]['filename']){		
			$base = $this->Html->url('/files/image/filename/'); 
			echo $this->Html->image($base.$post['Image'][0]['id'].'/'.$post['Image'][0]['filename']);
			} 
			?>&nbsp;
			</dd>


		</dl>
	</div>
</div>
