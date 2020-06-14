import Station from './station';

export default class MainLayer {
    constructor(stations, mapInfo, canvas) {
        this.stations = [];
        this.canvas = canvas;
        this.ctx = this.canvas.getContext('2d');
        this.mapInfo = mapInfo;
        this.pointerInfo = { x: 0, y: 0 };

        for (let station of stations) {
            this.stations.push(new Station(station));
        }

        this.canvas.addEventListener('mousemove', this.mouseMove.bind(this));

        this.resize();
        this.redraw();
    }

    resize() {
        let pixelRatio = window.devicePixelRatio || 1;
        this.canvas.style.width = this.mapInfo.width + 'px';
        this.canvas.style.height = this.mapInfo.height + 'px';
        this.canvas.width = this.mapInfo.width * pixelRatio;
        this.canvas.height = this.mapInfo.height * pixelRatio;
        this.ctx.scale(pixelRatio, pixelRatio);
    }

    redraw() {
        for (let station of this.stations) {
            if (station.inRange(this.pointerInfo, this.mapInfo)) this.ctx.fillStyle = 'black';
            else this.ctx.fillStyle = 'red';
            station.draw(this.ctx, this.mapInfo);
        }
    }

    mouseMove(e) {
        this.pointerInfo.x = e.offsetX;
        this.pointerInfo.y = e.offsetY;
        for (let station of this.stations) {
            if (station.wasInRange !== station.inRange(this.pointerInfo, this.mapInfo)) {
                this.redraw();
                break;
            }
        }
    }
}
