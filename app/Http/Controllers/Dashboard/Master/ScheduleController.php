<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

use App\Models\Tag;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $data['datas'] = Schedule::get()->load('tag');

        return view('master.schedule-index', $data);
    }

    public function detail($id)
    {
        $tag = Schedule::find($id);
        $tag->load('tag');
        
        $data['data'] = $tag;

        return view('master.tag-view', $data);
    }

    public function sync($id)
    {
        $data = Schedule::find($id);
        $data->done = 0;
        $data->update();
        
        return redirect()->back()->with('message', 'Success Sync Data');
    }

    public function create()
    {
        $data['tag'] = Tag::get();
        return view('master.schedule-create', $data);
    }

    public function store(Request $request)
    {
        $data = Schedule::where('tag_id', $request->tag_id)
                        ->where('date', $request->date)
                        ->where('source', $request->source)
                        ->first();
        $tag = Tag::find($request->tag_id);

        if (is_null($data)) {
            $schedule = new Schedule();
            $schedule->tag_id = $request->tag_id;
            $schedule->tags_code = $tag->code;
            $schedule->tags_key = $tag->key;
            $schedule->date = $request->date;
            $schedule->source = $request->source;
            $schedule->active = 1;

            $schedule->save();

            return redirect()->back()->with('message', 'Schedule Data Success Added');
        } else {
            return redirect()->back()->with('error', 'Schedule Data Has been Added');
        }
    }

    public function update(Request $request, $id)
    {
        var_dump($id);
        var_dump($request->all());
    }
}
