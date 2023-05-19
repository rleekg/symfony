<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

/**
 * Страны
 */
#[ORM\Entity(repositoryClass: CountryRepository::class)]
/** @final */
class Country
{
    #[ORM\Id, ORM\Column(type: 'uuid', unique: true)]
    private readonly Uuid $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $code;

    #[ORM\Column]
    private int $tax;

    public function __construct(string $name, string $code, int $tax)
    {
        $this->id = new UuidV4();
        $this->name = $name;
        $this->code = $code;
        $this->tax = $tax;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTax(): int
    {
        return $this->tax;
    }
}
