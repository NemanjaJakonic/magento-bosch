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
class Cybage_Megamenu_Model_Stores extends Mage_Core_Model_Abstract
{

    public function _construct() 
    {
        parent::_construct();
        $this->_init('megamenu/stores');
    }

    /**
     * save stores ids
     *
     * @param type $menuId
     * @param type $data   * 
     */
    public function saveStore($menuId, $data) 
    {

        foreach ($data['store_id'] as $storeId) {
            try{
                parent::setData(array('menu_id' => $menuId, 'store_id' => $storeId));
                parent::save();
            }  catch (Exception $e){
                Mage::log($e);
            }
        }
    }

    /**
     * return comma separeted store ids 
     *
     * @param  type  $id
     * @param  array $data
     * @return type string
     */
    public function getStores($id, $data) 
    {
        $megaMenuStores = Mage::getSingleton('core/resource')->getTableName('megamenu/stores');
        $model = Mage::getModel('megamenu/stores')->getCollection()
                ->addFieldToSelect('store_id')
                ->addFieldToFilter('menu_id', array(array('eq' => $id)));

        foreach ($model->getData() as $storeId) {
            $stores[] = $storeId['store_id'];
        }

        $data['store_id'] = implode(',', $stores);
        return $data;
    }

    /**
     * update existing stores
     *
     * @param type $id
     * @param type $data
     */
    public function updateStores($id, $data) 
    {

        //delete existing stores         
        $this->deleteStore($id);
        $this->saveStore($id, $data);
    }

    /**
     * delete existing stores prior saving 
     *
     * @param type $id
     */
    public function deleteStore($id) 
    {
        $stores = $this->getCollection()
            ->addFieldToFilter('menu_id', array('eq' => $id));

        if (!empty($stores)) {
            foreach ($stores as $store) {
                try{
                    $store->delete();
                }catch (Exception $e){
                    Mage::log($e);
                }
            }
        }
    }

}
