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
class Cybage_Megamenu_Block_Adminhtml_Megamenu_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * 
     * @return type Parent function object
     */
    protected function _prepareForm() 
    {
        $form = new Varien_Data_Form(
            array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                '*/*/save', array('id' => $this->getRequest()->getParam('id')
                )
            ),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
                )
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}