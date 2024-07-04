<?php

namespace App\Entity;

use App\Repository\DevisLineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisLineRepository::class)]
class DevisLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'devisLines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Piece $piece = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'DevisLine')]
    private ?Devis $devis = null;

    /**
     * @var Collection<int, SellOrder>
     */
    #[ORM\ManyToMany(targetEntity: SellOrder::class, mappedBy: 'DevisLine')]
    private Collection $sellOrders;

    public function __construct()
    {
        $this->sellOrders = new ArrayCollection();
    }

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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

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

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): static
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * @return Collection<int, SellOrder>
     */
    public function getSellOrders(): Collection
    {
        return $this->sellOrders;
    }

    public function addSellOrder(SellOrder $sellOrder): static
    {
        if (!$this->sellOrders->contains($sellOrder)) {
            $this->sellOrders->add($sellOrder);
            $sellOrder->addDevisLine($this);
        }

        return $this;
    }

    public function removeSellOrder(SellOrder $sellOrder): static
    {
        if ($this->sellOrders->removeElement($sellOrder)) {
            $sellOrder->removeDevisLine($this);
        }

        return $this;
    }
}
