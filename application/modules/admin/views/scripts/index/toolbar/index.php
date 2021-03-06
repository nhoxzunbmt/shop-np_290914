<?php
	
	//------------- nut Tour Manager - kieu link
	$linkTourManager = $this->baseUrl('admin/admin-tour/index');
	$btnTourManager = $this->cmsButton($this->translate('button-tour-manager'),$linkTourManager,
			$this->imgUrl . '/dashboard/icon-48-tour.png','link');
	
	//------------- nut Add Tour - kieu link
	$linkAddTour = $this->baseUrl('admin/admin-tour/add');
	$btnAddTour = $this->cmsButton($this->translate('button-tour-add'),$linkAddTour,
			$this->imgUrl . '/dashboard/icon-48-tour-add.png','link');
	
	//------------- nut Add Product - kieu link
	$linkAddProduct = $this->baseUrl('admin/admin-product/add');
	$btnAddProduct = $this->cmsButton($this->translate('button-product-add'),$linkAddProduct,
			$this->imgUrl . '/dashboard/icon-48-product-add.png','link');

	//------------- nut Article Manager - kieu link
	$linkArticleManager = $this->baseUrl('admin/admin-news-article/index');
	$btnArticleManager = $this->cmsButton($this->translate('button-article-manager'),$linkArticleManager,
									$this->imgUrl . '/dashboard/icon-48-article.png','link');
	
	//------------- nut Add Article - kieu link
	$linkAddArticle = $this->baseUrl('admin/admin-news-article/add');
	$btnAddArticle = $this->cmsButton($this->translate('button-article-add'),$linkAddArticle,
									$this->imgUrl . '/dashboard/icon-48-article-add.png','link');
	
	//------------- nut Service Manager - kieu link
	$linkServiceManager = $this->baseUrl('admin/admin-service/index');
	$btnServiceManager = $this->cmsButton($this->translate('button-service-manager'),$linkServiceManager,
									$this->imgUrl . '/dashboard/icon-48-service.png','link');
	
	//------------- nut Add Service - kieu link
	$linkAddService = $this->baseUrl('admin/admin-service/add');
	$btnAddService = $this->cmsButton($this->translate('button-service-add'),$linkAddService,
			$this->imgUrl . '/dashboard/icon-48-service-add.png','link');	
	
	//------------- nut Product Manager - kieu link
	$linkProductManager = $this->baseUrl('admin/admin-product/index');
	$btnProductManager = $this->cmsButton($this->translate('button-product-manager'),$linkProductManager,
									$this->imgUrl . '/dashboard/icon-48-product.png','link');
	
	//------------- nut Add Product - kieu link
	$linkAddProduct = $this->baseUrl('admin/admin-product/add');
	$btnAddProduct = $this->cmsButton($this->translate('button-product-add'),$linkAddProduct,
									$this->imgUrl . '/dashboard/icon-48-product-add.png','link');
	
	//------------- nut User Manager - kieu link
	$linkUserManager = $this->baseUrl('admin/admin-user/index');
	$btnUserManager = $this->cmsButton($this->translate('button-user-manager'),$linkUserManager,
									$this->imgUrl . '/dashboard/icon-48-user.png','link');
	
	//------------- nut Language Manager - kieu link
	$linkLanguageManager = $this->baseUrl('admin/admin-language/index');
	$btnLanguageManager = $this->cmsButton($this->translate('button-language-manager'),$linkLanguageManager,
									$this->imgUrl . '/dashboard/icon-48-language.png','link');
	
	//------------- nut Template Manager - kieu link
	$linkTemplateManager = $this->baseUrl('admin/admin-template/banner');
	$btnTemplateManager = $this->cmsButton($this->translate('button-template-manager'),$linkTemplateManager,
									$this->imgUrl . '/dashboard/icon-48-themes.png','link');
	
	$line_url = TEMPLATE_URL . '/admin/system/images/dashboard/icon-48-horizontal-line.png';
	$horizontal_line = '<img src="' . $line_url . '">';
	
	switch ($this->arrParam['action']) {
		case 'index':
			$stnBtn = $btnArticleManager . ' ' . $btnAddArticle . ' ' . 
					  $btnServiceManager . ' ' . $btnAddService . ' ' .
					  $btnUserManager . ' ' . $btnLanguageManager . ' ' .
					  $btnTemplateManager;
			break;
		default:
			$stnBtn = '';
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div id="toolbar-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			
			<div class="m">
				<div id="toolbar" class="toolbar" >
								
					<?php echo $stnBtn; ?>
					<div class="clr"></div>                 
					
				</div>
				<h3 class="page-header"><?php echo $this->Title; ?></h3>
		                                
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
	</div>
</div>