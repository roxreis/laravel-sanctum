<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;;

class BookController extends Controller
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBooks()
    {
        return response()->json(
            $this->repository->paginate()
        );
    }

    public function create()
    {
        //
    }

    public function postBook(StoreBookRequest $request)
    {
        $payload = $this->repository->getPayloadValidated($request);
        return response()->json(
            $this->repository->create($payload),
            Response::HTTP_CREATED
        );
    }

    public function getBook(int $id)
    {
        return response()->json(
            $this->repository->find($id)
        );
    }

    public function edit(Book $book)
    {
        //
    }

    public function putBook(UpdateBookRequest$request, int $id)
    {
        $payload = $this->repository->getPayloadValidated($request);
        return response()->json(
            $this->repository->update($id, $payload)
        );
    }

    public function deleteBook(int $id)
    {
        return response()->json(
            $this->repository->delete($id),
            Response::HTTP_NO_CONTENT
        );
    }
}
