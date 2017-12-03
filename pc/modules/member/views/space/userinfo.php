<div class="left-nav">
    <div class="yz-grzl">
        <ul >
			<a href="/member/space/index" target="right"><li>基本资料</li></a>
			<a href="/member/space/contactway" target="right"><li>联系方式</li></a>
			<a href="/member/space/changepwd" target="right"><li>修改密码</li></a>
			<a href="/member/space/manageinfo" target="right"><li>账户管理</li></a>
        </ul>
    </div>
</div>

<div class="right-show">
<div class="right-contain">
<h1 class="xhx"><b>个人资料</b></h1>
	<p class="zwjs">填写真是的资料方便大家了解你，一下信息将显示在<a href="" style="color: ">个人资料页</a>。<br>
	（请不要在资料里面刘电话,QQ,网址，邮箱等联系方式信息，会导致您的资料无法通过审核）
	</p>
		<div class="user-info">
			<div class="info_contain">
				<form id="submit-form">
					<?php if(!empty($uid)){?>
						<div>
						<label>用户名</label>&nbsp;<b>:</b>&nbsp;<input type="" id="user_name" name="user_name" value="<?=$userinfo['user_name']?>"/><br><br>
						<label>昵称</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="nickname" name="nickname" value="<?=$userinfo['nickname']?>" /><br><br>
						</div>
						<label>性别</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;
						<?php if($userinfo['sex'] == '男'){?>
						<label><input type="radio" id="sex" name="sex" value="man" checked="checked" >男</label>
						<label><input type="radio" id="sex" name="sex" value="woman">女</label><br><br>
						<?php }else{?>
						<label><input type="radio" id="sex" name="sex" value="man" checked="checked" >男</label>
						<label><input type="radio" id="sex" name="sex" value="woman" checked="checked">女</label><br><br>
						<?php  }?>
						<label>生日</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="date" id="birthday" value="2017-10-30" name="birthday"><br><br>
						<div>
						<label class="jianjie">简介</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<textarea placeholder="简单介绍一下自己吧!请输入至少4-200个字，支持中文，英文" name="profile" id="profile" ><?=$userinfo['profile']?></textarea>
						</div>
						<button class="submit-button">保存</button>
					<?php }else{?>

						<div>
							<label>用户名</label>&nbsp;<b>:</b>&nbsp;<input type="" id="user_name" name="user_name" /><br><br>
							<label>昵称</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="nickname" name="nickname" /><br><br>
						</div>
						<label>性别</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<label><input type="radio" id="sex" name="sex" value="man">男</label>
						<label><input type="radio" id="sex" name="sex" value="woman">女</label><br><br>
						<label>生日</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="date" id="birthday" value="2017-10-30" name="birthday"><br><br>
						<div>
							<label class="jianjie">简介</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<textarea placeholder="简单介绍一下自己吧!请输入至少4-200个字，支持中文，英文" id="profile" name="profile"></textarea>
						</div>
						<button id="submit-button">保存</button>
					<?php }?>
				</form>
			</div>
			
		</div>
</div>
</div>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
$("#submit-button").click(function () {
        var user_name = $("#user_name").val();
        var nickname = $("#nickname").val();
        var sex = $("#sex").val();
        var birthday = $("#birthday").val();
        var profile = $("#profile").val();

 		if (user_name == '') {
           alert('用户名不能为空');
           return false;
       	}
        if (nickname == '') {
           alert('昵称不能为空');
           return false;
        }
        if (sex == '') {
           alert('性别不能为空');
           return false;
        }
        //ajax 类型
        $.ajax({
            url: 'index',
            type: 'post',
           	dataType:'json',
            data: $('#submit-form').serialize(),
            success: function (result) {
            	// result = JSON.parse(result);
                alert(result.msg);
                window.location.reload();
            }
        });
        return false;
    })
</script>