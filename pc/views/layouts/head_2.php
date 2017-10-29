<!-- 先引用main.php布局文件， -->  
<!-- head_2是除了包含最顶上的导航和搜素框之外 首页的树形导航 -->
<?php $this->beginContent('@app/views/layouts/head_1.php');?>  
<!-- 引用头尾 头尾与内容之间还要一道导航条与搜索的-->
<div class="head_top_search">
	
</div>

<div class=""></div>

<div class="main">  
  <?= $content ?>  
</div>  

<?php $this->endContent();?>  