<div class="container">
	<div class="row">
		<!-- デフォルトのラベルなどを非表示に-->
		<?php echo $this->Form->create('User', array('url' => 'login','inputDefaults' => array(
		'label' => false,
		'div' => false
		))); ?>
		<div class="col-md-4 col-md-offset-4">
			<form class="form-horizontal">
				<h3 class="text-center"><?php echo __('Please Login'); ?></h3>
				<div class="form-group">
					<?php echo $this->Form->input('username',array("class"=>"form-control input-lg","placeholder"=>"UserName")); ?>
					<?php echo $this->Form->input('password',array("class"=>"form-control input-lg","placeholder"=>"Password")); ?></div>
				<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
			</div>
			</form>
			<!-- <?php echo $this->Form->end(array("label"=>"Login","div"=>false)); ?> -->
		</div>
	</div>
</div>
