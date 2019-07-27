<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Submission;
use App\Problem;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Submit the solution
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request, $problem_id)
    {
        if ($request->ajax()){
            $problem = Problem::where('id', $problem_id)->first();

            $submission = new Submission(); 
            $submission->user()->associate(Auth::user());
            $submission->problem()->associate($problem);
            $submission->language = $request->get('language');
            $submission->save();
            $submission->update(['path' => 'submission/' . $submission->id]);
            Storage::disk('local')->put('submission/' . $submission->id, $request->get('code'));

            return response('Success', 200);
        }

        return response('Bad request', 400);
        
    }
}
