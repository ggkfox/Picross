function configureCanvas() {
	n = htmlSizeSlider.value;
	border = (Math.round(n/2)+1)*17;
	correctColor = grid.correctColor[htmlBlockColorSlider.value];
	fontColor = grid.fontColor[htmlBackgroundColorSlider.value];
	BackgroundColor.style.backgroundColor = grid.backgroundColor[htmlBackgroundColorSlider.value];
    size = (windowSize-border)/n;
    startTime = 0;
    currTimeM = 0;
    currTimeS = 0;
    tilesRemaining = 0;
    mistakes = 0;
    circles = [];
    complete = randomArray();
    player = blankArray();
    drawLayer1();
    drawLayer2();
}

function blankArray(){
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

function randomArray(){
    var arr = new Array(n); //arr[horrizontal][vertical]
    for (var i = 0; i < n; i++) {
        arr[i] = new Array(n);
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            arr[y][x] = Math.floor((Math.random()*10)%2);
            if (arr[y][x]==1) tilesRemaining++;
        }
    }
    return arr;
}

function drawLayer1(){
    clearCanvas(c1);
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            var square = new Square(c1, x, y, baseColor);
            square.show();
            //draw horrizontal lines
            if (y%5 == 0 && y > 0) {
                c1.beginPath();
                c1.moveTo(padding+border*0.3, padding+border+size*y + gap/2);
                c1.lineTo(padding+windowSize, padding+border+size*y + gap/2);
                c1.stroke();
            }
            //draw verticle lines
            if (x%5 == 0 && x > 0) {
                c1.beginPath();
                c1.moveTo(padding+border+size*x + gap/2, padding+border*0.3);
                c1.lineTo(padding+border+size*x + gap/2, padding+windowSize);
                c1.stroke();
            }
        }
    }
    displayNumbers();
}

function drawLayer2(){
    clearCanvas(c2);
    for (var i = 0; i < n; i++) {
        for (var j = 0; j < n; j++) {
            var x = j;
            var y = i;
            if (player[y][x]==1) {
                var square;
                if (complete[y][x]==1) {
                    square = new Square(c2, x, y, correctColor);
                }
                else {
                    square = new Square(c2, x, y, wrongColor);
                }
                square.show();
            }
        }
    }
}

function isCorrect(x, y){
    if (complete[y][x]==1) return true;
    return false;
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
                c1.fillText(parseInt(temp), size*x+border+padding+gap+size*(3/5), (border+padding+gap)-numbersTall*18);
                temp = 0;
            }
        }
        if (temp > 0) c1.fillText(parseInt(temp), size*x+border+padding+gap+size*(3/5), (border+padding+gap)-(numbersTall+1)*18);
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

function circleShow(){
    if (tilesRemaining>0) return;
    for (var i = 0; i < 15; i++) {
        circles.push(new Circle(300, 100, Math.floor(Math.random()*1000)%ballColors.length));
    }
    setTimeout(function(){circleShow();}, 3000);
}

function drawBalls(){
    clearCanvas(c3);
    for (var i = 0; i < circles.length; i++) {
        circle = circles[i];

        c3.fillStyle = ballColors[circle.color];
        c3.beginPath();
        c3.arc(circle.x,circle.y,circle.r,0,2*Math.PI);
        c3.fill();

        if (circle.x + circle.r + circle.dx >= windowSize+padding || circle.x - circle.r + circle.dx <= 0+padding+border){
            circle.dx *= -friction;
        }
        if (circle.y + circle.r + circle.dy >= windowSize+padding || circle.y - circle.r + circle.dy <= 0+padding+border){
            circle.dy *= -friction;
            circle.dx *= friction;
        }
        else circle.dy += gravity;

        circle.x += circle.dx;
        circle.y += circle.dy;
    }
    winText.style.color = ballColors[(Math.floor(Math.random()*1000)%ballColors.length)];
    requestAnimationFrame(drawBalls);
}

function calculateTime() {
    if (activeGame == true) {
        if (startTime == 0) startTime = Date.now();
        currTimeM = Math.floor((Date.now()-startTime)/60000);
        currTimeS = Math.floor((Date.now()-startTime)/1000) % 60;
        if (currTimeS < 10) {
            htmlTimer.textContent = "Time: " + currTimeM + " Minutes and 0" + currTimeS + " Seconds";
        }
        else {
            htmlTimer.textContent = "Time: " + currTimeM + " Minutes and " + currTimeS + " Seconds";
        }
    }
    else {
        htmlTimer.textContent = "Time: 0 Minutes and 00 Seconds";
    }
    setTimeout(calculateTime, 1000);
}