<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectStoreRequest;
use App\Http\Resources\SubjectResources;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SubjectResources::collection(Subject::with('books')->get());
    }

    public function show(Subject $subject): SubjectResources
    {
        $subject->load('books');
        return new SubjectResources($subject);
    }

    public function store(SubjectStoreRequest $request): JsonResponse
    {
        $subject = new Subject();
        $subject->name = $request->input('name');
        $subject->save();

        return new JsonResponse([
            'data' => new SubjectResources($subject),
            'message' => "Success!"
        ]);
    }

    public function update(SubjectStoreRequest $request, Subject $subject): JsonResponse
    {
        $subject->name = $request->input('name');
        $subject->save();

        return new JsonResponse([
            'data' => new SubjectResources($subject),
            'message' => "Success!"
        ]);
    }

    public function destroy(Subject $subject): JsonResponse
    {
        $subject->delete();

        return new JsonResponse([
            'data' => [],
            'message' => "Success!"
        ]);
    }
}
