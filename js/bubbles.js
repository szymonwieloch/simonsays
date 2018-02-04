_BUBBLE_TYPES = [
{
    color: '#3d85c6',
    speed: {x: 0.02, y:0.02},
    size: 50
},
{
    color: '#6aa84f',
    speed: {x: 0.03, y:0.03},
    size: 40
},
{
    color: '#cc0000',
    speed: {x: 0.025, y:0.025},
    size: 45
},

];

_STRENGHT = 1;



function State(canvas, ctx){
    this._bubbles = [];
    this.canvas = canvas
    this.context = ctx;
}

State.prototype.addBubble = function(bubble) {
    this._bubbles.push(bubble);
}

State.prototype.draw = function(timestamp) {
    console.log("Drawing...");
    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    var pushes = this.pushes();
    for (var idx in this._bubbles){
        this._bubbles[idx].draw(this.context, timestamp, pushes[idx]);
    }
}

State.prototype.pushes = function(){
    var pushes = [];
    for (var i in this._bubbles){
        var pushX = 0;
        var pushY = 0;
        var first = this._bubbles[i].center();
        for (var j in this._bubbles){
            if (i == j) {continue;}
            var second = this._bubbles[j].center();
            var distance2 = Math.pow(first.x-second.x, 2) + Math.pow(first.y-second.y, 2)
            pushX += _STRENGHT * (first.x -second.x)/distance2;
            pushY += _STRENGHT * (first.y - second.y)/distance2;
        }
        pushes.push({x: pushX, y: pushY});
    }
    console.log("pushes="+ pushes);
    return pushes;
}

function Bubble(speed, width, height, color, size, num, txt){
    this.txt = txt;
    this.color = color;
    this.maxX = width - 6*size;
    this.maxY = height - 2*size;
    this.x = Math.floor(Math.random() * this.maxX);
    this.y = Math.floor(Math.random() * this.maxY);
    this.num = num;
    this.size = size;
    this.speed = speed;
    this.lastChange = null;

}

Bubble.prototype.draw = function(ctx, timestamp, push){
    if (this.lastChange){
        var dt = timestamp - this.lastChange;
        this.x += dt * (this.speed.x + push.x);
        this.y += dt * (this.speed.y + push.y);
        if (this.x<0) {
            this.x = 0;
            this.speed.x = Math.abs(this.speed.x);
        }
        if (this.y<0) {
            this.y = 0;
            this.speed.y = Math.abs(this.speed.y);
        }
        if (this.x >= this.maxX) {
            this.x = this.maxX -1;
            this.speed.x = -Math.abs(this.speed.x);
        }
        if (this.y >= this.maxY) {
            this.y = this.maxY -1;
            this.speed.y = -Math.abs(this.speed.y);
        }

    }
    this.lastChange = timestamp;
    ctx.beginPath();
    ctx.lineWidth = 0;
    ctx.arc(this.x+this.size, this.y+this.size, this.size, 0, 2 * Math.PI, false);
    ctx.fillStyle = this.color;
    ctx.fill();
    //ctx.stroke();
    ctx.fillStyle='white';
    ctx.font='bold ' + this.size + "px 'Francois One'";
    ctx.textAlign="center";
    ctx.textBaseline="middle";
    ctx.fillText(this.num,this.x+this.size, this.y+this.size);
    ctx.fillStyle='black';
    ctx.textAlign="start";
    ctx.font='' + 0.5*this.size + 'px Lato';
    ctx.fillText(this.txt, this.x+this.size*2.2, this.y+this.size, 3.8*this.size);   
}

Bubble.prototype.center = function(){
    return {
        x: this.x + this.size,
        y: this.y + this.size
    }
}

function drawBubbles(obj_id, map) {
    var map_len = Object.keys(map).length;
    var canvas = document.getElementById(obj_id);
    var ctx = canvas.getContext("2d");
    //ctx.fillStyle = "blue";
    //ctx.fillRect(0, 0, canvas.width, canvas.height);
    //var size = Math.sqrt(canvas.width*canvas.height)/map_len/5;
    
    //console.log('size=' + size + ", maxX=" + maxX + ", maxY=" + maxY);
    var state = new State(canvas, ctx);
    for (var key in map){
        var bubble_type = _BUBBLE_TYPES[Math.floor(Math.random() * _BUBBLE_TYPES.length)];
        //var color = _BUBBLE_COLORS[Math.floor(Math.random() * _BUBBLE_COLORS.length)];
        
        var bubble = new Bubble({x:bubble_type.speed.x, y: bubble_type.speed.y}, canvas.width, canvas.height, bubble_type.color, bubble_type.size, map[key], key);
        state.addBubble(bubble);
    }
    state.draw();
    var frameCallback = function(timestamp){
        state.draw(timestamp);
        requestAnimationFrame(frameCallback);
    };
    requestAnimationFrame(frameCallback);
}

