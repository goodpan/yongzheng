

<?php $this->beginBlock('cssblock')?>

<link rel="stylesheet" type="text/css" href="/css/member/member.css">
<?php $this->endBlock('cssblock')?>
	<header>
		<div class="member_opt flex">
			<div class="service">
				<a href="">
					<i class="phone"></i>
					<span>客服</span>
				</a>
			</div>
			<div class="set">
				<a href="/member/operation/setting">
					<span>设置</span>
					<i class="setting"></i>
				</a>
			</div>
		</div>
		<div class="member_portrait">
			<div class="portrait">
				<a href="">
					<img src="/img/member/portrait.png">
				</a>
			</div>
			<p>
				<?php if (empty($userdata['user_id'])){?>
					<a href="/member/operation/login">请登录/注册</a>
				<?php }else{?>
					<a href=""><?=$userdata['nickname']?></a>
				<?php }?>
			</p>
		</div>
	</header>
	<section class="member_item">
		<ul>
			<li>
				<a href="/member/operation/mydemand" class="flex">
					<i class="submit"></i>
					<p>我的提交的需求</p>
				</a>
			</li>
			<li>
				<a href="/member/auth/authentry" class="flex">
					<i class="authen"></i>
					<p>申请认证开发者</p>
				</a>
			</li>
			<!-- <li>
				<a href="" class="flex">
					<i class="task"></i>
					<p>分派给我的任务</p>
				</a>
			</li> -->
		</ul>
	</section>