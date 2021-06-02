<?php

namespace App\Services;

use App\Enums\FollowEnum;
use App\Enums\PostEnum;
use App\Enums\ReportEnum;
use App\Repositories\Follow\FollowRepositoryInterface;
use App\Repositories\Interest\InterestRepositoryInterface;
use App\Repositories\Reason\LabelReasonRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     *
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UploadService
     */
    private $uploadService;


    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UploadService $uploadService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UploadService $uploadService
    ) {
        $this->userRepository = $userRepository;
        $this->uploadService = $uploadService;
    }

    public function changePassword($user, $currentPassword, $newPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            $code = config('api.code.password_does_not_match');
            $message = trans('user.error.password_does_not_match');
        } elseif (strcmp($currentPassword, $newPassword) == 0) {
            $code = config('api.code.same_password');
            $message = trans('user.error.same_password');
        } else {
            $code = Response::HTTP_OK;
            $user->update(['password' => Hash::make($newPassword)]);

            $message = trans('user.change_password_successfully');
        }

        return ['code' => $code, 'message' => $message];
    }

    public function getProfile($user)
    {
        return $this->userRepository->getProfile($user);
    }

    public function updateProfile($data, $user, $avatars = null, $covers = null)
    {
        $this->userRepository->update($user, $data);

        return $this->userRepository->getProfile($user);
    }
}
