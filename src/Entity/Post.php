<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Machine>
     */
    #[ORM\ManyToMany(targetEntity: Machine::class, inversedBy: 'posts')]
    private Collection $machine;

    public function __construct()
    {
        $this->machine = new ArrayCollection();
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
