export default class MapLayer {
    constructor(path, mapInfo, canvas) {
        this.paths = [];
        this.canvas = canvas;
        this.ctx = this.canvas.getContext('2d');
        this.mapInfo = mapInfo;

        let xml = new DOMParser().parseFromString(path, 'text/xml');
        let layers = xml.getElementsByTagName('path');
        for (let i = 0; i < layers.length; i++) {
            this.paths.push(new Path2D(layers[i].getAttribute('d')));
        }

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
        for (let i = 0; i < this.paths.length; i++) {
            this.ctx.stroke(this.paths[i]);
        }
    }
}
