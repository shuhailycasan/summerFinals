let maze = document.querySelector('.maze');
let ctx = maze.getContext("2d");

let current;

class Maze{
	constructor(size, rows, columns){
		this.size = size;
		this.rows = rows;
		this.columns = columns;
		this.grid = [];
		this.stack = [];
	}

	setup(){
		for(let r = 0; r < this.rows; r++){
			let row =[];
			for(let c  = 0; c < this.columns; c++){
				let cell = new Cell(r, c, this.grid, this.size);
				row.push(cell);
			}
			this.grid.push(row)
		}
		current = this.grid[0][0]
	}
}

class Cell{
	constructor(rowNum, colNum, parentGrid, parentSize){
		this.rowNum = rowNum;
		this.colNum = colNum;
		this.parentGrid = parentGrid;
		this.parentSize = parentSize;
		this.visited = false;
		this.walls = {
			topWall : true,
			rightWall : true,
			bottomWall : true,
			leftWall : true,
		};
	}

	drawTopWall(x, y, size, columns, rows){
		ctx.beginPath();
		ctx.moveTo(x, y);
		ctx.lineTo(x+size/columns, y);
		ctx.stroke();
	}

	drawRightWall(x, y, size, columns, rows){
		ctx.beginPath();
		ctx.moveTo(x+size/columns, y);
		ctx.lineTo(x+size/columns, y+size/rows);
		ctx.stroke();
	}

	drawBottomWall(x, y, size, columns, rows){
		ctx.beginPath();
		ctx.moveTo(x, y+size/rows);
		ctx.lineTo(x+size/columns, y);
		ctx.stroke();
	}

	drawLeftWall(x, y, size, columns, rows){
		ctx.beginPath();
		ctx.moveTo(x, y);
		ctx.lineTo(x, y+size/rows);
		ctx.stroke();
	}


	show(size, rows, columns){
		let x = (this.colNum*size)/columns;
		let y = (this.rowNum*size)/rows;

		ctx.strokeStyle="white";
		ctx.fillStyle="black";
		ctx.lineWidth=2;

		if (this.walls.topWall) this.drawTopWall(x, y, size,columns, rows);
		if (this.walls.rightWall) this.drawRightWall(x, y, size,columns, rows);
		if (this.walls.bottomWall) this.drawBottomWall(x, y, size,columns, rows);
		if (this.walls.leftWall) this.drawLeftWall(x, y, size,columns, rows);
	}
}

let newMaze = new Maze(500, 10, 10);
newMaze.setup();