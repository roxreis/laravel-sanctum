<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\UserRepository;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;;

use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUsers()
    {
        return response()->json(
            $this->repository->paginate()
        );
    }

    public function create()
    {
        //
    }

    public function postUser(StoreUserRequest $request)
    {
        $payload = $this->repository->getPayloadValidated($request);
        return response()->json(
            $this->repository->create($payload),
            Response::HTTP_CREATED
        );
    }

    public function getUser(int $id)
    {
        return response()->json(
            $this->repository->find($id)
        );
    }

    public function edit(User $user)
    {
    }

    public function putUser(UpdateUserRequest $request, int $id)
    {
        $payload = $this->repository->getPayloadValidated($request);
        return response()->json(
            $this->repository->update($id, $payload)
        );
    }

    public function deleteUser(int $id)
    {
        return response()->json(
            $this->repository->delete($id),
            Response::HTTP_NO_CONTENT
        );
    }
}
