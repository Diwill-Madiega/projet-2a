<?php

namespace App\Entity;

use App\Repository\GammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GammeRepository::class)]
class Gamme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'gammes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToOne(inversedBy: 'gamme', cascade: ['persist', 'remove'])]
    private ?Piece $piece = null;

    /**
     * @var Collection<int, Operation>
     */
    #[ORM\ManyToMany(targetEntity: Operation::class, inversedBy: 'gammes')]
    private Collection $operation;

    public function __construct()
    {
        $this->operation = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
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

    /**
     * @return Collection<int, Operation>
     */
    public function getOperation(): Collection
    {
        return $this->operation;
    }

    public function addOperation(Operation $operation): static
    {
        if (!$this->operation->contains($operation)) {
            $this->operation->add($operation);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): static
    {
        $this->operation->removeElement($operation);

        return $this;
    }
}
