<?php

// src/Entity/Piece.php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ref = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $buy_price = null; // Updated field

    #[ORM\Column(length: 255)]
    private ?string $gamme_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gamme_desc = null;

    #[ORM\Column(length: 255)]
    private ?string $unit = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?float $sell_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBuyPrice(): ?float
    {
        return $this->buy_price;
    }

    public function setBuyPrice(?float $buy_price): static
    {
        $this->buy_price = $buy_price;

        return $this;
    }

    public function getGammeName(): ?string
    {
        return $this->gamme_name;
    }

    public function setGammeName(string $gamme_name): static
    {
        $this->gamme_name = $gamme_name;

        return $this;
    }

    public function getGammeDesc(): ?string
    {
        return $this->gamme_desc;
    }

    public function setGammeDesc(?string $gamme_desc): static
    {
        $this->gamme_desc = $gamme_desc;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getSellPrice(): ?float
    {
        return $this->sell_price;
    }

    public function setSellPrice(?float $sell_price): static
    {
        $this->sell_price = $sell_price;

        return $this;
    }
}