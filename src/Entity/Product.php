<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

/**
 * Продукт
 */
#[ORM\Entity]
/** @final */
class Product
{
    #[ORM\Id, ORM\Column(type: 'uuid', unique: true)]
    private readonly Uuid $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $price;

    public function __construct(string $name, int $price)
    {
        $this->id = new UuidV4();
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
