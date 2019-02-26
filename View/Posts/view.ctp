<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/popup_img.js"></script>
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
		<div id="back-curtain"></div>
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
		 for($i=0;$i<$image_num;$i++){
		 $file_path = "/posts/image/".$post['Post']['id']."/".$i;
		 ?>
		 <div class="img">
			 <?php echo $this->Html->image($file_path);?>
			 <div class="largeImg">
				 <?php echo $this->Html->image($file_path); ?>
			 </div>
		 </div>
		 <?php
				  }
				  }else {
				  echo '画像を上げたユーザーのみが閲覧可能です';
				  } 	
				  ?>&nbsp;
			</dd>
		</dl>
		<div id="buttonR">
			<button type="button">></button>
		</div>
		<div id="buttonL">
			<button type="button"><</button>
		</div>

	</div>
</div>
