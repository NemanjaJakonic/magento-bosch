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
class Cybage_Megamenu_Model_Menutype extends Mage_Core_Model_Abstract
{

    public function _construct() 
    {
        parent::_construct();
        $this->_init('megamenu/menutype');
    }

    /**
     * Return menu typle list for select 
     *
     * @return array
     */
    public function getMenuList() 
    {
        $menuTypes = parent::getCollection();
        $menuTypes->addFieldToFilter('is_active', 1);
        $menuAarray[] = array('value' => '', 'label' => "Select menu type");
        foreach ($menuTypes as $menu) {
            $menuAarray[] = array('value' => $menu->getId(), 'label' => $menu->getType());
        }
        return $menuAarray;
    }

}
