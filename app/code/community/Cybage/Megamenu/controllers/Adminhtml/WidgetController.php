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
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml').DS.'Promo'.DS.'WidgetController.php';
class Cybage_Megamenu_Adminhtml_WidgetController extends Mage_Adminhtml_Promo_WidgetController
{
    //put your code here
    
    /**
     * Prepare block for chooser
     *
     * @return void
     */
    public function chooserAction()
    {
       
        $request = $this->getRequest();

        switch ($request->getParam('attribute')) {
        case 'sku':
                 
            $block = $this->getLayout()->createBlock(
                'megamenu/adminhtml_megamenu_promo_widget_chooser_sku', 'promo_widget_chooser_sku',
                array('js_form_object' => $request->getParam('form'),
                )
            );
            break;

        case 'category_ids':
            $ids = $request->getParam('selected', array());
            if (is_array($ids)) {
                foreach ($ids as $key => &$id) {
                    $id = (int) $id;
                    if ($id <= 0) {
                        unset($ids[$key]);
                    }
                }

                $ids = array_unique($ids);
            } else {
                $ids = array();
            }


            $block = $this->getLayout()->createBlock(
                'adminhtml/catalog_category_checkboxes_tree', 'promo_widget_chooser_category_ids',
                array('js_form_object' => $request->getParam('form'))
            )
                ->setCategoryIds($ids);
            break;

        default:
            $block = false;
            break;
        }

        if ($block) {
            $this->getResponse()->setBody($block->toHtml());
        }
    }
}
