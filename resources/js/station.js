export default class Station {
    constructor(info) {
        this.info = info;
        this.radius = 4;
        this.wasInRange = false;
    }

    getCoord(mapInfo) {
        return {
            x: (this.info.longitude - mapInfo.w) / mapInfo.lonRange * mapInfo.width,
            y: (this.info.latitude - mapInfo.n) / mapInfo.latRange * mapInfo.height
        };
    }

    draw(ctx, mapInfo) {
        let coord = this.getCoord(mapInfo);
        ctx.beginPath();
        ctx.arc(coord.x, coord.y, this.radius, 0, 2 * Math.PI);
        ctx.fill();
    }

    inRange(pointerInfo, mapInfo) {
        let coord = this.getCoord(mapInfo);
        let distSquare = (pointerInfo.x - coord.x) ** 2 + (pointerInfo.y - coord.y) ** 2;
        if (distSquare <= this.radius ** 2) this.wasInRange = true;
        else this.wasInRange = false;
        return this.wasInRange;
    }
}
