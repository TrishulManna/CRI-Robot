<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	//Error: De middleware zorgt ervoor dat je niet met de robot kan connecten
	/* 
	public function __construct()
    {
        $this->middleware('auth');
    }
	*/

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
