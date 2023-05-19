<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

final class CalculateTaxRequest
{
    #[Assert\NotBlank()]
    public Product $product;

    #[Assert\NotBlank()]
    #[Assert\Regex('/^(DE|IT|GR)?[0-9]{9,10}$/')]
    public string $taxNumber;
}
