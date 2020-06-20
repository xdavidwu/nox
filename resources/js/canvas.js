window.axios = require('axios');

import MapLayer from './maplayer';
import MainLayer from './mainlayer';

let container = document.getElementById('canvascon');
let mapLayer, mainLayer;

const mapInfo = {
    n: 26.4,
    s: 21.7,
    w: 118.0,
    e: 122.3,
    lonRange: 122.3 - 118.0,
    latRange: 21.7 - 26.4,
    width: 1016,
    height: 1221
};

container.style.minWidth = mapInfo.width + 'px';
container.style.minHeight = mapInfo.height + 'px';

let scale = window.devicePixelRatio || 1;

axios.get('images/Taiwan_location_map.svg')
    .then((res) => {
        mapLayer = new MapLayer(res.data, mapInfo, document.getElementById('maplayer'), scale);
    });
axios.get('api/stations')
    .then((res) => {
        mainLayer = new MainLayer(res.data, mapInfo, document.getElementById('canvas'), scale);
    });
