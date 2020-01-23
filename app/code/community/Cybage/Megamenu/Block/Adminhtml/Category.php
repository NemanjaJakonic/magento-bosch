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
class Cybage_Megamenu_Block_Adminhtml_Category
{

    /**
     * Generate Category list in Html
     *
     * @param  type $parentId
     * @param  type $isChild
     * @return type
     */
    public function getTreeCategories($parentId, $isChild) 
    {
        $html = "";
        $allCats = Mage::getModel('catalog/category')->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_active', '1')
                ->addAttributeToFilter('include_in_menu', '1')
                ->addAttributeToFilter('parent_id', array('eq' => $parentId))
                ->addAttributeToSort('position', 'asc');

        $class = ($isChild) ? "sub-cat-list" : "cat-list";
        $html .= '<ul class="' . $class . '">';
        foreach ($allCats as $category) {
            $html .= '<li><span>' . $category->getName() . "</span>";
            $subcats = $category->getChildren();
            if ($subcats != '') {
                $html .= $this->getTreeCategories($category->getId(), true);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return (string) $html;
    }

}
