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
class Cybage_Megamenu_Model_Attributes extends Mage_Core_Model_Abstract
{

    public function _construct() 
    {
        parent::_construct();
        $this->_init('megamenu/attributes');
    }

    /**
     * 
     * @param type $attribute
     * @return type Int
     */
    public function getAttributeId($attribute) 
    {

        $collection = parent::getCollection()
                ->addFieldToSelect('entity_id')
                ->addFieldToFilter('atribute_code', array(array('eq' => $attribute)));
        $data = $collection->getData();
        foreach ($data as $row) {
            return $row['entity_id'];
        }
    }

    /**
     * append attribute values to data array and return array
     *
     * @param  type $id
     * @param  type $data
     * @return type array
     */
    public function getValues($id, $data) 
    {

        $collection = parent::getCollection();
        $collection->addFieldToSelect('atribute_code');
        $collection->getSelect()->joinLeft(array('mapping' => 'megamenu_template_attributes'), 'main_table.entity_id = mapping.attribute_id', array());
        $collection->getSelect()->joinLeft(array('attributeValues' => 'megamenu_template_attributes_values'), 'mapping.entity_id = attributeValues.template_attribute_id', array('attributeValues.value'));
        $collection->getSelect()->where('attributeValues.menu_id=?', $id);



        foreach ($collection->getData() as $row) {

            $key = $row['atribute_code'];
            $val = $row['value'];
            $data[$key] = $val;
        }

        return $data;
    }

}
