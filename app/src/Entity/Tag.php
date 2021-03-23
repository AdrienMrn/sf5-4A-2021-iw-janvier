<?php

namespace App\Entity;

use App\Entity\Traits\SortableTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    use SortableTrait;
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=RealEstateAd::class, mappedBy="tags")
     */
    private $realEstateAds;

    public function __construct()
    {
        $this->realEstateAds = new ArrayCollection();
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

    /**
     * @return Collection|RealEstateAd[]
     */
    public function getRealEstateAds(): Collection
    {
        return $this->realEstateAds;
    }

    public function addRealEstateAd(RealEstateAd $realEstateAd): self
    {
        if (!$this->realEstateAds->contains($realEstateAd)) {
            $this->realEstateAds[] = $realEstateAd;
            $realEstateAd->addTag($this);
        }

        return $this;
    }

    public function removeRealEstateAd(RealEstateAd $realEstateAd): self
    {
        if ($this->realEstateAds->removeElement($realEstateAd)) {
            $realEstateAd->removeTag($this);
        }

        return $this;
    }
}
