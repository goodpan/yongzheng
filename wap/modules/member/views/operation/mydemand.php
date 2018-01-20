<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14 
 * Time: 下午 15:00
 */
$this->title = "我提交的需求";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/member.css">
<?php $this->endBlock('cssblock')?>
<div class="my_demand">
		<section class="demand_list">
			<?php if($user_id){?>

			<ul>
				<?php foreach ($requiredata as $item){?>
				<li>
					<a href="">
						<div class="demand_info flex">
							<span class="time"><?=$item['sName']?>&nbsp;&nbsp;&nbsp;&nbsp;<?=date("Y-m-d H:i:s",$item['create_time'])?><?php if($item['status'] == 3){?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$item['grade'].'星'?><?php }?></span>
							<span class="wait">
								<?php if($item['status'] == 1){?>
									需求发布中
								<?php }elseif($item['status'] == 2){?>
									需求已被认领
								<?php }else{?>
									需求已完结
								<?php }?>
							</span>
						</div>
						<div class="demand_content">
							<p><?=$item['sContent']?></p>
						</div>
					</a>
				</li>
				<?php }?>
			</ul>
		</section>
	<?php }else{?>
		<p style="position: relative;margin-left: 40%;margin-top: 30px;">请先<a href="login" style="color: #04BE02">登录</a></p>
	<?php }?>
	</div>