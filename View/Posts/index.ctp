<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/postsearch.js"></script>
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
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navbarAction">
				<ul class="nav navbar-nav">
					<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('JQ Test'), array('controller' => 'posts', 'action' => 'jqtest')); ?></li>
				</ul>
				<button type="button" class="btn btn-default navbar-btn navbar-right" id="search">Search</button>
			</div>
			<!-- 検索フォームを作成 -->	
			<div class="search">
				<div class="form-inline">
					<?php echo $this->Form->create('Post', array(
					'url' =>  array_merge(array('action' => 'index'),
					$this->params['pass']),'inputDefaults'=>array('class'=>'form-control'),
					'novalidate' => true				
				)); ?>
					<div class="form-group">
						<?php echo $this->Form->label('title'); ?>
						<?php echo $this->Form->text('title',array("placeholder"=>"Search")); ?>
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('categoryname',array('type'=>'select','options'=>$list,'label'=>'Category','empty'=>'','selected'=>'')); ?>
						<!--	<?php print var_export($list,true); ?> 
	      <?php echo $this->Form->label('Category'); ?> 
	      <?php echo $this->Form->text('categoryname'); ?> -->
					</div>
					<div class="form-group">
						<?php echo $this->Form->input('tagname',array('type'=>'select','multiple' => true,'options'=>$tags,'label'=>'Tag','empty'=>'','selected'=>'')); ?>
						<!--		<?php echo $this->Form->label('tag'); ?>
	      <?php echo $this->Form->text('tagname'); ?> -->
					</div>
					<div class="form-group">			
						<?php echo $this->Form->submit(__('Search', true), array('div' => false)); ?>
					</div>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</nav>


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
						<?php echo $this->Html->link("UserID: ".$post['User']['id'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?><br>
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
