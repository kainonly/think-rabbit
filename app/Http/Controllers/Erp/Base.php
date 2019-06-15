<?php

namespace App\Http\Controllers\Erp;

use Illuminate\Http\Request;
use lumen\bit\BitController;

class Base extends BitController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}
