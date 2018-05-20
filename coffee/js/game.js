/**
 * Created by Tarena on 2017/1/6.
 */
var c= document.getElementById("can").getContext("2d");
var snake={
    snakeArr:[[2,2],[24,2],[46,2]],/*蛇的完整坐标*/
    ctx:c,/*画笔*/
    snakeHead:[46,2],/*蛇头坐标*/
    direction:3,/*蛇的行动方向*/
    food:[0,0],/*食物坐标*/
    timer:null,/*存放计时器*/
    state:0,/*状态 0开始 1暂停 2死亡*/
    /*用来绘画方块，需给坐标与颜色*/
    draw:function(p,c){
        snake.ctx.fillStyle=c;
        snake.ctx.fillRect(p[0],p[1],20,20);
    },
    /*遍历蛇数组调用绘画方块函数来画蛇*/
    drawSnake:function(){
        for(var i=0;i<snake.snakeArr.length;i++)
        {
            snake.draw(snake.snakeArr[i],"red");
        }
    },
    /*随机产生食物*/
    ranFood:function(){
        var x;/*用来存放食物横坐标*/
        var y;/*用来存放食物纵坐标*/
        do {
            /*随机产生食物的横纵坐标*/
            x = Math.floor(Math.random() * 18 + 1) * 22 + 2;
            y = Math.floor(Math.random() * 18 + 1) * 22 + 2;
        } while(snake.foodInSnake(x,y));/*调用函数来判断新的食物是否在蛇身中*/
        snake.food=[x,y];
        /*画食物*/
        snake.draw(snake.food,"yellow");
    },
    /*判断食物是否在蛇中*/
    foodInSnake:function(x,y){
        for (var z in snake.snakeArr)
        {
            if(parseInt(snake.snakeArr[z][0])===x && parseInt(snake.snakeArr[z][1])===y)
            {
                return  true
            }
        }
        return false
    },
    /*判断蛇是否吃到食物*/
    snakeEat:function(){
        /*不论是否吃到将蛇尾去除*/
        snake.draw(snake.snakeArr[0],"black");
        /*将新蛇头添加进去*/
        snake.snakeArr.push(snake.snakeHead);
        /*判断蛇头是否与食物位置一致*/
        if(snake.snakeHead[0] == snake.food[0] && snake.snakeHead[1] == snake.food[1]){
            snake.ranFood();/*产生新食物*/
        }else{
            snake.snakeArr.splice(0,1);/*将蛇去除最后一段*/
        }
    },
    /*蛇的移动方向改变*/
    snakemove:function(){
        switch(snake.direction){
            case 1:
                snake.snakeHead=[snake.snakeHead[0]-22,snake.snakeHead[1]];
                break;
            case 2:
                snake.snakeHead=[snake.snakeHead[0],snake.snakeHead[1]-22];
                break;
            case 3:
                snake.snakeHead=[snake.snakeHead[0]+22,snake.snakeHead[1]];
                break;
            case 4:
                snake.snakeHead=[snake.snakeHead[0],snake.snakeHead[1]+22];
                break;
        }
    },
    /*循环体*/
    loop:function(){
        snake.state=0;
        snake.snakemove();
        if(snake.snakeHead[0]>= 420 || snake.snakeHead[0] <= 0 || snake.snakeHead[1] >= 420||snake.snakeHead[1] <= 0)
        {
            snake.state=2;
            clearTimeout(snake.timer);
            $('.game').html('S 开始');
            return alert("Gamer  Over  !");
        }
        snake.snakeEat();
        snake.drawSnake();
        snake.timer=setTimeout(arguments.callee,130);
    },
    /*暂停*/
    stop:function(){
        snake.state=1;
        $('.game').html('S 开始 ');
        clearTimeout(snake.timer);
    },
    /*初始化*/
    init:function(){
        snake.state=1;
        snake.ranFood();
        snake.drawSnake();
    }
}
/*给键盘添加监听事件*/
document.onkeydown=function(event){
    var e=event||window.event;
    if(e && e.keyCode>=37 && e.keyCode<=40)
    {
        if(e.keyCode == 37 && snake.direction != 3){
            snake.direction=1;
        }
        else if(e.keyCode == 38 && snake.direction != 4){
            snake.direction=2;
        }
        else if(e.keyCode == 39 && snake.direction != 1){
            snake.direction=3;
        }
        else if(e.keyCode == 40 && snake.direction != 2){
            snake.direction=4;
        }
    }
    else if(e.keyCode == 80 && snake.state != 1){
        snake.stop();
    }
    else if(e.keyCode == 83 && snake.state != 0){
        if(snake.state==2){
            snake.ctx.clearRect(0,0,420,420);
            snake.snakeArr=[[2,2],[24,2],[46,2]];
            snake.snakeHead=[46,2];
            snake.ranFood();
            snake.timer=setTimeout(snake.loop(),130);
        }else{
            $('.game').html('P 暂停');
            snake.loop();
        }
    }
}
snake.init();