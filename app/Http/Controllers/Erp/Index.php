<?php

namespace App\Http\Controllers\Erp;

class Index extends Base
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return [
            'name' => 'erp'
        ];
    }
}
