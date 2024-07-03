<?php

// src/Entity/Devis.php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'devis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deadline = null;

    #[ORM\Column]
    private ?float $totalCost = null;

    /**
     * @var Collection<int, DevisLine>
     */
    #[ORM\OneToMany(targetEntity: DevisLine::class, mappedBy: 'devis', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $devisLines;

    public function __construct()
    {
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): static
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function setTotalCost(float $totalCost): static
    {
        $this->totalCost = $totalCost;

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
            $devisLine->setDevis($this);
        }

        return $this;
    }

    public function removeDevisLine(DevisLine $devisLine): static
    {
        if ($this->devisLines->removeElement($devisLine)) {
            // set the owning side to null (unless already changed)
            if ($devisLine->getDevis() === $this) {
                $devisLine->setDevis(null);
            }
        }

        return $this;
    }
}
