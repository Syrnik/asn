<?php
return array(
    'name'     => 'Automatic SKU ID Generator',
    'icon'     => 'img/asn.gif',
    'version'  => '1.0.0',
    'vendor'   => '670917',
    'handlers' =>
        array('product_save' => 'hookProductSave'),
);
