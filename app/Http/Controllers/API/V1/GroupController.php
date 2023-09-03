<?php

namespace App\Http\Controllers\API\Student\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __invoke(Request $request)
    {
        return GroupResource::collection(
            Group::withCourse()
                ->withTeacher()
                ->whereIn('id', function ($query) {
                    $query->select('group_id')
                        ->from('group_student')
                        ->where('student_id', auth()->id());
                })
                ->get()
        );
    }
}
