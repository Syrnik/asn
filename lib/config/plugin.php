<?php
/**
 * Automatic SKU ID Generator plugin for Shop-Script 6
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2015-2022
 * @license http://www.webasyst.com/terms/#eula Webasyst
 * @package asn.config
 */
return array(
    'name'     => 'Генератор имен артикулов',
    'img'      => 'img/asn.png',
    'version'  => '2.0.0',
    'vendor'   => '670917',
    'handlers' =>
        array(
            'product_save'      => 'hookProductSave',
            'product_duplicate' => 'hookProductDuplicate'
        ),
);
