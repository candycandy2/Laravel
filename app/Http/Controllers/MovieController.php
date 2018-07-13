<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lib\ResultCode;
use App\Services\CompanyService;


class MovieController extends Controller
{
	public function showMovie($id)
	{
		return '@電影controller'. $id;
	}
}
