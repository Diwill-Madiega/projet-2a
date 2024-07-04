<?php

namespace App\Entity;

use App\Repository\SellOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SellOrderRepository::class)]
class SellOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    /**
     * @var Collection<int, SellOrderLine>
     */
    #[ORM\OneToMany(targetEntity: SellOrderLine::class, mappedBy: 'sellOrder')]
    private Collection $sellOrderLines;

    /**
     * @var Collection<int, DevisLine>
     */
    #[ORM\ManyToMany(targetEntity: DevisLine::class, inversedBy: 'sellOrders')]
    private Collection $devisLines;

    #[ORM\ManyToOne(inversedBy: 'sellOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function __construct()
    {
        $this->sellOrderLines = new ArrayCollection();
        $this->devisLines = new ArrayCollection();
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

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

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
            $sellOrderLine->setSellOrder($this);
        }

        return $this;
    }

    public function removeSellOrderLine(SellOrderLine $sellOrderLine): static
    {
        if ($this->sellOrderLines->removeElement($sellOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($sellOrderLine->getSellOrder() === $this) {
                $sellOrderLine->setSellOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevisLine>
     */
    public function getDevisLines(): Collection
    {
        return $this->devisLines;
    }

    public function addDevisLine(DevisLine $devisLine): static
    {
        if (!$this->devisLines->contains($devisLine)) {
            $this->devisLines->add($devisLine);
        }

        return $this;
    }

    public function removeDevisLine(DevisLine $devisLine): static
    {
        $this->devisLines->removeElement($devisLine);

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }
}
