export default class Station {
    constructor(info) {
        this.info = info;
        this.radius = 4;
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
        if (distSquare <= this.radius ** 2) return true;
        return false;
    }

    getText() {
        return '測站名稱: ' + this.info.name + '\n' +
            '縣市鄉鎮: ' + this.info.county + this.info.township + '\n' +
            '測站地址: ' + this.info.address;
    }
}
