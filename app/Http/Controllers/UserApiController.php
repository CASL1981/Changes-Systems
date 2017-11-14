<?php

namespace App\Http\Controllers;

use App\Center;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * @var Center
     */
    private $center;
    /**
     * UserApiController constructor.
     * @param Center $center
     */
    public function __construct(Center $center)
    {
    	$this->center = $center;
    }
    /**
     * return paginated records of users
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
    	$centers = $this->center->paginate(5);
        
    	return response()->json($centers);
    }
}
