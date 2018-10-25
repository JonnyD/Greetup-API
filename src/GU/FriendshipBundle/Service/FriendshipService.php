<?php

namespace GU\FriendshipBundle\Service;

use GU\FriendshipBundle\Entity\Friendship;
use GU\FriendshipBundle\Repository\FriendshipRepository;
use GU\UserBundle\Entity\User;

class FriendshipService
{
    /**
     * @var FriendshipRepository
     */
    private $friendshipRepository;

    /**
     * @param FriendshipRepository $friendshipRepository
     */
    public function __construct(FriendshipRepository $friendshipRepository)
    {
        $this->friendshipRepository = $friendshipRepository;
    }

    /**
     * @param int $id
     * @return null|Friendship
     */
    public function getFriendshipById(int $id)
    {
        return $this->friendshipRepository->find($id);
    }

    /**
     * @param User $user
     * @return User[]
     */
    public function getAllFriendsForUser(User $user)
    {
        $friendships = $this->friendshipRepository->findFriendshipsByUser($user);

        $friends = [];
        foreach ($friendships as $friendship)
        {
            if ($friendship->getUser() == $user) {
                $friends[] = $friendship->getFriend();
            } else {
                $friends[] = $friendship->getUser();
            }
        }

        return $friends;
    }

    public function isFriend(User $user, User $friend)
    {
        $currentFriends = $this->getAllFriendsForUser($user);

        foreach ($currentFriends as $currentFriend) {
            if ($friend == $currentFriend) {
                return true;
            }
        }

        return false;
    }

    public function save(Friendship $friendship, bool $sync = true)
    {
        $this->friendshipRepository->save($friendship);
    }
}