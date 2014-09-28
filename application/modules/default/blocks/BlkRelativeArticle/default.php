<div class="news-other">
	<h4><span class="label label-primary">Các tin tức khác</span></h4>
	<ul class="other-news">
	<?php
		if(!empty($relativeArticles)) {
			foreach($relativeArticles as $key=>$val) {
				$val = $blockView->cmsReplaceString($val);
				$article_id = $val['id'];
				$category_id = $val['category_id'];
				$article_title = $val['article_title'];
			
				$filter = new Zend_Filter();
				$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
				->addFilter(new Zend_Filter_StringTrim())
				->addFilter(new Zend_Filter_Alnum(true))
				->addFilter(new Zendvn_Filter_RemoveCircumflex())
				->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				 
				$articleUrlOptions = array('module'=>'default','controller'=>'tin-tuc','action'=>'tin-tuc-chi-tiet',
						'title'=>$multiFilter->filter($article_title),'id'=>$article_id,'category_id'=>$category_id);
				 
				$article_link = $blockView->url($articleUrlOptions,'news-detail');	
	?>
	
	<li><span class="glyphicon glyphicon-chevron-right"></span>
	<a href="<?php echo $article_link; ?>"><?php echo $article_title; ?></a></li>
	
	<?php 
			}
		} else {
	?>
	<div class="alert alert-danger">Không có tin tức nào thuộc mục này!</div>
	<?php 
		}
	?>
	</ul>
</div>