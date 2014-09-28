<h4><span class="label label-primary">Các sản phẩm khác</span></h4>
<?php
	if(!empty($relativeProducts)) {
		foreach($relativeProducts as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$product_id = $val['id'];
			$product_name = $val['product_name'];
			$category_id = $val['category_id'];
			$cover_image = FILES_URL . '/products/cover-images/medium/' . $val['cover_image'];
		
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
									->addFilter(new Zend_Filter_StringTrim())
									->addFilter(new Zend_Filter_Alnum(true))
									->addFilter(new Zendvn_Filter_RemoveCircumflex())
									->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			 
			$productUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'san-pham-chi-tiet',
					'title'=>$multiFilter->filter($product_name),'id'=>$product_id,'category_id'=>$category_id);
			 
			$product_link = $blockView->url($productUrlOptions,'product-detail');	
?>
			<div class="product-block-small">
				<img src="<?php echo $cover_image; ?>" alt="cnt san pham"/>
				<div class="product-introduce">
					<h4 class="product-heading"><a href="<?php echo $product_link ?>"><?php echo $product_name; ?></a></h4>
				</div>
			</div>
<?php 
		}
	}	
?>