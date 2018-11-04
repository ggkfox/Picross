

function initualizeArray(){
    var arr = new Array(n); //arr[horrizontal][vertical]
    for (var i = 0; i < n; i++) {
        arr[i] = new Array(n);
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            arr[y][x] = 0;
        }
    }
    return arr;
}

function fillArray(){
    var arr = new Array(n); //arr[horrizontal][vertical]
    for (var i = 0; i < n; i++) {
        arr[i] = new Array(n);
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            arr[y][x] = Math.round((Math.random()*10)%1);
        }
    }
    return arr;
}

function drawLayer1(){
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            var square = new Square(c1, x, y);
            square.show();
        }
    }
}

function drawLayer2(){
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            if (player[y][x]==1) {
                var square = new Square(c2, x, y);
                square.show();
            }
        }
    }
}

function displayNumbers(){
    c1.fillStyle = fontColor;
    //horizontal
    for (var i = 0; i < n; i++) {
        var temp = 0;
        var string = "";
        var y = i;
        for (var j = 0; j < n; j++) {
            var x = j;
            if (complete[y][x] == 1) temp++;
            else if (temp > 0){
                string += " " + parseInt(temp);
                temp = 0;
            }
        }
        if (temp > 0) string += " " + parseInt(temp);
        c1.font = font;
        c1.textAlign = "end";
        c1.fillText(string, (border+padding+gap)-textDistance, size*y+border+padding+gap+size*(3/5));
    }
    //verticle
    for (var i = 0; i < n; i++) {
        var numbersTall = 0;
        var temp = 0;
        var string = "";
        var x = i;
        for (var j = n-1; j >= 0; j--) {
            var y = j;
            if (complete[y][x] == 1) temp++;
            else if (temp > 0){
                numbersTall += 1;
                c1.font = font;
                c1.fillText(parseInt(temp), size*x+border+padding+gap+size*(3/5), (border+padding+gap)-numbersTall*20);
                temp = 0;
            }
        }
        if (temp > 0) c1.fillText(parseInt(temp), size*x+border+padding+gap+size*(3/5), (border+padding+gap)-(numbersTall+1)*20);
    }
}

function clearCanvas(c){
    c.clearRect(0,0,layer1.width, layer1.height);
}

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}

function getIndex(x, y) {
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            var left = size*j+border+padding+gap;
            var right = size*(j+1)+border+padding;
            var top = size*i+border+padding+gap;
            var bot = size*(i+1)+border+padding;
            if (x>left && x<right && y>top && y<bot) {
                return{
                    x: j,
                    y: i
                };
            }
        }
    }
}

function checkWin(){
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            if (player[i][j] != complete[i][j]) return false;
        }
    }
    return true;
}

function drawBalls(){
    for (var i = 0; i < circles.length; i++) {
        clearCanvas(c2);
        c2.fillStyle = "red";
        c2.beginPath();
        c2.arc(circles[i].x,circles[i].y,circles[i].r,0,2*Math.PI);
        c2.stroke();

        if (circles[i].x + circles[i].r > windowSize+padding || circles[i].x - circles[i].r < 0+padding){
            circles[i].dx *= -1;
        }
        if (circles[i].y + circles[i].r > windowSize+padding || circles[i].y - circles[i].r < 0+padding){
            circles[i].dy *= -1;
        }

        circles[i].x += circles[i].dx;
        circles[i].y += circles[i].dy;
        // circles[i].dx += friction;
        circles[i].dy += gravity;
    }

    requestAnimationFrame(drawBalls);
}