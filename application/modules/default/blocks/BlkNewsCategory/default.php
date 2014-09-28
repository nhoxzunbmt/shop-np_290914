<div class="col-md-3">
	<h3 class="top-margin">NHÓM TIN TỨC</h3>
	<div class="list-group">
		<?php
			$thisNewsCategory_Id = $blockView->thisNewsCategory_Id;
			if (!empty($newsCategoryList) && count($newsCategoryList) > 0) {
				foreach($newsCategoryList as $key=>$val) {
					$val = $blockView->cmsReplaceString($val);
					$category_id = $val['id'];
					$category_name = $val['category_name'];
				
					$filter = new Zend_Filter();
					$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
										  ->addFilter(new Zend_Filter_StringTrim())
										  ->addFilter(new Zend_Filter_Alnum(true))
										  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
										  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				
					$newsCatUrlOptions = array('module'=>'default','controller'=>'tin-tuc','action'=>'index',
							'title'=>$multiFilter->filter($category_name),'id'=>$category_id);
				
					$category_link = $blockView->url($newsCatUrlOptions,'news-category');
					if ($thisNewsCategory_Id == $category_id) {
		?>
					<a href="<?php echo $category_link; ?>" class="list-group-item active">
		<?php } else { ?>
					<a href="<?php echo $category_link; ?>" class="list-group-item">
		<?php 	} ?>
						<span class="glyphicon glyphicon-chevron-right"></span> <?php echo $category_name; ?>
					</a>
		<?php 
				}
			}
		?>
						
	</div>
</div>