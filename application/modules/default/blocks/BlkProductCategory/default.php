	<h3 class="top-margin">Nhóm sản phẩm</h3>
	<hr/>
	<div class="list-group">
		<?php
			$thisProductCategory_Id = $blockView->thisProductCategory_Id;
			if (!empty($productCategoryList)) {
				foreach($productCategoryList as $key=>$val) {
					$val = $blockView->cmsReplaceString($val);
					$category_id = $val['id'];
					$category_name = $val['category_name'];
				
					$filter = new Zend_Filter();
					$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
											->addFilter(new Zend_Filter_StringTrim())
											->addFilter(new Zend_Filter_Alnum(true))
											->addFilter(new Zendvn_Filter_RemoveCircumflex())
											->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				
					$proCatUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'index',
							'title'=>$multiFilter->filter($category_name),'category_id'=>$category_id);
				
					$category_link = $blockView->url($proCatUrlOptions,'product-category');
					if ($thisProductCategory_Id == $category_id) {
		?>
						<a href="<?php echo $category_link ?>" class="list-group-item active">
		<?php 
					} else {
		?>
						<a href="<?php echo $category_link ?>" class="list-group-item">
		<?php		} ?>
		
							<span class="glyphicon glyphicon-chevron-right"></span> <?php echo $category_name; ?>
						</a>
		<?php 
				}
			}
		?>
	</div>
