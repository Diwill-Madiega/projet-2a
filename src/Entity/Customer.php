<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Devis>
     */
    #[ORM\OneToMany(targetEntity: Devis::class, mappedBy: 'customer')]
    private Collection $devis;

    /**
     * @var Collection<int, SellOrder>
     */
    #[ORM\OneToMany(targetEntity: SellOrder::class, mappedBy: 'customer')]
    private Collection $sellOrders;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
        $this->sellOrders = new ArrayCollection();
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


 /**
     * @return Collection<int, DevisLine>
     */
    public function getDevisLines(): Collection
    {
        return $this->devisLines;
    }

    public function addDevisLine(DevisLine $devisLine): self
    {
        if (!$this->devisLines->contains($devisLine)) {
            $this->devisLines[] = $devisLine;
            $devisLine->setCustomer($this);
        }

        return $this;
    }

    public function removeDevisLine(DevisLine $devisLine): self
    {
        if ($this->devisLines->removeElement($devisLine)) {
            // set the owning side to null (unless already changed)
            if ($devisLine->getCustomer() === $this) {
                $devisLine->setCustomer(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Devis>
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): static
    {
        if (!$this->devis->contains($devi)) {
            $this->devis->add($devi);
            $devi->setCustomer($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): static
    {
        if ($this->devis->removeElement($devi)) {
            // set the owning side to null (unless already changed)
            if ($devi->getCustomer() === $this) {
                $devi->setCustomer(null);
            }
        }

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
            $sellOrder->setCustomer($this);
        }

        return $this;
    }

    public function removeSellOrder(SellOrder $sellOrder): static
    {
        if ($this->sellOrders->removeElement($sellOrder)) {
            // set the owning side to null (unless already changed)
            if ($sellOrder->getCustomer() === $this) {
                $sellOrder->setCustomer(null);
            }
        }

        return $this;
    }
}
