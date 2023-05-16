<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

if (! function_exists('retrieve_data')) {
    function retrieve_data($request, $query, $per_page = 15)
    {
        $count = $query->count();

        if ($count < 100 && $request->has('show_all') && $request?->show_all == 'true') {
            $data = $query->get();
        } else {
            $per_page = $request->query('per_page', $per_page);
            $data = $query->paginate($per_page);
        }

        return $data;
    }
}

if (! function_exists('retrieve_by_sorting')) {
    /**
     * Sorting data.
     *
     * @param $instance - model
     * @param $query
     * @return $query.
     */
    function retrieve_by_sorting($instance, $query)
    {
        if (request()->has('sort')) {
            $sort = request()->query('sort');

            $sorts = explode(',', $sort);

            foreach ($sorts as $sort) {
                $column = ltrim($sort, '-');

                if (($instance)->checkIfColumnExists($column)) {
                    $direction = Str::startsWith($sort, '-') ? 'desc' : 'asc';
                    $query->orderBy($column, $direction);
                }
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}

if (! function_exists('retrieve_with_date_range')) {
    /**
     * Filter data with date range.
     *
     * @param $query
     * @param  array  $dates
     * @return $query.
     */
    function retrieve_with_date_range($query, $dates, $column = 'created_at')
    {
        $startDate = Carbon::parse($dates[0]);
        $endDate = Carbon::parse($dates[1]);

        if ($startDate == $endDate) {
            $query->whereDate($column, $startDate);
        } else {
            $query->whereBetween($column, [$startDate, $endDate]);
        }

        return $query;
    }
}
