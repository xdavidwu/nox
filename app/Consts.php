<?php

namespace App;

class Consts
{
    public const INDICES = array(
        'so2' => array(
            'name' => '二氧化硫',
            'unit' => 'ppb',
            'grafana_panel' => 3
        ),
        'co' => array(
            'name' => '一氧化碳',
            'unit' => 'ppm',
            'grafana_panel' => 4
        ),
        'co2' => array(
            'name' => '二氧化碳',
            'unit' => 'ppm',
            'grafana_panel' => 5
        ),
        'o3' => array(
            'name' => '臭氧',
            'unit' => 'ppb',
            'grafana_panel' => 6
        ),
        'pm10' => array(
            'name' => 'PM₁₀',
            'unit' => 'μg/m³',
            'grafana_panel' => 7
        ),
        'pm25' => array(
            'name' => 'PM₂.₅',
            'unit' => 'μg/m³',
            'grafana_panel' => 8
        ),
        'nox' => array(
            'name' => '氮氧化物',
            'unit' => 'ppb',
            'grafana_panel' => 9
        ),
        'no' => array(
            'name' => '一氧化氮',
            'unit' => 'ppb',
            'grafana_panel' => 10
        ),
        'no2' => array(
            'name' => '二氧化氮',
            'unit' => 'ppb',
            'grafana_panel' => 11
        ),
        'thc' => array(
            'name' => '總碳氫化合物',
            'unit' => 'ppm',
            'grafana_panel' => 12
        ),
        'nmhc' => array(
            'name' => '非甲烷碳氫化合物',
            'unit' => 'ppm',
            'grafana_panel' => 13
        ),
        'ch4' => array(
            'name' => '甲烷',
            'unit' => 'ppm',
            'grafana_panel' => 14
        ),
        'wind_speed' => array(
            'name' => '風速',
            'unit' => 'm/s',
            'grafana_panel' => 15
        ),
        'ws_hr' => array(
            'name' => '小時風速值',
            'unit' => 'm/s',
            'grafana_panel' => 16
        ),
        'amb_temp' => array(
            'name' => '溫度',
            'unit' => '℃',
            'grafana_panel' => 2
        ),
        'rain_int' => array(
            'name' => '降雨強度',
            'unit' => 'mm',
            'grafana_panel' => 17
        ),
        'ph_rain' => array(
            'name' => '酸雨 pH',
            'unit' => '',
            'grafana_panel' => 18
        ),
        'rh' => array(
            'name' => '相對濕度',
            'unit' => '%',
            'grafana_panel' => 19
        ),
        'rain_cond' => array(
            'name' => '導電度',
            'unit' => 'μS/cm',
            'grafana_panel' => 20
        )
    );

    public const GRAFANA_DEFAULT = 'so2';
}
