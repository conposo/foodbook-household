<?php

namespace App\Http\Controllers;

use App\Household;
use App\HouseholdMember as Member;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Traits\ApiResponser;

class HouseholdController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        //
    }

    public function index($id)
    {
        $household = Household::with('members')->where('id', $id)->first();
        return $this->successResponse($household, Response::HTTP_OK);
    }

    public function store(Request $request, $user_id)
    {
        if(! $member = Member::where([ ['user_id', '=', $user_id], ['user_type', '<>', 'GUEST'] ])->first())
        {
            $rules = [
                'name' => 'required|max:255',
            ];
            $this->validate($request, $rules);
    
            $household = Household::create($request->all());
            if($household)
            {
                $householdMember = Member::create([
                    'household_id' => $household->id,
                    'user_id' => $user_id,
                    'user_type' => 'ORGANIZER',
                    'status' => 'ACTIVE'
                ]);
            }
            return $this->successResponse($household, Response::HTTP_CREATED);
        }
        else
        {
            $household = Household::find($member->household_id);
            return $this->successResponse($household, Response::HTTP_OK);
        }
    }

    public function update(Request $request, $household_id)
    {
        $household = Household::find($household_id);
        // dd($request->all(), $household_id, $household);
        if($household)
        {
            $household->fill($request->all());
            if($household->isClean())
            {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $household->save();
        }
        return $this->successResponse($household, Response::HTTP_OK);
    }

}
