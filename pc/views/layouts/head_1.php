<!-- 先引用main.php布局文件， -->  
<!-- head_1是除了包含最顶上的导航之外 加上下面的搜素框 -->
<?php $this->beginContent('@app/views/layouts/main.php');?>  
<!-- 引用头尾 头尾与内容之间还要一道导航条与搜索的-->
<div class="head_top_search">
	<input type="" name="">
	<button>提交</button>
</div>

<div class="main">  
  <?= $content ?>  
</div>  

<?php $this->endContent();?>  