// //-----------Global Variables
// var padding = 5; //space around game on all sides
// var windowSize = 400;
// var border = 40; //space for numbers
// var n = 7; //number of tiles X and Y
// var gap = 2; //gap between tiles (this number should be half of what you with the gap to be)
// var size = (windowSize-border)/n; //size of each tile

// function buildArray() {
//     var arr = new Array(n); //arr[horrizontal][vertical]
//     for (var i = 0; i < n; i++) {
//         arr[i] = new Array(n);
//         for (var j = 0; j < n; j++) {
//             arr[i][j] = Math.round((Math.random()*10)%1);
//         }
//     }
//     return arr;
// }

// function drawGrid(arr) {
//     for (var i = 0; i < n; i++) {
//         for (var j = 0; j < n; j++) {
//             var x = j;
//             var y = i;
//             c.fillStyle = (arr[i][j]==1)? "blue" : "black";
//             square = c.fillRect(size*x+border+padding+gap, size*y+border+padding+gap, size-gap, size-gap);
//         }
//     }
// }

// function getMousePos(canvas, evt) {
//     var rect = canvas.getBoundingClientRect();
//     return {
//         x: evt.clientX - rect.left,
//         y: evt.clientY - rect.top
//     };
// }

// function reveal(x, y) {
//     for (var i = 0; i < n; i++) {
//         for (var j = 0; j < n; j++) {
//             var left = size*i+border+padding+gap;
//             var right = size*(i+1)+border+padding;
//             var top = size*j+border+padding+gap;
//             var bot = size*(j+1)+border+padding;
//             if (x>left && x<right && y>top && y<bot) {
//                 alert("u got (" + j + "," + i + ")");
//             };
//         }
//     }
// }

// var canvas = document.querySelector('canvas');
// canvas.height = windowSize + (2 * padding);
// canvas.width = windowSize + (2 * padding);
// var c = canvas.getContext('2d');

// canvas.addEventListener('click', function(evt) {
//     var mousePos = getMousePos(canvas, evt);
//     var message = 'Mouse position: ' + mousePos.x + ', ' + mousePos.y;
//     reveal(mousePos.x, mousePos.y);
//     console.log(message);
// }, false);

// var arr = buildArray();
// drawGrid(arr);

window.addEventListener('click', function(event) {
    console.log("test");
});

function square(x, y, w, h, size) {
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.size = size;


}