<?php

namespace App\Repository;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BookRepository
{
  const PAGINATION_SIZE = 10;

  private Builder $query;

  public function __construct()
  {
    $this->query = Book::query();
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

  public function findRegisterByParam(string $column, mixed $value): mixed
  {
    return DB::table('books')->where("$column", $value)->count();
  }


  public function create(array $payload)
  {
    $hasRegister = $this->findRegisterByParam('book_name', $payload['book_name']);;
    if ($hasRegister > 0)
      return response()->json([
        'message' => 'This book_name already exist'
      ], 502);

    return $this->query->create($payload);
  }


  public function update(int $id, array $payload)
  {
    $hasRegister =  $this->findRegisterByParam('id', $id);
    if ($hasRegister === 0)
      return response()->json([
        'message' => 'This id not exist'
      ], 404);
  
    $this->query->find($id)->update($payload);

    return $this->query->find($id);
  }

  public function getPayloadValidated($data)
  {
    $validated = array_merge($data->validated());

    return $validated;
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
