<?php
/**
 * @package    Quafzi_WeightInOrderGrid
 * @copyright  Copyright (c) 2015 Thomas Birke
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Quafzi_WeightInOrderGrid_Model_Observer
{
    public function beforeBlockToHtml(Varien_Event_Observer $observer) {
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Sales_Order_Grid) {
            $after = 'shipping_name';
            $this->_modifyGrid($block, $after);
        }
    }

    protected function _modifyGrid(Mage_Adminhtml_Block_Widget_Grid $grid, $after='grand_total')
    {
        $this->_addWeightColumn($grid, $after);
        // reinitialize column order
        $grid->sortColumnsByOrder();
    }

    protected function _addWeightColumn($grid, $after='grand_total')
    {
        $grid->addColumnAfter('weight', array(
            'header'    => Mage::helper('quafzi_weightinordergrid')->__('Weight'),
            'width'     => '80px',
            'filter'    => false,
            'index'     => 'weight',
            'renderer'  => 'quafzi_weightinordergrid/renderer_weights'
        ), $after);
    }

    public function beforeCollectionLoad(Varien_Event_Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        if ($collection instanceof Mage_Sales_Model_Resource_Order_Grid_Collection) {
            $collection->getSelect()
                ->from(
                    array(),
                    array(
                        'weight' => new Zend_Db_Expr('(
                            SELECT `weight`
                            FROM `sales_flat_order` as `o`
                            WHERE `main_table`.`entity_id` = `o`.`entity_id`
                        )'),
                    )
                );
        }
    }
}
