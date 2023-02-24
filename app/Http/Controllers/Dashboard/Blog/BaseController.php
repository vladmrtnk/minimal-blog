<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Controllers\Dashboard\BaseController as GuestBaseController;

abstract class BaseController extends GuestBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
}