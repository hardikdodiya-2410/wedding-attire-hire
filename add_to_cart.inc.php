<?php
class add_to_cart{
	function addProduct($pid,$qty,$attr_id){
		$_SESSION['cart'][$pid][$attr_id]['qty']=$qty;
	}
	
	function updateProduct($pid,$qty,$attr_id){
		if(isset($_SESSION['cart'][$pid][$attr_id])){
			$_SESSION['cart'][$pid][$attr_id]['qty']=$qty;
		}
	}
	
	function removeProduct($pid,$attr_id){
		if(isset($_SESSION['cart'][$pid][$attr_id])){
			unset($_SESSION['cart'][$pid][$attr_id]);
			if(empty($_SESSION['cart'][$pid])){
				unset($_SESSION['cart'][$pid]);
			}

		}
	}
	
	function emptyProduct(){
		unset($_SESSION['cart']);
	}
	

	function totalProduct(){
		if(isset($_SESSION['cart'])){
			// return count($_SESSION['cart']);
			$totalcount=0;
			foreach($_SESSION['cart'] as $list){
				$totalcount=$totalcount+count($list);
			}
			return $totalcount;
		}else{
			return 0;
		}
		
	}

}
?>