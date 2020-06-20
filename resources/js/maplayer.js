export default class MapLayer {
    constructor(path, mapInfo, canvas, scale) {
        this.paths = [];
        this.canvas = canvas;
        this.ctx = this.canvas.getContext('2d');
        this.mapInfo = mapInfo;

        let xml = new DOMParser().parseFromString(path, 'text/xml');
        let layers = xml.getElementsByTagName('path');
        for (let i = 0; i < layers.length; i++) {
            this.paths.push({
                path: new Path2D(layers[i].getAttribute('d')),
                fill: layers[i].getAttribute('fill'),
                stroke: layers[i].getAttribute('stroke')
            });
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
        this.ctx.fillStyle = '#C6ECFF';
        this.ctx.fillRect(0, 0, this.mapInfo.width, this.mapInfo.height);
        this.ctx.scale(this.mapInfo.mapScale, this.mapInfo.mapScale);
        for (let i = 0; i < this.paths.length; i++) {
            if (this.paths[i].fill !== 'none') {
                this.ctx.fillStyle = this.paths[i].fill;
                this.ctx.fill(this.paths[i].path);
            }
            if (this.paths[i].stroke) this.ctx.strokeStyle = this.paths[i].stroke;
            else this.ctx.strokeStyle = 'black';
            this.ctx.stroke(this.paths[i].path);
        }
    }
}
