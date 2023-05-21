<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AuthorResource::collection(Author::all());
    }

    public function show(Author $author): AuthorResource
    {
        return new AuthorResource($author);
    }

    public function store(AuthorStoreRequest $request): JsonResponse
    {
        $author = new Author();
        $author->first_name = $request->input('first_name');
        $author->last_name = $request->input('last_name');
        $author->birthday = $request->input('birthday');
        $author->save();

        return new JsonResponse([
            'data' => new AuthorResource($author),
            'message' => "Success!"
        ]);
    }

    public function update(AuthorStoreRequest $request, Author $author): JsonResponse
    {
        $author->first_name = $request->input('first_name');
        $author->last_name = $request->input('last_name');
        $author->birthday = $request->input('birthday');
        $author->save();

        return new JsonResponse([
            'data' => new AuthorResource($author),
            'message' => "Success!"
        ]);
    }

    public function destroy(Author $author): JsonResponse
    {
        $author->delete();

        return new JsonResponse([
            'data' => [],
            'message' => "Success!"
        ]);
    }
}
