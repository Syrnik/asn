<?php
/**
 * Automatic SKU ID Generator plugin for Shop-Script 6
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.1.0
 * @copyright Serge Rodovnichenko, 2015-2022
 * @license http://www.webasyst.com/terms/#eula Webasyst
 * @package asn
 */

/**
 * Main plugin class
 */
class shopAsnPlugin extends shopPlugin
{
    /**
     * @EventHandler product_save
     * @param $data
     * @return void
     */
    public function hookProductSave($data): void
    {
        if ($this->getSettings('use')) {
            $product = ifset($data['instance']);
            if ($product && isset($product['skus']) && is_array($product['skus'])) {
                $Sku = new shopProductSkusModel();
                $skus = array();
                try {
                    $view = wa()->getView();
                } catch (waException $e) {
                    return;
                }
                $template = $this->getSettings('template');
                if (empty($template)) {
                    $template = '{$sku_id}';
                }

                foreach ($product['skus'] as $key => $sku) {
                    $skus[$key] = $sku;
                    if (isset($sku['sku'], $sku['id']) && !strlen($sku['sku'])) {
                        $view->assign('sku_id', $sku['id']);
                        try {
                            $sku['sku'] = $view->fetch('string:' . $template);
                            $new_sku = $Sku->update($sku['id'], $sku);
                            if ($new_sku) {
                                $skus[$key] = $sku;
                            } else {
                                if (wa()->getConfig()::isDebug()) {
                                    waLog::log("Error updating ID of SKU. Data: " . print_r($sku, true), 'asn.log');
                                }
                            }
                        } catch (waException|SmartyException $e) {
                            //do nothing
                        }
                    }
                }
                $product['skus'] = $skus;
            }
        }
    }
}
