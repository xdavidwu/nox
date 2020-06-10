<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthlyValue;
use DateTime;

class RawController extends Controller
{
    public function search(Request $req)
    {
        $query = MonthlyValue::orderBy('month', 'desc')->orderBy('station_id', 'asc');
        if (!is_null($req->input('month_after'))) {
            $query = $query->where(
                'month',
                '>=',
                DateTime::createFromFormat('!Y-m', $req->input('month_after'))
            );
        }
        if (!is_null($req->input('month_before'))) {
            $query = $query->where(
                'month',
                '<=',
                DateTime::createFromFormat('!Y-m', $req->input('month_before'))
            );
        }

        $values = $query->paginate(64)->appends($req->except('page'));

        return view('raw', [ 'values' => $values ]);
    }
}
