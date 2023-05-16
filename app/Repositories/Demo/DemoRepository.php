<?php

namespace App\Repositories\Demo;

use Illuminate\Http\Request;

interface DemoRepository
{
    public function getDemos(Request $request);

    public function getDemoById(Request $request, $demoId);

    public function createDemo(Request $request);

    public function updateDemo(Request $request, $demoId);

    public function deleteDemo(Request $request, $demoId);
}
