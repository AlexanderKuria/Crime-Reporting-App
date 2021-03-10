<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Crime;

class CrimeResource extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $crimes = Auth::user()->crimes()->orderBy('created_at', 'DESC')->paginate(15);

        return view('user.crimes_list')->with(['crimes' => $crimes]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.create_crime');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'reason' => ['required', 'max:255'],
            'location' => ['required'],
            'details' => ['required']
        ]);

        $data = [
            'user_id' => $this->getUser()->id,
            'for' => $request->input('reason'),
            'location' => $request->input('location'),
            'details' => $request->input('details')
        ];
        $crime = Crime::create($data);
        if ($crime)
            return redirect(route('crime.show', $crime->id));
        else
            return redirect()->back()
                ->withInput(['for', 'location', 'details'])
                ->with('error', 'Failed to save the crime, try again.');
    }
    private function getUser(){
        return Auth::user();
    }

    /**
     * @param Crime $crime
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Crime $crime)
    {
        $this->authorize('view', $crime);
        return view('user.details')->with(['crime' => $crime]);
    }

    /**
     * @param Crime $crime
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Crime $crime)
    {
        $this->authorize('update', $crime);
        return view('user.edit_crime')->with(['crime' => $crime]);
    }

    /**
     * @param Request $request
     * @param Crime $crime
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Crime $crime)
    {
        $this->authorize('update', $crime);

        if (!$this->crimeNotProccessed($crime))
            return redirect(route('crime.index'))
                ->with('error', 'You can\'t edit case details of processed case' );
        $this->validate($request, [
            'reason' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'details' => ['required']
        ]);
        $data = [
            'for' => $request->input('reason'),
            'location' => $request->input('location'),
            'details' => $request->input('details')
        ];
        $crime->update($data);

        return redirect(route('crime.show', $crime->id))
            ->with('message', 'Updated details successfully.');
    }

    private function crimeNotProccessed(Crime $crime)
    {
        return $crime->status == 'unassigned';
    }

    /**
     * @param Crime $crime
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Crime $crime)
    {
        $this->authorize('delete', $crime);
        if (!$this->crimeNotProccessed($crime))
            return redirect(route('crime.show', $crime->id))
                ->with('error', 'Can\'t delete processed crime');
        $crime->delete();
        return redirect(route('crime.index'))->with('message', 'Deleted crime details successfully.');
    }
}
