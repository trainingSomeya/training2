<div class="container">
	<div class="row">
		<div class="posts form box">
			<?php echo $this->Form->create('Post',array('inputDefaults'=>array('div'=>'form-group','class'=>'form-control'),'type' => 'file', 'enctype' => 'multipart/form-data')); ?>
			<form>
				<legend><?php echo __('Add Post', array('type' => 'file')); ?></legend>
				<?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$categories)); ?>
				<?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users)); ?>
				<?php echo $this->Form->input('title');?> 
				<?php echo $this->Form->input('body');?> 
				<div class="select_img">				
					<?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept'=>'image/*'));?> 
					<input type="button" class="cancel_btn" value="cancel">
				</div>
				<?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept'=>'image/*'));?> 
				<?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept'=>'image/*'));?> 
				<?php echo $this->Form->input('Image..filename', array('type' => 'file', 'accept'=>'image/*'));?> 
				<?php echo $this->Form->input('Tag',array('type'=>'select','options'=>$tags,'multiple' => 'checkbox','size' => 5,'class'=>'checkbox')); ?>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary btn-lg')); ?>
				</div>	
			</form>
			<?php echo $this->Form->end(); ?> 
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/select_img.js"></script>

