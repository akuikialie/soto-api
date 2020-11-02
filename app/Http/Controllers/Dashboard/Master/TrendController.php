<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Trend;

class TrendController extends Controller
{
    public function index(Request $request)
    {
        return Trend::get();

        // $tag = Tag::get();
        // $tag->load('target');
        
        // $data['datas'] = $tag;

        // return view('master.tag-index', $data);
    }

    public function detail($id)
    {
        $tag = Tag::find($id);
        $tag->load('target');
        
        $data['data'] = $tag;

        return view('master.tag-view', $data);
    }
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->instagram_account = $request->instagram_account;
        $tag->twitter_account = $request->twitter_account;
        $tag->youtube_account = $request->youtube_account;

        $tag->update();

        return redirect()->back()->with('message', 'Data Success Update');
    }
}
