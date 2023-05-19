<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\CountryRepository;

class CalculateTax
{
    public function __construct(private readonly CountryRepository $countyRepository)
    {
    }

    public function __invoke(Product $product, string $taxNumber): float
    {
        $country = $this->countyRepository->findByTxNumber($taxNumber);

        if ($country === null) {
            throw new \RuntimeException('Страна не найдена');
        }

        return $product->getPrice() * $country->getTax() / 100;
    }
}
