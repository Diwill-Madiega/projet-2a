<?php

namespace App\Entity;

use App\Repository\FurnisherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FurnisherRepository::class)]
class Furnisher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, BuyOrder>
     */
    #[ORM\OneToMany(targetEntity: BuyOrder::class, mappedBy: 'furnisher')]
    private Collection $buyOrders;

    public function __construct()
    {
        $this->buyOrders = new ArrayCollection();
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
     * @return Collection<int, BuyOrder>
     */
    public function getBuyOrders(): Collection
    {
        return $this->buyOrders;
    }

    public function addBuyOrder(BuyOrder $buyOrder): static
    {
        if (!$this->buyOrders->contains($buyOrder)) {
            $this->buyOrders->add($buyOrder);
            $buyOrder->setFurnisher($this);
        }

        return $this;
    }

    public function removeBuyOrder(BuyOrder $buyOrder): static
    {
        if ($this->buyOrders->removeElement($buyOrder)) {
            // set the owning side to null (unless already changed)
            if ($buyOrder->getFurnisher() === $this) {
                $buyOrder->setFurnisher(null);
            }
        }

        return $this;
    }
}
