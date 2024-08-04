function test()
{
    let svg = document.getElementById('svg');
    let polygon = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
    svg.appendChild(polygon);

    let array = [[173.20508075688775, 200],
        [173.20508075688775,100],
        [86.60254037844386,50],
        [-1.4210854715202004e-14,100],
        [-1.4210854715202004e-14, 199.99999999999997],
        [86.60254037844385,250]
    ];

    for (value of array){
        let point = svg.createSVGPoint();
        point.x = value[0];
        point.y = value[1];
        polygon.points.appendItem(point);
    }
}
test()
