<?php

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
