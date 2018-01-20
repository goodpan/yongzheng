<?php
$this->title = "昵称修改";
?>
<?php $this->beginBlock('cssblock')?>
    <link rel="stylesheet" type="text/css" href="/css/member/changename.css">
<?php $this->endBlock('cssblock')?>
	<div class="member_manage">
<!--		如果有登录-->
		<?php if($user_id){?>
			<div class="form-item">
				<?php if(empty($nickname)){?>
					<input type="text" name="nickname" class="inp" placeholder="请输入您的昵称" >
				<?php }else{?>
					<input type="text" name="nickname" class="inp" value="<?=$nickname?>">
				<?php }?>
			</div>

			<div class="submit_d">
				<a href="javascript:;" id="submit">保存</a>
			</div>
		<?php }?>
	</div>
</body>

<?php $this->beginBlock('jsblock')?>
<script>
	$(function() {
		$('#submit').on('click',function(){
			var nickname = $(".inp").val();
			if(nickname == ''){
				$.toast('昵称不能为空',"text");
				return false;
			}
			var url = '<?=\Yii::$app->request->hostInfo?>'+"/member/operation/changename";
			$.post(url,{nickname:nickname},function(res){
				if(res&&res.status>0){
					$.toast("修改成功", function() {
						location.href = '<?=\Yii::$app->request->hostInfo?>/member/space/index';
					});
				}else{
					$.toast(res.msg,'text');
				}
			},'json')
		})
	})
</script>
<?php $this->endBlock('jsblock')?>