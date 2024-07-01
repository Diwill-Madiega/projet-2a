<?php

namespace App\Entity;

use App\Repository\BuyOrderLineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuyOrderLineRepository::class)]
class BuyOrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'buyOrderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Piece $piece = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'buyOrderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Furnisher $furnisher = null;

    #[ORM\ManyToOne(inversedBy: 'buyOrderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BuyOrder $buyOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): static
    {
        $this->piece = $piece;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFurnisher(): ?Furnisher
    {
        return $this->furnisher;
    }

    public function setFurnisher(?Furnisher $furnisher): static
    {
        $this->furnisher = $furnisher;

        return $this;
    }

    public function getBuyOrder(): ?BuyOrder
    {
        return $this->buyOrder;
    }

    public function setBuyOrder(?BuyOrder $buyOrder): static
    {
        $this->buyOrder = $buyOrder;

        return $this;
    }
}
