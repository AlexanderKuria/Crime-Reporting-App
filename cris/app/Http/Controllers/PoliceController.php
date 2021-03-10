<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Crime;
use App\Lost;
use App\Progress;

class PoliceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:officer');
    }
    public function index()
    {
        $data = [
            'new_cases' => Crime::where(['status' => 'unassigned'])->count(),
            'reported_lost' => Lost::all()->count(),
            'no_owner' => Lost::where(['collected' => 'no'])->count(),
            'collected' => Lost::where(['collected' => 'yes'])->count()
        ];
        return view('police.dashboard', $data);
    }
    public function allNewCases()
    {
        $cases = Crime::where(['status' => 'unassigned'])->orderBy('created_at', 'DESC')->paginate(15);
        return view('police.list_crimes', ['crimes' => $cases]);
    }
    public function openCases()
    {
        $cases = Auth::user()->assignedCrimes()
            ->where(['status' => 'assigned'])->orderBy('created_at', 'DESC')->paginate(15);
        return view('police.list_crimes', ['crimes' => $cases]);
    }
    public function closedCases()
    {
        $cases = Auth::user()->assignedCrimes()
            ->where(['status' => 'closed'])->orderBy('created_at', 'DESC')->paginate(15);
        return view('police.list_crimes', ['crimes' => $cases]);
    }
    public function crimeDetails(Crime $crime)
    {
        return view('police.crime_details', ['crime' => $crime]);
    }
    public function assignCase(Crime $crime)
    {
        if ($crime->status != 'unassigned')
            return redirect()->back()->with('error', 'This case is either closed or assigned to different officer');

        $crime->update([
            'status' => 'assigned',
            'police_id' => Auth::guard('officer')->user()->id
        ]);
        return redirect(route('crime.details', $crime->id))
            ->with('message', 'Assigned case successfully');
    }
    public function allReportedItems()
    {
        $items = Lost::orderBy('created_at', 'DESC')->paginate(15);
        return view('police.lost_item', ['items' => $items]);
    }
    public function allNotCollected()
    {
        $items = Lost::where(['collected' => 'no'])->orderBy('created_at', 'DESC')->paginate(15);
        return view('police.lost_item', ['items' => $items]);
    }
    public function allCollected()
    {
        $items = Lost::where(['collected' => 'yes'])->orderBy('created_at', 'DESC')->paginate(15);
        return view('police.lost_item', ['items' => $items]);
    }
    public function addProgress(Crime $crime)
    {
        return view('police.add_progress', ['crime' => $crime]);
    }
    public function saveProgress(Request $request, Crime $crime)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'details' => 'required'
        ]);
        $data = [
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'crime_id' => $crime->id,
            'police_id' => Auth::user()->id
        ];

        Progress::create($data);
        return redirect(route('crime.details', $crime->id))
            ->with('message', 'Added case progress to records.');
    }
    public function endCase(Crime $crime)
    {
        $this->authorize('updateState', $crime);
        $crime->update(['status' => 'closed']);

        return redirect(route('crime.details', $crime->id));
    }
    public function searchItem()
    {
        return 'Search for this item';
    }
    public function logout()
    {
        Auth::guard('officer')->logout();
        return redirect(route('police.login'))->with('message', 'Session ended successfully');
    }
}
