<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserRepository
{
  const PAGINATION_SIZE = 10;

  private Builder $query;

  public function __construct()
  {
    $this->query = User::query();
  }

  public function find(int $id)
  {
    $hasRegister = $this->findRegisterByParam('id', $id);
    if ($hasRegister === 0)
      return response()->json([
        'message' => 'This id not exist'
      ], 404);

    return $this->query->findOrFail($id);
  }

  public function paginate()
  {
    $hasRegister = DB::table('users')->get()->count();
    if ($hasRegister === 0)
      return response()->json([
        'message' => 'Not content'
      ], 204);

    return $this->query->paginate(self::PAGINATION_SIZE);
  }

  public function findRegisterByParam(string $column, int $value): int
  {
    return DB::table('users')->where("$column", $value)->count();
  }


  public function create(array $payload)
  {
    $hasRegister = $this->findRegisterByParam('cpf', $payload['cpf']);;
    if ($hasRegister > 0)
      return response()->json([
        'message' => 'This cpf already exist'
      ], 502);

    return $this->query->create($payload);
  }


  public function update(int $id, array $payload)
  {
    $hasRegister =  $this->findRegisterByParam('id', $id);
    if ($hasRegister === 0)
      return response()->json([
        'message' => 'This address not exist'
      ], 404);

    $this->query->find($id)->update($payload);
    return $this->query->find($id);
  }

  public function getPayloadFromRequest($data)
  {
    // $addressData = $service->getAddressByZipcode($data['zip_code']);
    // if (array_key_exists('erro', $addressData))
    //   return response()->json([
    //     'message' => 'This address not exist'
    //   ], 404);

    return [
      'user_name' => $data['user_name'],
      'cpf' => $data['cpf'],
    ];
  }

  public function delete(int $id)
  {
    $hasRegister =  $this->findRegisterByParam('id', $id);
    if ($hasRegister === 0)
      return response()->json([
        'message' => 'This address not exist'
      ], 404);

    return $this->query->findOrFail($id)->delete();
  }
}
