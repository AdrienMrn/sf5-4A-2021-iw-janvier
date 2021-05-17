<?php

namespace App\Twig;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    /**
     * @var EntityManagerInterface $om
     */
    private $om;

    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getTags', [$this, 'getTags']),
        ];
    }

    public function getTags()
    {
        return $this->om->getRepository(Tag::class)->findAll();
    }
}