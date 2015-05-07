<?php
/**
 * @package    Quafzi_WeightInOrderGrid
 * @copyright  Copyright (c) 2015 Thomas Birke
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Quafzi_WeightInOrderGrid_Helper_Data
    extends Mage_Core_Helper_Data
{
    public function getNetWeight(Mage_Sales_Model_Order $order)
    {
        $netWeight = 0;
        foreach ($order->getItemsCollection() as $item) {
            $productNetWeight = $item->getProduct()->getData($this->getNetWeightAttributeCode());
            $netWeight += $productNetWeight * $item->getQtyOrdered();
        }
        return $netWeight;
    }

    public function getWeightUnit()
    {
        return Mage::getStoreConfig('admin/quafzi_weightinordergrid/weight_unit');
    }

    public function getNetWeightAttributeCode()
    {
        return Mage::getStoreConfig('admin/quafzi_weightinordergrid/attribute_code_net_weight');
    }
}
