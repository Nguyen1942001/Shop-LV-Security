<?php 
class ParamToAclActionService {
	function getActionName($c, $a) {
		$actionName = "";
		
		switch ($c) {
			case 'product':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_PRODUCT;
				}

				if (in_array($a, ["edit", "update"])) {
					$actionName = ACLService::EDIT_PRODUCT;
				}

				if (in_array($a, ["add", "save"])) {
					$actionName = ACLService::ADD_PRODUCT;
				}

				if (in_array($a, ["delete"])) {
					$actionName = ACLService::DELETE_PRODUCT;
				}
				break;
			case 'imageItem':
				if (in_array($a, ["list", "detail"])) {
					$actionName = ACLService::VIEW_PRODUCT;
				}

				if (in_array($a, ["save", "delete", "deletes"])) {
					$actionName = ACLService::EDIT_PRODUCT;
				}

				break;

			case 'staff':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_STAFF;
				}

				if (in_array($a, ["edit", "update", "disable", "activeOrDisableMulti"])) {
					$actionName = ACLService::EDIT_STAFF;
				}

				if (in_array($a, ["add", "save"])) {
					$actionName = ACLService::ADD_STAFF;
				}

				// if (in_array($a, ["delete"])) {
				// 	$actionName = ACLService::DELETE_STAFF;
				// }
				break;

			case 'order':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_ORDER;
				}

				if (in_array($a, ["edit", "updateOrder", "confirm"])) {
					$actionName = ACLService::EDIT_ORDER;
				}

				if (in_array($a, ["add", "save"])) {
					$actionName = ACLService::ADD_ORDER;
				}

				if (in_array($a, ["deleteOrder"])) {
					$actionName = ACLService::DELETE_ORDER;
				}
				break;

			case 'customer':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_CUSTOMER;
				}

				if (in_array($a, ["edit", "update"])) {
					$actionName = ACLService::EDIT_CUSTOMER;
				}

				if (in_array($a, ["add", "save"])) {
					$actionName = ACLService::ADD_CUSTOMER;
				}

				if (in_array($a, ["delete"])) {
					$actionName = ACLService::DELETE_CUSTOMER;
				}
				break;

			case 'category':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_CATEGORY;
				}

				if (in_array($a, ["edit", "update"])) {
					$actionName = ACLService::EDIT_CATEGORY;
				}

				if (in_array($a, ["add", "save"])) {
					$actionName = ACLService::ADD_CATEGORY;
				}

				if (in_array($a, ["delete"])) {
					$actionName = ACLService::DELETE_CATEGORY;
				}
				break;

			case 'status':
				if (in_array($a, ["list"])) {
					$actionName = ACLService::VIEW_STATUS;
				}

				if (in_array($a, ["edit", "update"])) {
					$actionName = ACLService::EDIT_STATUS;
				}				
				break;

			case 'permission':
				if (in_array($a, ["listRole", "listAction"])) {
					$actionName = ACLService::VIEW_PERMISSION;
				}

				if (in_array($a, ["editRole", "updateRole"])) {
					$actionName = ACLService::EDIT_PERMISSION;
				}

				if (in_array($a, ["addRole", "saveRole"])) {
					$actionName = ACLService::ADD_PERMISSION;
				}

				if (in_array($a, ["deleteRole", "checkDeleteRole"])) {
					$actionName = ACLService::DELETE_PERMISSION;
				}
				break;

			case 'comment':
				if (in_array($a, ["list", "detail"])) {
					$actionName = ACLService::VIEW_COMMENT;
				}

				if (in_array($a, ["delete"])) {
					$actionName = ACLService::DELETE_COMMENT;
				}
				break;
			default:
				break;
		}
		
		// $actionName = "view_product";//hard code để có quyền truy cập
		return $actionName;
	}
}
?>