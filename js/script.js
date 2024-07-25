function test($a)
{
    let container = document.getElementById('hex');
    let svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute ("версия", "1.2");
    svg.setAttribute ("Базовый профиль", "крошечный");
    container.appendChild(svg);

    let c1 = document.createElementNS("http://www.w3.org/2000/svg", "circle");
    c1.setAttribute("cx", "100");
    c1.setAttribute ("cy", "100");
    c1.setAttribute ("r", "60");
    c1.setAttribute("fill", "#336699");
    svg.appendChild(c1);
}
