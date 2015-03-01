<?php

require_once 'app/Mage.php';
Mage::app();
Mage::app()->getStore()->setId(Mage_Core_Model_App::ADMIN_STORE_ID);

$products = Mage::getModel('catalog/product')->getCollection();
/* You can add Attribute Filters to the above line if required */

$mediaApi = Mage::getModel("catalog/product_attribute_media_api");

foreach($products as $product) {

  $productID = $product->getId();
	$_product = Mage::getModel('catalog/product')->load($productID);
	$items = $mediaApi->items($_product->getId());
	
	if (count($items) > 0) { 
	
		foreach($items as $item) {
			$mediaApi->remove($_product->getId(), $item['file']);
		}
		echo $product->getId() . " done \n";
		
	} else { 
	
		echo $product->getId() . " has no images \n";
	
	}
	
}	
?>
