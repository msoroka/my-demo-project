<?php

namespace App\Command\Import;

use Pimcore\Model\DataObject\Fieldcollection\Data\TaxEntry;
use Pimcore\Model\DataObject\OnlineShopTaxClass;
use Pimcore\Model\DataObject\Service;
use Pimcore\Model\DataObject\Fieldcollection;
use Pimcore\Model\WebsiteSetting;

class TaxImport
{
    const CLASS_KEY = 'baseTax';
    const CLASS_PATH = '/Shop Management/Taxes';
    const TAX_NAME = 'VAT 23%';
    const TAX_PERCENTAGE = '23';
    const WEBSITE_SETTING_NAME = 'defaultTaxClass';

    public function __construct()
    {
        $taxObject = OnlineShopTaxClass::getByPath(self::CLASS_PATH . '/' . self::CLASS_KEY);

        if (!$taxObject) {
            $taxObject = new OnlineShopTaxClass();
            try {
                $taxObject->setParent(Service::createFolderByPath(self::CLASS_PATH));
            } catch (\Exception $e) {
            }
            $taxObject->setKey(self::CLASS_KEY);
        }

        $taxObject->setPublished(true);
        $taxObject->setTaxEntryCombinationType('combine');

        $items = new Fieldcollection();

        $taxEntry = new TaxEntry();
        $taxEntry->setName(self::TAX_NAME);
        $taxEntry->setPercent(self::TAX_PERCENTAGE);

        $items->add($taxEntry);

        $taxObject->setTaxEntries($items);

        try {
            $taxObject->save();
        } catch (\Exception $e) {
        }

        $defaultTaxClass = WebsiteSetting::getByName(self::WEBSITE_SETTING_NAME);

        if(is_null($defaultTaxClass)) {
            $defaultTaxClass = new WebsiteSetting();
        }

        $defaultTaxClass->setName(self::WEBSITE_SETTING_NAME);
        $defaultTaxClass->setType('object');
        $defaultTaxClass->setData($taxObject);
        $defaultTaxClass->save();
    }
}
