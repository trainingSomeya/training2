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
				     echo $this->Form->input('username', array('default'=>$premembers['PreMember']['mail'],'readonly' => 'readonly')); ?>
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
						<p>ボタンで検索
						地方：<select id="region">
							<option disabled selected value></option>
							<option value="hokkaidou">北海道地方</option>
							<option value="touhoku">東北地方</option>
							<option value="kanntou">関東地方</option>
							<option value="tyuubu">中部地方</option>
							<option value="kinki">近畿地方</option>
							<option value="tyuugoku">中国地方</option>
							<option value="sikoku">四国地方</option>
							<option value="kyuusyuu">九州・沖縄地方</option>
						</select>
						県：<select id="prefecture">
						</select>
						市：<select id="city">
						</select>
						町：<select id="street">
						</select>
						<input type="button" id="button_search_btn" value="入力">
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
