<div class="container">
	<div class="row box">
		<div class="posts form">
			<?php echo $this->Form->create('Post',array('inputDefaults'=>array('class'=>'form-control'),'type' => 'file', 'enctype' => 'multipart/form-data')); ?>
			<form>
				<legend><?php echo __('Edit Post'); ?></legend>
				<div class="form-group"><?php echo $this->Form->input('id'); ?></div>
				<div class="form-group"><?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users)); ?></div>
				<div class="form-group"><?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$categories)); ?></div>
				<div class="form-group"><?php echo $this->Form->input('title'); ?></div>
				<div class="form-group"><?php echo $this->Form->input('body');?></div>
				<?php
					 if($user['id'] == $post['User']['id']){
					 for($i=0;$i<$image_num;$i++){
					 $file_path = "/posts/image/".$post['Post']['id']."/".$i;
					 ?>
					 <div class="img">
						 <?php echo $this->Html->image($file_path);?>
						 <!-- <input type="button" id="delete_btn" value="削除"> -->
					 </div>
					 <?php
							  }
							  }else {
							  echo '画像を上げたユーザーのみが閲覧可能です';
							  }
							  ?>&nbsp;
							  </dd>
							  </dl>
							  <div class="form-group"><?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept' => 'image/*'));?></div>
							  <div class="form-group"><?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept' => 'image/*'));?></div>
							  <div class="form-group"><?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept' => 'image/*'));?></div>
							  <div class="form-group"><?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept' => 'image/*'));?></div>
							  <div class="form-group"><?php echo $this->Form->input('Tag',array('type'=>'select','options'=>$tags,'multiple' => 'checkbox','size' => 5,'class'=>'checkbox')); ?></div>
							  <div class="form-group"><?php echo $this->Form->end(__('Submit')); ?></div>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/edit_img.js"></script>

