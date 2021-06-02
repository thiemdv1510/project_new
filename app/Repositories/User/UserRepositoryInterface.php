<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Repositories\User
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getProfile($user);

    public function getProfileAdmin($userId);

    public function getProfileAccountCms($id);
}
