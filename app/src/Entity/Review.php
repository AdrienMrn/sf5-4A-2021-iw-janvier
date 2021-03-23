<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=RealEstateAd::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     */
    private $realEstateAd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRealEstateAd(): ?RealEstateAd
    {
        return $this->realEstateAd;
    }

    public function setRealEstateAd(?RealEstateAd $realEstateAd): self
    {
        $this->realEstateAd = $realEstateAd;

        return $this;
    }
}
