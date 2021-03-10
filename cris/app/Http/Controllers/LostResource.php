<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Lost;

class LostResource extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['allReported', 'show']);
    }

    public function allReported()
    {
        $items = Lost::orderBy('created_at', 'DESC')->paginate(15);
        return view('user.list_items', ['items' => $items]);
    }

    public function index()
    {
        $items = Auth::user()->items()->orderBy('created_at', 'DESC')->paginate(15);
        return view('user.list_items',['items' => $items]);
    }


    public function create()
    {
        return view('user.create_lost_item');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'item' => 'required|max:255',
            'description' => 'required'
        ]);
        $data = [
            'user_id' => Auth::user()->id,
            'item' => $request->input('item'),
            'description' => $request->input('description')
        ];
        if ($request->file('image'))
        {
            $this->validate($request, ['image' => 'image']);
            $data['image'] = Storage::disk('public')->put('items', $request->file('image'));
        }

        $item = Lost::create($data);
        return redirect(route('item.show', $item->id))->with('message', 'Create item successfully.');
    }


    public function show(Lost $item)
    {
        return view('user.item_details', ['item' => $item]);
    }

    public function changeCollected(Lost $item)
    {
        $colleted = "no";
        if ($item->collected == $colleted)
            $colleted = 'yes';
        $item->update(['collected' => $colleted]);

        return redirect(route('item.show', $item->id));
    }

    public function edit(Lost $item)
    {
        $this->authorize('update', $item);
        return view('user.edit_lost_item', ['item' => $item]);
    }


    public function update(Request $request, Lost $item)
    {
        $this->authorize('update', $item);

        $this->validate($request, [
            'item' => 'required|max:255',
            'description' => 'required'
        ]);

        $item->update([
            'item' => $request->input('item'),
            'description' => $request->input('description')
        ]);

        return redirect(route('item.show', $item->id))
            ->with('message', 'Updated details successfully');
    }


    public function destroy(Lost $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return redirect(route('item.index'))->with('message', 'deleted successfully.');
    }
}
