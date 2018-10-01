<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/popup.js"></script>
	<!-- 画像のデモ-->
	<div class="users index">
 		<div id="back-curtain"></div>
		<h2><?php echo __('デモ'); ?></h2>
		<p>画像をクリックするとポップアップが表示されます。さらに画像の左右にある矢印をクリックするとスライドショー</p>
		<div class="img" id="red">
			<?php echo $this->Html->image('/files/image/demo/thumb-01-red.png' ); ?>
			<div class="largeImg" id="largeRed">
				<?php echo $this->Html->image('/files/image/demo/thumb-01-red.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="orange">
			<?php echo $this->Html->image('/files/image/demo/thumb-02-orange.png' ); ?>
			<div class="largeImg" id="largeOrange">
				<?php echo $this->Html->image('/files/image/demo/thumb-02-orange.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="yellow">
			<?php echo $this->Html->image('/files/image/demo/thumb-03-yellow.png' ); ?>
			<div class="largeImg" id="largeYellow">
				<?php echo $this->Html->image('/files/image/demo/thumb-03-yellow.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="green">
			<?php echo $this->Html->image('/files/image/demo/thumb-04-green.png' ); ?>
			<div class="largeImg" id="largeGreen">
				<?php echo $this->Html->image('/files/image/demo/thumb-04-green.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="blue">
			<?php echo $this->Html->image('/files/image/demo/thumb-05-blue.png' ); ?>
			<div class="largeImg" id="largeBlue">
				<?php echo $this->Html->image('/files/image/demo/thumb-05-blue.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="indigo">
			<?php echo $this->Html->image('/files/image/demo/thumb-06-indigo.png' ); ?>
			<div class="largeImg" id="largeIndigo">
				<?php echo $this->Html->image('/files/image/demo/thumb-06-indigo.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>
		<div class="img" id="purple">
			<?php echo $this->Html->image('/files/image/demo/thumb-07-purple.png' ); ?>
			<div class="largeImg" id="largePurple ">
				<?php echo $this->Html->image('/files/image/demo/thumb-07-purple.png',array('width'=>'600', 'height'=>'400')); ?>
			</div>
		</div>

		<div id="buttonR">
			<button type="button">></button>
		</div>
		<div id="buttonL">
			<button type="button"><</button>
		</div>

	</div>
</div>
