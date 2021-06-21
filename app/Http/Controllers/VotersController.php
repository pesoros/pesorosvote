<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Candidate;
use App\Models\Vote;
use Session;

use Illuminate\Http\Request;

class VotersController extends Controller
{
    public function index($slug)
    {
        if (Session::get('hasvote') != True) {
            $eventdata = Event::where('slug','=',$slug)->orderBy('id', 'DESC')->first();
            $candidatedata = Candidate::where('event_id','=',$eventdata['id'])->get();
            if ($eventdata) {
                return view('voters.votersdata', [
                    'eventdata' => $eventdata,
                    'candidatedata' => $candidatedata
                ]);
            } else {
                return redirect()->route('home');
            }
        } else {
            $votedata = Vote::where('token','=',Session::get('hasvote-token'))->first();
            $candidatedata = Candidate::where('id','=',$votedata['candidate_id'])->first();
            return view('voters.wasvote', ['candidatedata' => $candidatedata]);
        }
    }
}
