<?php
namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function create()
    {
        return view('admin.timeline.create');
    }

    public function store(Request $request)
    {
        Timeline::create($request->all());
        return redirect()->route('admin.timeline.create')->with('success', 'Timeline ditambahkan');
    }

    public function edit($id)
    {
        $timeline = Timeline::findOrFail($id);
        return view('admin.timeline.edit', compact('timeline'));
    }

   public function update(Request $request, $id)
{
    $timeline = Timeline::findOrFail($id);
    $timeline->update($request->all());

    return redirect()
        ->route('admin.timeline.edit', $id)
        ->with('success', 'Timeline diupdate');
}

    public function destroy($id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Timeline dihapus');
    }
}
