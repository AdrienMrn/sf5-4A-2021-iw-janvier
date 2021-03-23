<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
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
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return Tag
     */
    public function setPosition($position)
    {
        $this->position = $position;
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
