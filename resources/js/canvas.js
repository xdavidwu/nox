window.axios = require('axios');

import MapLayer from './maplayer';
import MainLayer from './mainlayer';

$('#canvastitle').html('地圖 (資料載入中...)');

let container = document.getElementById('canvascon');
let mapLayer = undefined, mainLayer = undefined;

let mapInfo = {
    n: 26.4,
    s: 21.7,
    w: 118.0,
    e: 122.3,
    lonRange: 122.3 - 118.0,
    latRange: 21.7 - 26.4,
    width: 1016,
    height: 1221,
    mapScale: 1
};

function calculateSize() {
    mapInfo.mapScale = container.offsetWidth / 1016;
    mapInfo.width = container.offsetWidth;
    mapInfo.height = 1221 / 1016 * container.offsetWidth;
    container.style.minHeight = mapInfo.height + 'px';
}

calculateSize();

window.onresize = () => {
    console.log('resize');
    calculateSize();
    let scale = window.devicePixelRatio || 1;
    if (mapLayer !== undefined) mapLayer.resize(scale);
    if (mainLayer !== undefined) mainLayer.resize(scale);
};

let scale = window.devicePixelRatio || 1;

axios.get('images/Taiwan_location_map.svg')
    .then((res) => {
        mapLayer = new MapLayer(res.data, mapInfo, document.getElementById('maplayer'), scale);
    });
axios.get('api/stations')
    .then((res) => {
        mainLayer = new MainLayer(res.data, mapInfo, document.getElementById('canvas'), scale);
    });
