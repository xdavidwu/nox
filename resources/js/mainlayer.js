import Station from './station';
import Popup from './popup';

export default class MainLayer {
    constructor(stations, mapInfo, canvas, scale) {
        this.stations = [];
        this.canvas = canvas;
        this.ctx = this.canvas.getContext('2d');
        this.mapInfo = mapInfo;
        this.pointerInfo = { x: 0, y: 0 };
        this.lastPopup = undefined;
        this.lastPopupStation = undefined;
        this.popupCoord = { x: 0, y: 0 };
        this.popupVisible = false;
        this.focusedStation = undefined;

        for (let station of stations) {
            this.stations.push(new Station(station));
        }

        this.canvas.addEventListener('mousemove', this.mouseMove.bind(this));

        this.resize(scale);
    }

    resize(scale) {
        this.canvas.style.width = this.mapInfo.width + 'px';
        this.canvas.style.height = this.mapInfo.height + 'px';
        this.canvas.width = this.mapInfo.width * scale;
        this.canvas.height = this.mapInfo.height * scale;
        this.ctx.scale(scale, scale);
        this.scale = scale;
        this.redraw();
    }

    redraw() {
        this.ctx.clearRect(0, 0, this.mapInfo.width, this.mapInfo.height);
        this.ctx.fillStyle = 'red';
        for (let station of this.stations) {
            if (this.focusedStation !== station) {
                station.draw(this.ctx, this.mapInfo);
            }
        }
        if (this.focusedStation) {
            if ((!this.lastPopup) || this.lastPopupStation !== this.focusedStation) {
                this.lastPopup = new Popup(this.focusedStation.getText(), 12, this.scale);
                this.lastPopupStation = this.focusedStation;

                const coord = this.focusedStation.getCoord(this.mapInfo);
                if (coord.x + this.lastPopup.width > this.mapInfo.width)
                    this.popupCoord.x = this.mapInfo.width - this.lastPopup.width;
                else this.popupCoord.x = coord.x;
                if (coord.y + this.lastPopup.height > this.mapInfo.height)
                    this.popupCoord.y = coord.y - 16 - this.lastPopup.height;
                else this.popupCoord.y = coord.y + 16;
            }
            this.ctx.fillStyle = 'blue';
            this.focusedStation.draw(this.ctx, this.mapInfo);
        }
        if (this.popupVisible) this.lastPopup.draw(this.ctx, this.popupCoord.x, this.popupCoord.y);
    }

    mouseMove(e) {
        this.pointerInfo.x = e.offsetX;
        this.pointerInfo.y = e.offsetY;
        let found = false;
        for (let station of this.stations) {
            if (station.inRange(this.pointerInfo, this.mapInfo)) {
                if (this.focusedStation !== station) {
                    this.focusedStation = station;
                    this.popupVisible = true;
                    this.redraw();
                }
                found = true;
                break;
            }
        }
        if (!found && this.focusedStation) {
            this.popupVisible = false;
            this.focusedStation = undefined;
            this.redraw();
        }
    }
}
