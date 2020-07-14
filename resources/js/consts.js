export const severities = [
    {
        key: 'good',
        description: '良好',
        color: '#009865'
    },
    {
        key: 'moderate',
        description: '普通',
        color: '#fffb26'
    },
    {
        key: 'unhealthy_for_sensitive',
        description: '對敏感族群不健康',
        color: '#ff9835'
    },
    {
        key: 'unhealthy',
        description: '對所有族群不健康',
        color: '#ca0034'
    },
    {
        key: 'very_unhealthy',
        description: '非常不健康',
        color: '#670099',
    },
    {
        key: 'hazardous',
        description: '危害',
        color: '#7e0123'
    }
];

export const severity_thresholds = {
    o3: {
        good: 0.054 * 1000,
        moderate: 0.070 * 1000,
        unhealthy_for_sensitive: 0.085 * 1000,
        unhealthy: 0.105 * 1000,
        very_unhealthy: 0.200 * 1000
    },
    pm25: {
        good: 15.4,
        moderate: 35.4,
        unhealthy_for_sensitive: 54.4,
        unhealthy: 150.4,
        very_unhealthy: 250.4
    },
    pm10: {
        good: 54,
        moderate: 125,
        unhealthy_for_sensitive: 254,
        unhealthy: 354,
        very_unhealthy: 424
    },
    co: {
        good: 4.4,
        moderate: 9.4,
        unhealthy_for_sensitive: 12.4,
        unhealthy: 15.4,
        very_unhealthy: 30.4
    },
    so2: {
        good: 35,
        moderate: 75,
        unhealthy_for_sensitive: 185,
        unhealthy: 304,
        very_unhealthy: 604
    },
    no2: {
        good: 53,
        moderate: 100,
        unhealthy_for_sensitive: 360,
        unhealthy: 649,
        very_unhealthy: 1249
    }
}

export const indices = {
    o3: {
        name: '臭氧',
        unit: 'ppb'
    },
    pm25: {
        name: 'PM₂.₅',
        unit: 'μg/m³'
    },
    pm10: {
        name: 'PM₁₀',
        unit: 'μg/m³'
    },
    co: {
        name: '一氧化碳',
        unit: 'ppm'
    },
    so2: {
        name: '二氧化硫',
        unit: 'ppb'
    },
    no2: {
        name: '二氧化氮',
        unit: 'ppb'
    }
}
