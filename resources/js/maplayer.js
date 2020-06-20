export default class MapLayer {
    constructor(path, mapInfo, canvas, scale) {
        this.paths = [];
        this.canvas = canvas;
        this.ctx = this.canvas.getContext('2d');
        this.mapInfo = mapInfo;

        let xml = new DOMParser().parseFromString(path, 'text/xml');
        let layers = xml.getElementsByTagName('path');
        for (let i = 0; i < layers.length; i++) {
            this.paths.push(new Path2D(layers[i].getAttribute('d')));
        }

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
        for (let i = 0; i < this.paths.length; i++) {
            this.ctx.stroke(this.paths[i]);
        }
    }
}
