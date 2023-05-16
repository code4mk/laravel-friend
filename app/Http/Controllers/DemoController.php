<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\DataNotFoundException;
use App\Http\Resources\Demo\DemoResource;
use App\Repositories\Demo\DemoRepository;
use App\Http\Resources\Demo\DemoCollection;

class DemoController extends Controller
{
    private $repository;

    public function __construct(DemoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrive items.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request instance.
     * @return App\Http\Resources\Demo\DemoCollection Returns a collection of  resources.
     */
    public function getDemos(Request $request): DemoCollection
    {
        $demos = $this->repository->getDemos($request);

        return new DemoCollection($demos);
    }

    /**
     * Retrieve a item by ID.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request instance.
     * @param  int  $demoId.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response containing the ID of the requested item.
     */
    public function getDemoById(Request $request, $demoId)
    {
        try {
            $demo = $this->repository->getDemoById($request, $demoId);

            return new DemoResource($demo);
        } catch (\Exception $e) {
            if ($e instanceof DataNotFoundException) {
                throw $e;
            }
            throw $e;
        }

    }

    public function createDemo(Request $request)
    {
        $item = $this->repository->createDemo($request);

        return new DemoResource($item);
    }

    /**
     * Update specific item.
     *
     * @param  string|int  $demoId
     */
    public function updateDemo(Request $request, $demoId)
    {

        $demo = $this->repository->updateDemo($request, $demoId);

        return new DemoResource($demo);
    }

    /**
     * Delete specific item.
     *
     * @param  \Illuminate\Http\Request  $request - Request instance.
     * @param string|int demoId
     */
    public function deleteDemo(Request $request, $demoId)
    {
        try {
            $demo = $this->repository->deleteDemo($request, $demoId);

            return response()->json([
                'message' => "demo is deleted.  id no - {$demo->id}",
            ], 200);

        } catch (\Exception $e) {

            if ($e instanceof DataNotFoundException) {
                throw $e;
            }
            throw $e;
        }
    }
}
