<?php
class Admin_Form_ValidateGroup {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle;
	
	public function __construct($arrParam = array(), $options = null) {
		//----- khoi tao mang $_arrStyle
		$this->_arrStyle['group_name'] = '';
		$this->_arrStyle['order'] = '';
		
	}
	
	public function validate($arrParam = array(), $options = null) {
		//===============================================================
		//========== kiem tra group_name =================================
		//===== khong duoc rong. do dai 3 den 32 ky tu. Chi duoc chua a-z, A-Z, -, _, .
		//===== khong duoc ton tai trong database (tru chinh no trong truong hop
		//===== action la edit)
		//===============================================================
		switch ($arrParam['action']) {
			case 'add':
				$options = array('table'=>'user_group','field'=>'group_name');
				break;
			case 'edit':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'user_group','field'=>'group_name','exclude'=>$clause);
				break;
			default:
				$options = array('table'=>'user_group','field'=>'group_name');
		}
		
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
		->addValidator(new Zend_Validate_StringLength(3,32),true)
		->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9\-_\.\s]+$#'),true)
		->addValidator(new Zend_Validate_Db_NoRecordExists($options));
		if (!$validator->isValid($arrParam['group_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['group_name'] = 'Group Name: ' . current($message);
			$arrParam['group_name'] = '';
			$this->_arrStyle['group_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//========== kiem tra order =================================
		//===== khong duoc rong. Phai la so nguyen >= 0
		//===============================================================
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
		->addValidator(new Zend_Validate_Int(),true);
		if (!$validator->isValid($arrParam['order'])) {
			$message = $validator->getMessages();
			$this->_messagesError['order'] = 'Order: ' . current($message);
			$arrParam['order'] = '';
			$this->_arrStyle['order'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//===== TRUYEN CAC GIA TRI CUA CAC INPUT SAU KHI VALIDATE
		//===== VAO MANG $_arrData DE TRUYEN NGUOC LAI RA FORM
		//===============================================================
		$this->_arrData = $arrParam;
	} 
	
	public function validateDelete($arrParam = array(), $options = null) {
		//===============================================================
		//========== kiem tra so luong user la thanh vien cua nhom ======
		//===== neu nhom co thanh vien thi tra ve bao loi, khong xoa duoc
		//===============================================================
		$tblGroup = new Admin_Model_UserGroup();
		
		//----- validate cho truong hop xoa mot group
		if ($options['task'] == 'validate-delete-group') {
			$groupmembercount = $tblGroup->getItem($arrParam,array('task'=>'count-group-members'));
			if ($groupmembercount > 0) {
				$thisgroup = $tblGroup->getItem($arrParam,array('task'=>'admin-group-info'));
				$group_name = $thisgroup['group_name'];
				$this->_messagesError = "You can't delete group \"" . $group_name . "\". There're still "
											. $groupmembercount . " members of this group!";
			}
		}
		
		//----- validate cho truong hop xoa nhieu group
		if ($options['task'] == 'validate-delete-multi-group') {
			if (count($arrParam['cid'] > 0)) {
				
				$cid = $arrParam['cid'];
				foreach ($cid as $key=>$val) {
					//----- validate tung group mot, voi group_id lay tu mang cid truyen vao
					//----- neu group xoa duoc thi dinh dang messageError[group_id] = ok
					//----- neu group khong xoa duoc thi dinh dang messageError[group_id] = You cant...
					$groupmembercount = $tblGroup->getItem(array('id'=>$val),array('task'=>'count-group-members'));

					if ($groupmembercount > 0) {
						$thisgroup = $tblGroup->getItem(array('id'=>$val),array('task'=>'admin-group-info'));
						$group_name = $thisgroup['group_name'];
						$this->_messagesError[$val] = "You can't delete group \"" . $group_name . "\". There're still "
													. $groupmembercount . " members of this group!";
					} else {
						$this->_messagesError[$val] = 'ok';
					}
				}
			}
		}
	}
	
	//----- kiem tra du lieu validate co loi hay khong
	//----- tra ve true neu co loi. Tra ve false neu khong co loi
	public function isError() {
		if (count($this->_messagesError) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//----- tra ve mang chua cac thong bao loi
	public function getMessageError() {
		return $this->_messagesError;
	}
	
	//----- tra ve mang chua toan bo du lieu sau khi validate
	public function getData($options = null) {
		return $this->_arrData;
	}
	
	//----- tra ve mang dinh dang cho cac input sau khi validate
	public function getStyle($options = null) {
		return $this->_arrStyle;
	}
	
}