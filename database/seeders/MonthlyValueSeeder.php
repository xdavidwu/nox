<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DateTime;
use App\Models\MonthlyValue;
use App\Models\Station;

class MonthlyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '1024M');
        $url = 'https://data.epa.gov.tw/api/frontstage/datastore.search';
        $data = '{"resource_id":"4026f97e-60f9-4d8b-9a3d-f2813f6ff2fd","q":"",'.
            '"limit":999999999,"offset":0';
        $month = env('UPDATE_MONTH_FROM', '');
        if ($month !== '') {
            if ($month === 'auto') {
                $month = Carbon::parse(MonthlyValue::max('month'))->subMonth(2)->format('Y-m');
            }
            echo 'Update from month '.$month."\n";
            $data = $data.',"filter":[{"column":"monitormonth","operator":"greater","value":"'.$month.'"}]';
        }
        $data = $data.'}';
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n",
                'content' => $data
            )
        );
        $jsonstr = file_get_contents($url, false, stream_context_create($options));
        echo "POST done\n";
        $data = json_decode($jsonstr);
        echo "JSON loaded\n";
        foreach ($data->payload->records as $rec) {
            $station = Station::firstWhere('name', $rec->sitename);
            if ($station === null) {
                echo 'Station not found for ';
                print_r($rec);
                echo "\n";
                continue;
            }
            $mon = DateTime::createFromFormat('!Ym', $rec->monitormonth);
            $field = '';
            switch ($rec->itemengname) {
                case 'PM2.5':
                    $field = 'pm25';
                    break;
                case 'NOx':
                    $field = 'nox';
                    break;
                case 'NMHC':
                    $field = 'nmhc';
                    break;
                case 'CH4':
                    $field = 'ch4';
                    break;
                case 'SO2':
                    $field = 'so2';
                    break;
                case 'PM10':
                    $field = 'pm10';
                    break;
                case 'THC':
                    $field = 'thc';
                    break;
                case 'WIND_SPEED':
                    $field = 'wind_speed';
                    break;
                case 'AMB_TEMP':
                    $field = 'amb_temp';
                    break;
                case 'RH':
                    $field = 'rh';
                    break;
                case 'WS_HR':
                    $field = 'ws_hr';
                    break;
                case 'CO':
                    $field = 'co';
                    break;
                case 'O3':
                    $field = 'o3';
                    break;
                case 'NO':
                    $field = 'no';
                    break;
                case 'NO2':
                    $field = 'no2';
                    break;
                case 'RAIN_COND':
                    $field = 'rain_cond';
                    break;
                case 'RAIN_INT':
                    $field = 'rain_int';
                    break;
                case 'CO2':
                    $field = 'co2';
                    break;
                case 'PH_RAIN':
                    $field = 'ph_rain';
                    break;
            }
            if ($field !== '') {
                $val = $rec->concentration;
                if ($val === 'x' || $val === '') {
                    $val = null;
                }
                MonthlyValue::updateOrCreate(
                    ['station_id' => $station->id, 'month' => $mon ],
                    [ $field => $val ],
                );
            } else {
                echo 'Unrecognized field on ';
                print_r($rec);
                echo "\n";
            }
        }
    }
}
