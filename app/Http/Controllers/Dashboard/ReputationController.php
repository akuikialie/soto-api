<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReputationController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['title'] = 'The Most Reputation Division';
        return view('dashboard.reputation', $data);
    }

    public function data(Request $request)
    {
        $datas = [
            [
                'x' => '2020',
                'y' => '100'
            ],
            [
                'x' => '2021',
                'y' => '400'
            ],
            [
                'x' => '2022',
                'y' => '140'
            ],
            [
                'x' => '2023',
                'y' => '50'
            ],
        ];
        return response()->json($datas);
    }
}
