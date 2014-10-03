<?php
class SanPhamController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;
	
	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>9,
			'pageRange'=>5
	);
	
	//----- bien chua ten session namespace
	protected $_namespace;
	
	//----- bien chua doi tuong translate
	protected $_translate;
	
	public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
		
		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		//----- moi khi co mot session duoc tao ra thi ten cua no se duoc luu vao day
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');
		
		//----- tao bien session luu cac du lieu nhu filter, sort...
		$this->_namespace = $this->_arrParam['module'] .'-' .$this->_arrParam['controller'];
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$ssAppSessionList->sessionList .= ':' .$this->_namespace;
		
		if (empty($ssFilter->col)) {
			//----- tu khoa tim kiem
			$ssFilter->keywords = '';
			//----- cot sap xep
			$ssFilter->col = 'p.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		//Loc san pham 
		if(isset($this->_arrParam['price'])&&!empty($this->_arrParam['price'])){
			$ssFilter->price=$this->_arrParam['price'];
			}
		
	
		if(isset( $ssFilter->price)&&!empty( $ssFilter->price)){	
			$this->_arrParam['ssFilter']['price'] = $ssFilter->price;
			$this->view->priceFilter = $ssFilter->price;
			}
		if(isset($this->_arrParam['delfilter'])&&!empty($this->_arrParam['delfilter'])){	
			if($this->_arrParam['delfilter']=='price'){unset($ssFilter->price);}
			if($this->_arrParam['delfilter']=='cate'){unset($ssFilter->cate);}
			}
	
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','product');
	}
	
	public function indexAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','product');
		
		if (!isset($this->_arrParam['category_id'])) {
			$this->_arrParam['category_id'] = 0;
		}
		
		$tblProCat = new Default_Model_ProductCategory();
		$proCat_list = $tblProCat->listItem($this->_arrParam,array('task'=>'default-productcategory-list-all'));
		
		$tblProduct = new Default_Model_Product();
		$productList = $tblProduct->listItem($this->_arrParam,array('task'=>'default-product-list'));
		
		$this->view->Items = $productList;
		$this->view->thisProductCategory_Id = $this->_arrParam['category_id'];
		
		//----- lay tong so phan tu de phan trang
		$totalProduct = $tblProduct->countItem($this->_arrParam,array('task'=>'count-item-all'));
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalProduct, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function sanPhamChiTietAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','product-detail');
		
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['id'] = 0;
		}
		
		$tblProduct = new Default_Model_Product();
		$this->view->Item = $tblProduct->getItem($this->_arrParam,array('task'=>'default-product-info'));
		$this->view->thisProductCategory_Id = $this->_arrParam['category_id'];
		//var_dump($this->view->Item);
	}
	
}
