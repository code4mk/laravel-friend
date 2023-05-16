<?php

namespace App\Repositories\Demo;

use App\Models\Demo;
use Illuminate\Http\Request;
use App\Exceptions\DataNotFoundException;

class EloquentDemoRepository implements DemoRepository
{
    /**
     * Retrieve data.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request instance.
     * @return \Illuminate\Pagination\LengthAwarePaginator Returns a paginated list of RestaurantOrder instances.
     */
    public function getDemos(Request $request)
    {
        $query = Demo::query();

        // Retrive data(all|paginate based on query string).
        $demos = retrieve_data($request, $query);

        return $demos;
    }

    /**
     * Get specific data with id
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request instance.
     * @param $demoId - the id of demo.
     */
    public function getDemoById(Request $request, $demoId)
    {
        $demo = Demo::where('id', $demoId)->first();

        if (! $demo) {
            throw new DataNotFoundException([
                'demo_id' => $demoId,
                'message' => "Demo is not found with id {$demoId}."]);
        }

        return $demo;
    }

    /**
     * Add a new item.
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function createDemo(Request $request)
    {

        $demo = new Demo();
        $demo->title = $request->input('title');
        $demo->description = $request->input('description', null);
        $demo->save();

        $demo->id;

        return $demo;
    }

    /**
     * Update a specific item.
     *
     * @param @param  Illuminate\Http\Request  $request
     * @param  string|int  $demoId
     */
    public function updateDemo(Request $request, $demoId)
    {
        $demo = Demo::where('id', $demoId)->first();

        if (! $demo) {
            throw new DataNotFoundException([
                'demo_id' => $demoId,
                'message' => "Demo is not found with id {$demoId}."]);
        }

        if ($request->has('title')) {
            $demo->title = $request->input('title');
        }

        if ($request->has('description')) {
            $demo->description = $request->input('description');
        }

        $demo->save();

        return $demo;
    }

    /**
     * Delete a specific item.
     *
     * @param @param  Illuminate\Http\Request  $request
     * @param  string|int  $demoId
     */
    public function deleteDemo(Request $request, $demoId)
    {
        $demo = Demo::where('id', $demoId)->first();

        if (! $demo) {
            throw new DataNotFoundException([
                'demo_id' => $demoId,
                'message' => 'Demo is not found or deleted']);
        }

        $deletedItem = $demo;

        $demo->delete();

        return $deletedItem;
    }
}
