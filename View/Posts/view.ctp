<div class="container">
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
	     if($user['id'] == $post['User']['id']){
	     if($post['Image'][0]['filename']){		
	     $base = $this->Html->url('/files/image/filename/'); 
	     echo $this->Html->image($base.$post['Image'][0]['id'].'/'.$post['Image'][0]['filename']);
	     }
	     }else {
	     echo '画像を上げたユーザーのみが閲覧可能です';
	     }	
	     ?>&nbsp;
			</dd>


		</dl>
	</div>
</div>
