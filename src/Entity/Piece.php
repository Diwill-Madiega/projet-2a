<?php

// src/Entity/Piece.php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?float $buy_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gamme_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gamme_desc = null;

    #[ORM\Column(length: 255)]
    private ?string $unit = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?float $sell_price = null;

    #[ORM\OneToOne(mappedBy: 'piece', cascade: ['persist', 'remove'])]
    private ?Gamme $gamme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'subpieces')]
    private Collection $subpiece;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'subpiece')]
    private Collection $subpieces;

    /**
     * @var Collection<int, BuyOrderLine>
     */
    #[ORM\OneToMany(targetEntity: BuyOrderLine::class, mappedBy: 'piece')]
    private Collection $buyOrderLines;

    /**
     * @var Collection<int, SellOrderLine>
     */
    #[ORM\OneToMany(targetEntity: SellOrderLine::class, mappedBy: 'piece')]
    private Collection $sellOrderLines;

    public function __construct()
    {
        $this->subpiece = new ArrayCollection();
        $this->subpieces = new ArrayCollection();
        $this->buyOrderLines = new ArrayCollection();
        $this->sellOrderLines = new ArrayCollection();
    }

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

    public function getGamme(): ?Gamme
    {
        return $this->gamme;
    }

    public function setGamme(?Gamme $gamme): static
    {
        if ($gamme === null && $this->gamme !== null) {
            $this->gamme->setPiece(null);
        }

        if ($gamme !== null && $gamme->getPiece() !== $this) {
            $gamme->setPiece($this);
        }

        $this->gamme = $gamme;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubpiece(): Collection
    {
        return $this->subpiece;
    }

    public function addSubpiece(self $subpiece): static
    {
        if (!$this->subpiece->contains($subpiece)) {
            $this->subpiece->add($subpiece);
        }

        return $this;
    }

    public function removeSubpiece(self $subpiece): static
    {
        $this->subpiece->removeElement($subpiece);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubpieces(): Collection
    {
        return $this->subpieces;
    }

    /**
     * @return Collection<int, BuyOrderLine>
     */
    public function getBuyOrderLines(): Collection
    {
        return $this->buyOrderLines;
    }

    public function addBuyOrderLine(BuyOrderLine $buyOrderLine): static
    {
        if (!$this->buyOrderLines->contains($buyOrderLine)) {
            $this->buyOrderLines->add($buyOrderLine);
            $buyOrderLine->setPiece($this);
        }

        return $this;
    }

    public function removeBuyOrderLine(BuyOrderLine $buyOrderLine): static
    {
        if ($this->buyOrderLines->removeElement($buyOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($buyOrderLine->getPiece() === $this) {
                $buyOrderLine->setPiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SellOrderLine>
     */
    public function getSellOrderLines(): Collection
    {
        return $this->sellOrderLines;
    }

    public function addSellOrderLine(SellOrderLine $sellOrderLine): static
    {
        if (!$this->sellOrderLines->contains($sellOrderLine)) {
            $this->sellOrderLines->add($sellOrderLine);
            $sellOrderLine->setPiece($this);
        }

        return $this;
    }

    public function removeSellOrderLine(SellOrderLine $sellOrderLine): static
    {
        if ($this->sellOrderLines->removeElement($sellOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($sellOrderLine->getPiece() === $this) {
                $sellOrderLine->setPiece(null);
            }
        }

        return $this;
    }
}