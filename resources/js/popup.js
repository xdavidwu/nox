export default class Popup {
    constructor(text, size, scale) {
        this.lines = text.split('\n');
        this.size = size;

        this.cacheCanvas = document.createElement('canvas');
        this.cacheCtx = this.cacheCanvas.getContext('2d');
        this.cacheCtx.scale(scale, scale);
        this.cacheCtx.font = this.size + 'px sans-serif';

        const measure = this.cacheCtx.measureText('lg');
        this.fontHeight = measure.actualBoundingBoxAscent + measure.actualBoundingBoxDescent;
        this.lineHeight = this.fontHeight * 1.5;
        this.height = this.lines.length * this.lineHeight - (this.lineHeight - this.fontHeight) + 16;
        let maxWidth = 0;
        for (let line of this.lines) {
            const measure = this.cacheCtx.measureText(line);
            if (measure.width > maxWidth) maxWidth = measure.width;
        }
        this.width = maxWidth + 16;

        this.cacheCanvas.width = this.width * scale;
        this.cacheCanvas.height = this.height * scale;
        this.cacheCanvas.style.width = this.width + 'px';
        this.cacheCanvas.style.height = this.height + 'px';
        this.cacheCtx.font = this.size + 'px sans-serif';
        this.cacheCtx.scale(scale, scale);

        this.cacheCtx.fillStyle = 'darkgrey';
        this.cacheCtx.fillRect(0, 0, this.width, this.height);

        this.cacheCtx.textBaseline = 'top';
        this.cacheCtx.fillStyle = 'white';
        let offset = 8;
        for (let i = 0; i < this.lines.length; i++) {
            this.cacheCtx.fillText(this.lines[i], 8, offset);
            offset += this.lineHeight;
        }
    }

    draw(ctx, x, y) {
        ctx.drawImage(this.cacheCanvas, x, y, this.width, this.height);
    }
}
