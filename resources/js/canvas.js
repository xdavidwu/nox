window.axios = require('axios');

let canvas = document.getElementById('canvas');
let ctx = canvas.getContext('2d');
let pixelRatio = window.devicePixelRatio || 1;
let path;
let stations;

const mapWidth = 1016, mapHeight = 1221;
const n = 26.4, s = 21.7, w = 118.0, e = 122.3;
const lonRange = e - w, latRange = s - n;

canvas.style.width = mapWidth + 'px';
canvas.style.height = mapHeight + 'px';
canvas.width = mapWidth * pixelRatio;
canvas.height = mapHeight * pixelRatio;
ctx.scale(pixelRatio, pixelRatio);

function redraw() {
    let xml = new DOMParser().parseFromString(path, 'text/xml');
    let layers = xml.getElementsByTagName('path');

    for (let i = 0; i < layers.length; i++) {
        let p2d = new Path2D(layers[i].getAttribute('d'));
        ctx.stroke(p2d);
    }

    if (stations !== undefined) {
        ctx.fillStyle = 'red';
        for (let station of stations) {
            ctx.beginPath();
            ctx.arc((station.longitude - w) / lonRange * mapWidth,
                (station.latitude - n) / latRange * mapHeight, 4, 0, 2 * Math.PI);
            ctx.fill();
        }
    }
}

axios.get('images/Taiwan_location_map.svg')
    .then((res) => {
        path = res.data;
        redraw();
        axios.get('api/stations')
            .then((res) => {
                stations = res.data;
                redraw();
            });
    });
