<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rule;

    /**
     * @ORM\ManyToMany(targetEntity=Plateform::class, inversedBy="games")
     */
    private $plateforms;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="games")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="game")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Run::class, mappedBy="game")
     */
    private $runs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link_img;

    public function __construct()
    {
        $this->plateforms = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->runs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRule(): ?string
    {
        return $this->rule;
    }

    public function setRule(?string $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * @return Collection|Plateform[]
     */
    public function getPlateforms(): Collection
    {
        return $this->plateforms;
    }

    public function addPlateform(Plateform $plateform): self
    {
        if (!$this->plateforms->contains($plateform)) {
            $this->plateforms[] = $plateform;
        }

        return $this;
    }

    public function removePlateform(Plateform $plateform): self
    {
        $this->plateforms->removeElement($plateform);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setGame($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getGame() === $this) {
                $category->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Run[]
     */
    public function getRuns(): Collection
    {
        return $this->runs;
    }

    public function addRun(Run $run): self
    {
        if (!$this->runs->contains($run)) {
            $this->runs[] = $run;
            $run->setGame($this);
        }

        return $this;
    }

    public function removeRun(Run $run): self
    {
        if ($this->runs->removeElement($run)) {
            // set the owning side to null (unless already changed)
            if ($run->getGame() === $this) {
                $run->setGame(null);
            }
        }

        return $this;
    }

    public function getLinkImg(): ?string
    {
        return $this->link_img;
    }

    public function setLinkImg(string $link_img): self
    {
        $this->link_img = $link_img;

        return $this;
    }
}
