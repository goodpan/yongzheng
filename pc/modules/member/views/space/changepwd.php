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
			<h1 class="xhx">修改密码</h1>
			<form id="submit-form">
				<div class="cg_paswd">
				    <label>原密码</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="pwd" name="pwd" placeholder="请输入原密码"><b style="color: red;">*</b><br><br>
				    <label>新密码</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="newpwd" name="newpwd" placeholder="请输入新密码"><b style="color: red;">*</b><br><br>
				    <label>重复密码</label>&nbsp;<b>:</b>&nbsp;<input type="" name="pwdagain" id="pwdagain" placeholder="请再次输入密码"><b style="color: red;">*</b><br><br>
				    <label>验证码</label>&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;<input type="" id="yzm" name="yzm" placeholder="请输入验证码">  <img style="width: 150px;height: 60px;" src="yzm.png"> <br><br>
				    <button id="submit-button">保存</button>
				</div>
			</form>

		</div>
	</div>

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$("#submit-button").click(function () {
        var pwd = $("#pwd").val();
        var newpwd = $("#newpwd").val();
        var pwdagain = $("#pwdagain").val();

 		if (pwd == '') {
           alert('原密码不能为空');
           return false;
       	}
        if (newpwd == '') {
           alert('新密码不能为空');
           return false;
        }
        if (pwdagain == '') {
           alert('再次输入密码不能为空');
           return false;
        }
        if (pwd == newpwd) {
           alert('新密码不可与旧密码相同,请重新输入');
           return false;
        }
		if (pwdagain !== newpwd) {
           alert('两次密码不一致,请重新输入');
           return false;
        }
        $.ajax({
            url: 'changepwd',
            type: 'post',
            dataType:'json',
            data: $('#submit-form').serialize(),
            success: function (result) {
            	alert(result.msg);
              window.location.reload();
            }
        });
        return false;
    })
</script>