<?php

namespace Arsy\App\Helper;


use Arsy\App\Model\User;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class SplObjectStorageHelper extends SplObjectStorage
{
    /**
     * @param SplObjectStorage $userObjectStorage
     * @param ConnectionInterface $connection
     * @return User|false
     */
    public static function containsUser(SplObjectStorage $userObjectStorage, ConnectionInterface $connection)
    {
        if (!($userObjectStorage->count() > 0)) {
            return false;
        }

        /** @var User $user */
        foreach ($userObjectStorage as $user) {
            if ($user->getId() == $connection->resourceId) {
                return $user;
            }
        }

        return false;
    }
}