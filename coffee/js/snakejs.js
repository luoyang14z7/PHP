/*��Ҫһ������������ߵ�λ��*/
var snakeArr=[[2,2],[24,2],[46,2]];
var c=document.getElementById("can");
var cxt=c.getContext("2d");
var snakeHead=[46,2];
var direction=3;
var food;
var timer;
function drawSnake(){
	for(var i=0;i<snakeArr.length;i++)
	{
		draw(snakeArr[i],"red");
	}
}
function draw(p,c){
	cxt.fillStyle=c;
	cxt.fillRect(p[0],p[1],20,20);
}
function ranFood(){
	var x;
	var y;
	do {
		 x = Math.floor(Math.random() * 18 + 1) * 22 + 2;
		 y = Math.floor(Math.random() * 18 + 1) * 22 + 2;
	} while(foodInSnake(x,y));
	food=[x,y];
	draw(food,"yellow");
}
function foodInSnake(x,y){
	for (var z in snakeArr)
	{
		if(parseInt(snakeArr[z][0])===x && parseInt(snakeArr[z][1])===y)
		{
			console.log('true');
			return  true
		}
	}
	return false
}
function snakeEat(){
	draw(snakeArr[0],"black");
	snakeArr.push(snakeHead);
	if(snakeHead[0] == food[0] && snakeHead[1] == food[1]){
		ranFood();
	}else{
		snakeArr.splice(0,1);
	}
}
function snakemove(){
	switch(direction){
		case 1:
			snakeHead=[snakeHead[0]-22,snakeHead[1]];
			break;
		case 2:
			snakeHead=[snakeHead[0],snakeHead[1]-22];
			break;
		case 3:
			snakeHead=[snakeHead[0]+22,snakeHead[1]];
			break;
		case 4:
			snakeHead=[snakeHead[0],snakeHead[1]+22];
			break;
	}
}
document.onkeydown=function(event){
	var e=event||window.event;
	if(e && e.keyCode>=37 && e.keyCode<=40)
	{
		if(e.keyCode == 37 && direction != 3){
			direction=1;
		}
		else if(e.keyCode == 38 && direction != 4){
			direction=2;
		}
		else if(e.keyCode == 39 && direction != 1){
			direction=3;
		}
		else if(e.keyCode == 40 && direction != 2){
			direction=4;
		}
	}
}
function start(){
	snakemove();
	if(snakeHead[0]>= 420 || snakeHead[0] <= 0 || snakeHead[1] >= 420||snakeHead[1] <= 0)
	{
		return alert("Gamer  Over  !");
	}
	snakeEat();
	drawSnake();
	timer=setTimeout(arguments.callee,130);
}
function stop(){
	clearTimeout(timer);
}
ranFood();
drawSnake();
start();