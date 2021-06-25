<?php

namespace App\Ecommerce\Model;

abstract class AbstractProduct extends \Pimcore\Bundle\EcommerceFrameworkBundle\Model\AbstractProduct
{
    /**
     * @param bool $inProductList
     * @return bool
     */
    public function isActive(bool $inProductList = false): bool
    {
        return $this->isPublished();
    }

    /**
     * @return string|null
     */
    public function getPriceSystemName(): ?string
    {
        return 'default';
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        $saleData = $this->getSaleData();
        $saleInformation = $saleData->getSaleData();
        if ($saleInformation) {
            return $saleInformation->getPrice();
        }

        return null;
    }
}
