<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $duration = null;

    /**
     * @var Collection<int, Gamme>
     */
    #[ORM\ManyToMany(targetEntity: Gamme::class, mappedBy: 'operations')]
    private Collection $gammes;

    #[ORM\ManyToOne(inversedBy: 'operations')]
    private ?Post $post = null;

    /**
     * @var Collection<int, Machine>
     */
    #[ORM\ManyToMany(targetEntity: Machine::class, inversedBy: 'operations')]
    private Collection $machine;

    public function __construct()
    {
        $this->gammes = new ArrayCollection();
        $this->machine = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name; // or any other string representation of your operation
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, Gamme>
     */
    public function getGammes(): Collection
    {
        return $this->gammes;
    }

    public function addGamme(Gamme $gamme): static
    {
        if (!$this->gammes->contains($gamme)) {
            $this->gammes->add($gamme);
            $gamme->addOperation($this);
        }

        return $this;
    }

    public function removeGamme(Gamme $gamme): static
    {
        if ($this->gammes->removeElement($gamme)) {
            $gamme->removeOperation($this);
        }

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return Collection<int, Machine>
     */
    public function getMachine(): Collection
    {
        return $this->machine;
    }

    public function addMachine(Machine $machine): static
    {
        if (!$this->machine->contains($machine)) {
            $this->machine->add($machine);
        }

        return $this;
    }

    public function removeMachine(Machine $machine): static
    {
        $this->machine->removeElement($machine);

        return $this;
    }
}
