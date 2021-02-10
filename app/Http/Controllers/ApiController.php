<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyValue;
use DateTime;

class ApiController extends Controller
{
    public function monthlyValue(Request $req)
    {
        $raw = MonthlyValue::where(
            'month',
            '=',
            DateTime::createFromFormat('!Y-m', $req->input('month'))
        )->select($req->input('columns'))->addSelect('station_id')->get();

        $cooked = array();
        foreach ($raw as $entry) {
            $cooked[$entry->station_id] = $entry;
            unset($cooked[$entry->station_id]['station_id']);
        }

        return $cooked;
    }
}
