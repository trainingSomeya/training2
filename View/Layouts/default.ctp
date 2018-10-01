<!DOCTYPE html>

<html lang = "en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<title>
			<?php echo __('CakePHP: the rapid development php framework:'); ?>
		</title>

		<!-- Bootstrap -->
		<?php echo $this->Html->css('bootstrap.min'); ?>

		<!-- Le styles -->
		<style>
<!--
h1 {
	font-size:64px;
	font-weight:normal;
}
h2 {
	font-size:40px;
	font-weight:normal;
}
body {
	padding: 70px 0 0 0;
}
p {
	font-size: 16px;
}
th {
	font-size:20px;
}
td {
	font-size: 16px;
}
tbody tr:nth-child(odd) {
	background: #eee;
}
thead {
	background: #8de;
}
dt {
	font-size: 24px;
}
dd {
	font-size:16px;
}
legend {
font-size:64px;
}
#flashMessage{
font-size:16px;
background: #8cc;
text-align:center;
}
.form-group{
font-size: 18px
}
/* 画像のスライドショーのための設定*/ 
.img{
	padding: 2px 0 2px 0;
}
.largeImg{
	display:none;
}
#back-curtain{
	background: rgba(0, 0, 0, 0.5);
	display: none;
	position: absolute;
	left: 0;
	top:0;
}
#buttonR{
	display:none;
}
#buttonL{
	display:none;
}
.square_btn{
	width:160px;
	font-size:20px;
	font-weight:bold;
	text-decoration:none;
	display:block;
	text-align:center;
	padding:8px 0 10px;
	color:#0075ff;
	background-color:#ffffff;
	border:1px solid #333;
	border-radius:25px;
}
.search{
	display:none;
	background-color:#eeeeee;
	color:#000000;
	border-radius:0;
	padding:10px 20px 10px 20px;
}
/* グリットシステムの確認、調整*/
.box{
	/*background:#ddd; border: 1px #ff0000 solid;*/ 
	margin:20px 15px 20px 15px;
}
.starter-template {
	padding: 40px 15px;
	text-align: center;
}
.footer{
	border-top: 1px solid black;
}
.footer > .container{
	padding-bottom: 30px;
	padding-top: 30px;
}
/* ナビゲーションバーの設定 */
/* 通常時の見え方 */
.navbar-custom {
	background-color:#0075ff;
	color:#ffffff;
	border-radius:0;
	padding:0 60px 0 60px;
}
/* メニューの文字の色 */
.navbar-custom .navbar-nav > li > a {
	color:#fff;
}
/* active時の文字色*/
.navbar-custom .navbar-nav > .active > a {
	color: #ffffff;
	background-color:transparent;
}
/* 選択時の色*/
.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus,
.navbar-custom .navbar-nav > .active > a:hover,
.navbar-custom .navbar-nav > .active > a:focus,
.navbar-custom .navbar-nav > .open >a {
	text-decoration: none;
	background-color: #1186ff;
}
/* ブランドイメージ */
.navbar-custom .navbar-brand {
	color:#eeeeee;
}
/**/
.navbar-custom .navbar-toggle {
	background-color:#eeeeee;
}
/*画面が小さい時の開閉ボタンの色*/
.navbar-custom .icon-bar {
	background-color:#000000;
}
-->
		</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	</head>
	<body>
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
					<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?></li>
					<li><?php echo $this->Html->link(__('JQ Test'), array('controller' => 'posts', 'action' => 'index')); ?></li>
				</ul>
			</div>
		</div>
	</nav>
		<div class="container">
		<a name="TOP"></a>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<?php echo $this->Html->script('bootstrap.min'); ?>
		<?php echo $this->fetch('script'); ?>
		</div>	
		<!-- フッダー部分 -->
		<footer class="footer" style="text-align:center">
			<div class="container">
				<p>Built for <a href="http://getbootstrap.com">Bootstrap</a>	</p>
				<a href="#TOP">Back to Top</a>
			</div>
		</footer>
	</body>
</html>
