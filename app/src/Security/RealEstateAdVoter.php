<?php

namespace App\Security;

use App\Entity\RealEstateAd;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class RealEstateAdVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof RealEstateAd) {
            return false;
        }

        return true;
    }

    /**
     *
     * @param string $attribute
     * @param TokenInterface $token
     * @return bool
     * @var RealEstateAd $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($subject, $user);
            case self::DELETE:
                return $this->canDelete($subject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(RealEstateAd $realEstateAd, User $user): bool
    {
       return $user === $realEstateAd->getOwner();
    }

    private function canDelete(RealEstateAd $realEstateAd, User $user): bool
    {
        return self::canEdit($realEstateAd, $user);
    }
}