<?php
/**
 * Cybage Megamenu Plugin 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is available on the World Wide Web at:
 * http://opensource.org/licenses/osl-3.0.php
 * If you are unable to access it on the World Wide Web, please send an email
 * To: Support_ecom@cybage.com.  We will send you a copy of the source file.
 *
 * @category   Megamenu community plugin
 * @package    Cybage_Megamenu
 * @copyright  Copyright (c) 1995-2017[end year should change based on current year] Cybage Software Pvt. Ltd., India
 *             http://www.cybage.com/pages/centers-of-excellence/ecommerce/ecommerce.aspx
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Cybage Software Pvt. Ltd. <Support_ecom@cybage.com>
 */
class Cybage_Megamenu_Model_Menuattributes extends Mage_Core_Model_Abstract
{

    public function _construct() 
    {
        parent::_construct();
        $this->_init('megamenu/menuattributes');
    }

    /**
     * 
     * @param type $attributeId
     * @param type $templateId
     * @return string
     */
    public function getMappingId($attributeId, $templateId) 
    {
        $collection = parent::getCollection()
                ->addFieldToSelect('entity_id')
                ->addFieldToFilter('attribute_id', array(array('eq' => $attributeId)))
                ->addFieldToFilter('template_id', array(array('eq' => $templateId)));
        $data = $collection->getData();
        if (count($data) > 0) {
            return $data[0]['entity_id'];
        } else {
            return " ";
        }
    }

}
