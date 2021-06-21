<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Candidate;
use App\Models\Vote;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        if (Session::get('role') == 'admin') {
            return view('admin.home');  
        } else {
            if (Session::get('hasevent') != False) {
                $eventdata = Event::find(Session::get('eventid'))->first();
                $candidatedata = Candidate::where('event_id','=',Session::get('eventid'))->get();
                $votedata = Vote::where('event_id','=',Session::get('eventid'))->orderBy('id', 'DESC')->get();
                $votedatachart = $this->getCandidateVote($candidatedata);


                return view("admin.homeClient", [
                    'eventdata' => $eventdata, 
                    'candidatedata' => $candidatedata,
                    'votedata' => $votedata,
                    'votedatachart' => $votedatachart
                ]);
            } else {
                return view('admin.homeClientFirst');
            }
        }
    }

    public function getCandidateVote($candidatedata)
    {
        $res = [];
        foreach ($candidatedata as $key => $value) {
            $voteCount = Vote::where('event_id','=',Session::get('eventid'))
                ->where('candidate_id','=',$value->id)
                ->count();

            $res[$key]['y'] = $value->candidate_name;
            $res[$key]['x'] = $voteCount;
        }

        return $res;
    }
}