<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\HouseholdMember as Member;

use App\Traits\ApiResponser;

class HouseholdMembersController extends Controller
{
    use ApiResponser;

    public function show($user_id)
    {
        // $member = Member::where('user_id', $user_id)->latest("updated_at")->first();

        $member = Member::where('user_id', $user_id)->get();
        // dd($member, $user_id);
        return $this->successResponse($member, Response::HTTP_OK);
    }

    public function store(Request $request, $user_id)
    {
        $member = Member::where('user_id', $user_id)->where(function ($query) {
            $query->where('user_type', '=', 'ORGANIZER')
                ->orWhere('user_type', '=', 'MEMBER');
        })->get();
        if($member->isEmpty())
        {
            $request['user_id'] = $user_id;
            $member = Member::create($request->all());
        }
        return $this->successResponse($member, Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $member = Member::where($request->all())->first();
        $member->delete();
        return $request->all(); //$this->successResponse($member, Response::HTTP_OK);
    }
    
    public function update(Request $request, $member_id)
    {
        $member = Member::find($member_id);
        if($member)
        {
            $member->fill($request->all());
            if($member->isClean())
            {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $member->save();
        }
        return $this->successResponse($member, Response::HTTP_OK);
    }
    
    public function decline()
    {
        //
    }

    public function join()
    {
        //
    }

    public function leave()
    {
        //
    }

}
