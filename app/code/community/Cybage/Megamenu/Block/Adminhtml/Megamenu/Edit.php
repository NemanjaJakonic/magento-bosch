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
class Cybage_Megamenu_Block_Adminhtml_Megamenu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct() 
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'megamenu';
        $this->_controller = 'adminhtml_megamenu';

        $this->_updateButton('save', 'label', Mage::helper('megamenu')->__('Save Menu Item'));
        $this->_updateButton('delete', 'label', Mage::helper('megamenu')->__('Delete Menu Item'));

        $this->_addButton(
            'saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
            ), -100
        );

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('megamenu_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'megamenu_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'megamenu_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Generating Header Text
     *
     * @return type String
     */
    public function getHeaderText() 
    {
        if (Mage::registry('megamenu_data') && Mage::registry('megamenu_data')->getId()) {
            return Mage::helper('megamenu')->__("Edit Menu '%s'", $this->htmlEscape(Mage::registry('megamenu_data')->getName()));
        } else {
            return Mage::helper('megamenu')->__('Add Menu');
        }
    }

}
