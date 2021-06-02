<?php

namespace App\Repositories\User;

use App\Enums\BlockEnum;
use App\Enums\FollowEnum;
use App\Models\User;
use App\Enums\UserRole;
use App\Repositories\BaseRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     * @param DatabaseManager $db
     */
    public function __construct(User $model, DatabaseManager $db)
    {
        parent::__construct($model);

        $this->db = $db;
    }

    public function getUserByRole($role)
    {
        return $this->model->role($role);
    }


    public function getProfile($user)
    {
        return $user;
    }

    public function getProfileAdmin($userId)
    {
        return $this->model->where('id', $userId)->with(['roles', 'roles.permissions'])->first();
    }

    // CMS FUNCTIONS
    /**
     * Get Profile Detail account for CMS
     *
     * @param request
     *
     * @return model
     */
    public function getProfileAccountCms($id)
    {
        return $this->model->with(['roles', 'roles.permissions'])->findOrFail($id);
    }
}
