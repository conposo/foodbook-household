<?php

namespace App\Http\Controllers;

use App\Household;
use App\HouseholdMember as Member;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SystemController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        //
    }

    public function allhouseholds()
    {
        $household = Household::all();
        return $this->successResponse($household, Response::HTTP_OK);
    }

    public function allmembers()
    {
        $members = Member::all();
        return $this->successResponse($members, Response::HTTP_OK);
    }


}
