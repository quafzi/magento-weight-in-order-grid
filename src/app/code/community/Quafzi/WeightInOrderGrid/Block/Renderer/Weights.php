<?php
/**
 * @package    Quafzi_WeightInOrderGrid
 * @copyright  Copyright (c) 2015 Thomas Birke
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Quafzi_WeightInOrderGrid_Block_Renderer_Weights
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $order)
    {
        $helper = Mage::helper('quafzi_weightinordergrid');
        $weightAttributeTitle = $helper->__('gross');
        $netWeightAttributeTitle = $helper->__('net');

        $unit = $helper->getWeightUnit();
        $netWeight = $helper->getNetWeight($order);
        return '<strong>' . $weightAttributeTitle . ':</strong> ' . $order->getWeight() . $unit
            . '<br /><strong>' . $netWeightAttributeTitle . ':</strong> ' . $netWeight . $unit;
    }
}
