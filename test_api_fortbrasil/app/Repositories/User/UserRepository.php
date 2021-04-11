<?php


namespace App\Repositories\User;


use App\Contracts\Repository\AbstractRepository;
use App\Models\User\User;

class UserRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->setModel(User::class);
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function userRegister(array $request)
    {
        $user = $this->getModel()::create($request);

        return $user;
    }
}
