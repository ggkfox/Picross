let Circle=class{
    constructor(x, y){
        this.x = x;
        this.y = y;
        this.dx = Math.floor((Math.random()*1000)%40)-20;
        this.dy = Math.floor((Math.random()*1000)%40)-20;
        this.r = 10;
    }
}