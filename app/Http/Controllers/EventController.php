<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Candidate;
use App\Models\Vote;
use Session;
use Validator;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'eventname'                  => 'required',
            'eventslug'                       => 'required'
        ];
  
        $messages = [
            'eventname.required'            => 'Name is required',
            'eventslug.required'                 => 'Slug is required'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $accountId = Session::get('accountid');

        $event = new Event;
        $event->user_id = $accountId;
        $event->event_name = $request->eventname;
        $event->slug = $request->eventslug;
        $event->description = $request->eventdescription;
        $event->status = 1;
        $simpanEvent = $event->save();
        $eventId = $event->id;
  
        if($simpanEvent){
            Session::flash('success', 'Create Success');
            session(['hasevent' => True]);
            session(['eventid' => $eventId]);
        } else {
            Session::flash('errors', ['' => 'Create Failed']);
        }
        return redirect()->route('home');
    }

    public function update(Request $request)
    {
        $rules = [
            'eventname'                  => 'required',
            'eventslug'                       => 'required'
        ];
  
        $messages = [
            'eventname.required'            => 'Name is required',
            'eventslug.required'                 => 'Slug is required'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $event = Event::find(1);
        $event->event_name = $request->eventname;
        $event->slug = $request->eventslug;
        $event->description = $request->eventdescription;
        $simpanEvent = $event->save();

        return redirect()->route('home');
    }

    public function storeCandidate(Request $request)
    {
        $rules = [
            'candidatename'                  => 'required',
            'candidatepict'                       => 'required',
            'candidatestatus'                       => 'required'
        ];
  
        $messages = [
            'candidatename.required'            => 'Name is required',
            'candidatepict.required'                 => 'Picture is required',
            'candidatestatus.required'                 => 'Status is required'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $imageName = time().'.'.$request->candidatepict->extension();  
        $request->candidatepict->move(public_path('assets/images/candidate'), $imageName);

        $candidate = new Candidate;
        $candidate->event_id = Session::get('eventid');
        $candidate->candidate_name = $request->candidatename;
        $candidate->status = $request->candidatestatus;
        $candidate->image = $imageName;
        $simpanCandidate = $candidate->save();
        $candidateId = $candidate->id;
  
        if($simpanCandidate){
            Session::flash('success', 'Create Success');
        } else {
            Session::flash('errors', ['' => 'Create Failed']);
        }
        return redirect()->route('home');
    }

    public function destroyCandidate($id)
    {
        $candidate = Candidate::find($id);
        $candidate->delete();

        return back()->with('success',' Penghapusan berhasil.');
    }

    public function statusCandidate($id,$statval)
    {
        $candidate = Candidate::find($id);
        $candidate->status = $statval;
        $simpanCandidate = $candidate->save();

        return back()->with('success',' modif status berhasil.');
    }

    public function pushVote($idevent,$idcandidate,$voters)
    {
        $token = bin2hex(random_bytes(16));
        $vote = new Vote;
        $vote->event_id = $idevent;
        $vote->candidate_id = $idcandidate;
        $vote->voters_name = $voters;
        $vote->token = $token;
        $simpanEvent = $vote->save();
        $voteId = $vote->id;
        if ($simpanEvent) {
            session(['hasvote' => True]);
            session(['hasvote-token' => $token]);
        }

        return redirect()->back();
    }
}
