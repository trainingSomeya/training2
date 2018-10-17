<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/addressSearch.js"></script>
<div class="container">
	<div class="row box">
		<div class="users form">
			<?php echo $this->Form->create('User',array('inputDefaults'=>array('class'=>'form-control'))); ?>
			<form>
				<legend><?php echo __('Add User'); ?></legend>
				<div class="form-group">
<?php //var_dump($premembers); 
echo $this->Form->input('username', array('default'=>$premembers['PreMember']['mail'])); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password'); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('group_id'); ?>
				</div>
				<div class="form-group">
					<!-- 郵便番号入力のテキストボックス -->
					<div class="well">
						<p>郵便番号検索<input type="text" id="zipcode" value="" maxlength="7" title="郵便番号検索">
						<input type="button" id="search_btn" value="検索">
						※7桁の半角数字で入力</p>
						<!-- 検索結果の表示エリア -->
						<p>検索結果
						<select id="zip_result"></select>	
						<input type="button" id="select_btn" value="入力">
						</p>
					</div>
				</div>	
				<div class="form-group">
					<?php echo $this->Form->input('address',array("id"=>"select_result")); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-primary btn-lg')); ?>
				</div>
			</form>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
