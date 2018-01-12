<?php
/**
 * Created by PhpStorm.
 * User: suwen <suwen@3elephant.com>
 * Date: 2017/11/14 
 * Time: 下午 15:00
 */
$this->title = "账户管理";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/member.css">
<?php $this->endBlock('cssblock')?>
	<div class="member_manage">
		<section class="manage">
			<ul>
				<li class="up_portrait flex">
					<span>头像</span>
					<div class="portrait_wrap flex">
						<img src="" class="portrait_img">
						<input type="file" class="file" name="">
					</div>
				</li>
				<li>
					<a href="/member/operation/changename" class="flex">
						<span>昵称</span>
						<p class="nickname">昵称</p>
					</a>
				</li>
				<li>
					<a href="/member/operation/changepass" class="flex">
						<span>修改密码</span>
					</a>
				</li>
			</ul>
		</section>
		<?php if($user_id){?>
		<div class="sign_out">
			<a href="javascript:;" id="logout">退出登录</a>
		</div>
		<?php }?>
	</div>
</body>

<?php $this->beginBlock('jsblock')?>
<script src="/js/lrz.all.bundle.js"></script>
<script>
	var _csrf = "";
	$(function() {
		$('#logout').on('click',function(){
			$.get('/member/operation/logout',function(res){
				if(res&&res.status>0){
					$.toast("退出成功", function() {
						location.href = '<?=\Yii::$app->request->hostInfo?>/member/space/index';
					});
				}else{
					$.toast(res.msg,'text');
				}
			},'json')
		})
		$('.file').on('change',function() {
            var files = event.currentTarget.files[0];
            lrz(files)
                .then(function (rst) {
                    // 处理成功会执行
					var reqData = {
						sAvatar:rst.base64,
						_csrf:_csrf
					};
					$('.portrait_img').attr('src',rst.base64);
					$.post('',reqData,function(res){
						if(res&&res.status>0){
							$.toast(res.msg, "text");
						}else{
							$.toast(res.msg||'操作失败', "forbidden");
						}
					},'json')
                })
                .catch(function (err) {
                    // 处理失败会执行
					$.toast('请上传正确图片格式','text');
                    return;
                })
                .always(function () {
                    // 不管是成功失败，都会执行
                });
		})
	})
</script>
<?php $this->endBlock('jsblock')?>