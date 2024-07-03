<?php

namespace App\Entity;

use App\Repository\BuyOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuyOrderRepository::class)]
class BuyOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'buyOrders')]
    #[ORM\JoinColumn(nullable: false)]

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, BuyOrderLine>
     */
    #[ORM\OneToMany(targetEntity: BuyOrderLine::class, mappedBy: 'buyOrder', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $buyOrderLines;

    #[ORM\ManyToOne(inversedBy: 'buyOrders')]
    private ?Furnisher $furnisher = null;

    public function __construct()
    {
        $this->buyOrderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $buyOrderLine->setBuyOrder($this);
        }

        return $this;
    }

    public function removeBuyOrderLine(BuyOrderLine $buyOrderLine): static
    {
        if ($this->buyOrderLines->removeElement($buyOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($buyOrderLine->getBuyOrder() === $this) {
                $buyOrderLine->setBuyOrder(null);
            }
        }

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
}
