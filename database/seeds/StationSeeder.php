<?php

use Illuminate\Database\Seeder;
use App\Station;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zip = new ZipArchive;
        $res = Storage::put(
            'station.zip',
            file_get_contents(
                'https://ienv.epa.gov.tw/MyEnv/api/MapService/Download?'.
                'fileName=%e7%a9%ba%e6%b0%a3%e5%93%81%e8%b3%aa%e7%9b%a3%e6%b8%ac%e7%ab%99&type=KML'
            )
        );
        if ($res !== true) {
            die('Remote zip download failed');
        }
        $zip->open(storage_path('app/station.zip'));
        $zip->extractTo(storage_path('app/'), '空氣品質監測站位置圖_121_10704.kml');
        $kml = new SimpleXMLElement(
            storage_path('app/空氣品質監測站位置圖_121_10704.kml'),
            null,
            true
        );
        foreach ($kml->Document->Folder->Placemark as $entry) {
            $station = new Station;
            foreach ($entry->ExtendedData->SchemaData->SimpleData as $attr) {
                switch ($attr->attributes()['name']) {
                    case 'SiteName':
                        $station->name = $attr;
                        break;
                    case 'SiteEngNam':
                        $station->name_en = $attr;
                        break;
                    case 'AreaName':
                        $station->area_name = $attr;
                        break;
                    case 'County':
                        $station->county = $attr;
                        break;
                    case 'Township':
                        $station->township = $attr;
                        break;
                    case 'SiteAddres':
                        $station->address = $attr;
                        break;
                    case 'SiteType':
                        $station->type = $attr;
                        break;
                }
            }
            $cord = explode(',', $entry->Point->coordinates);
            $station->longitude = $cord[0];
            $station->latitude = $cord[1];
            $station->save();
        }
    }
}
