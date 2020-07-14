import Station from './station';
import Popup from './popup';

import {severities, severity_thresholds, indices} from './consts';

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
        this.popupLockedStaion = undefined;

        this.data = undefined;
        this.fields = ['o3', 'pm25', 'pm10', 'co', 'so2', 'no2'];
        this.month = '2020-05';

        for (let station of stations) {
            this.stations.push(new Station(station));
        }

        this.canvas.addEventListener('mousemove', this.mouseMove.bind(this));
        this.canvas.addEventListener('click', this.click.bind(this));

        this.resize(scale);
        this.updateSeverites();

        let mMainLayer = this;
        $('#options').submit(function() {
            mMainLayer.fields = $('#indices').val();
            mMainLayer.month = $('#month').val();
            mMainLayer.updateSeverites();
            return false;
        });
    }

    resize(scale) {
        this.canvas.style.width = this.mapInfo.width + 'px';
        this.canvas.style.height = this.mapInfo.height + 'px';
        this.canvas.width = this.mapInfo.width * scale;
        this.canvas.height = this.mapInfo.height * scale;
        this.ctx.setTransform(1, 0, 0, 1, 0, 0);
        this.ctx.scale(scale, scale);
        this.scale = scale;
        this.redraw();
    }

    getStationSeverity(station) {
        let severity = undefined;
        if (!this.data) return severity;
        for (let field of this.fields) {
            let val = this.data[station.info.id][field];
            if (val === null || val === undefined) continue;
            if (severity === undefined) severity = 0;
            for (let i = 0; i < severities.length; i++) {
                if (i === severities.length - 1 ||
                        val <= severity_thresholds[field][severities[i].key]) {
                    severity = (i > severity) ? i : severity;
                    break;
                }
            }
        }
        return severity;
    }

    updateSeverites() {
        $('#canvastitle').html('Map (loading data...)');
        axios.get('api/monthly_values', {
            params: {
                columns: this.fields,
                month: this.month
            }
        }).then((res) => {
            this.data = res.data;
            for (let station of this.stations) {
                station.severity = this.getStationSeverity(station);
                console.log(station.info.id+' has severity '+station.severity);
            }
            $('#canvastitle').html('Map');
            this.redraw();
        });
    }

    getStationText(station) {
        let text = station.getText();
        for (let field of this.fields) {
            text += '\n' + indices[field].name + ': ';
            let val = this.data[station.info.id][field] + ' ' + indices[field].unit;
            text += (val !== undefined) ? val : '(no data)';
        }
        if (station.severity !== undefined)
            text += '\n狀態: ' + severities[station.severity].description;
        return text;
    }

    redraw() {
        this.ctx.clearRect(0, 0, this.mapInfo.width, this.mapInfo.height);
        for (let station of this.stations) {
            if (station !== this.focusedStation && station !== this.popupLockedStaion) {
                if (station.severity !== undefined) this.ctx.fillStyle = severities[station.severity].color;
                else this.ctx.fillStyle = 'lightgray';
                station.path(this.ctx, this.mapInfo);
                this.ctx.fill();
            }
        }
        if (this.popupVisible && ((!this.lastPopup) || this.lastPopupStation !==
                (this.popupLockedStaion ? this.popupLockedStaion : this.focusedStation))) {
            this.lastPopupStation = (this.popupLockedStaion ? this.popupLockedStaion : this.focusedStation);
            this.lastPopup = new Popup(this.getStationText(this.lastPopupStation), 12, this.scale);

            const coord = this.lastPopupStation.getCoord(this.mapInfo);
            if (coord.x + this.lastPopup.width > this.mapInfo.width)
                this.popupCoord.x = this.mapInfo.width - this.lastPopup.width;
            else this.popupCoord.x = coord.x;
            if (coord.y + this.lastPopup.height > this.mapInfo.height)
                this.popupCoord.y = coord.y - 16 - this.lastPopup.height;
            else this.popupCoord.y = coord.y + 16;
        }
        if (this.popupLockedStaion) {
            if (this.popupLockedStaion.severity !== undefined) this.ctx.fillStyle = severities[this.popupLockedStaion.severity].color;
            else this.ctx.fillStyle = 'lightgray';
            this.ctx.strokeStyle = 'black';
            this.popupLockedStaion.path(this.ctx, this.mapInfo);
            this.ctx.fill();
            this.ctx.stroke();
        }
        if (this.focusedStation && this.focusedStation !== this.popupLockedStaion) {
            if (this.focusedStation.severity !== undefined) this.ctx.fillStyle = severities[this.focusedStation.severity].color;
            else this.ctx.fillStyle = 'lightgray';
            this.ctx.strokeStyle = 'white';
            this.focusedStation.path(this.ctx, this.mapInfo);
            this.ctx.fill();
            this.ctx.stroke();
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
            if (!this.popupLockedStaion) this.popupVisible = false;
            this.focusedStation = undefined;
            this.redraw();
        }
    }

    click(e) {
        this.pointerInfo.x = e.offsetX;
        this.pointerInfo.y = e.offsetY;
        for (let station of this.stations) {
            if (station.inRange(this.pointerInfo, this.mapInfo)) {
                this.popupLockedStaion = station;
                this.popupVisible = true;
                this.redraw();
                return;
            }
        }
        if (this.popupLockedStaion) {
            this.popupLockedStaion = undefined;
            this.popupVisible = false;
            this.redraw();
            return;
        }
    }
}
