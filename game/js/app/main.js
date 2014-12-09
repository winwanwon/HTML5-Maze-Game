// The main logic for your project goes in this file.

/**
* The {@link Player} object; an {@link Actor} controlled by user input.
*/
var player;
var player_key = 0;
/**
* Keys used for various directions.
*
* The property names of this object indicate actions, and the values are lists
* of keyboard keys or key combinations that will invoke these actions. Valid
* keys include anything that {@link jQuery.hotkeys} accepts. The up, down,
* left, and right properties are required if the `keys` variable exists; if
* you don't want to use them, just set them to an empty array. {@link Actor}s
* can have their own {@link Actor#keys keys} which will override the global
* set.
*/
var keys = {
  up: ['up', 'w'],
  down: ['down', 's'],
  left: ['left', 'a'],
  right: ['right', 'd'],
};

/**
* An array of image file paths to pre-load.
*/
var preloadables = [
'images/grass2.png',
'images/player.png',
];

var MAZE_HEIGHT = 8,
    MAZE_WIDTH = 16;

/**
* A magic-named function where all updates should occur.
*/
function update() {
  // move
  player.update();
  // enforce collision
  if(game_mode==2){
    solid.forEach(function(solid) {
      if (player.overlaps(solid)){
        // do something
        player.destroy();
        player = new Player(130, 130, 90, 90);
        player.src = new SpriteMap('images/player.png', {
          stand: [0, 0, 0, 0],
          right: [0, 1, 0, 2],
          left: [0, 3, 0, 4],
          down: [0, 1, 0, 2],
          up: [0, 1, 0, 2],
        }, {
          frameW: 40,
          frameH: 40,
          interval: 100,
          useTimer: false,
        });
        player.draw();
        return false;
      }
    });
  } else {
    player.collideSolid(solid);
  }

  finish.forEach(function(finish) {
    if (player.overlaps(finish)){
      // do something
      $("body").hide();
      return true;
    }
  });

  key.forEach(function(key) {
    if (player.overlaps(key)){
      player_key++;
      return true;
    }
  });

  door.forEach(function(door) {
    if (player.overlaps(door)){
      if(player_key>0){
        player_key--;
        return true;
      } else {
        player.collideSolid(door);
        return false;
      }
    }
  });



}

/**
* A magic-named function where all drawing should occur.
*/
function draw() {
  // Draw a background. This is just for illustration so we can see scrolling.
  context.drawCheckered(80, 0, 0, world.width, world.height);

  solid.draw();
  player.draw();
  finish.draw();
  door.draw();
  key.draw();
}

/**
* A magic-named function for one-time setup.
*
* @param {Boolean} first
*   true if the app is being set up for the first time; false if the app has
*   been reset and is starting over.
*/
function setup(first) {
  // world.resize() changes the size of the world, in pixels; defaults to the canvas size
  world.resize(MAZE_WIDTH*120, MAZE_HEIGHT*120);

  // the GRAVITY property enables gravity
  Actor.prototype.GRAVITY = false;

  // the arguments to create a new player specify its pixel coordinates
  // upper-left is (0, 0)
  player = new Player(130, 130, 90, 90);
  player.src = new SpriteMap('images/player.png', {
    stand: [0, 0, 0, 0],
    right: [0, 1, 0, 2],
    left: [0, 3, 0, 4],
    down: [0, 1, 0, 2],
    up: [0, 1, 0, 2],
  }, {
    frameW: 40,
    frameH: 40,
    interval: 100,
    useTimer: false,
  });

  // Add terrain.
  solid = new TileMap(grid, {X: 'images/grass2.png', x: 'images/grass2.png'
  , F: Finish, D: Door, K: Key}, {startCoords: [0,0], cellSize: [120, 120]});

  finish = new Collection();
  door = new Collection();
  key = new Collection();

  solid.forEach(function(o, i, j) {
    if (o instanceof Finish) {
      solid.clearCell(i, j);
      finish.add(o);
    } else if (o instanceof Door) {
      solid.clearCell(i, j);
      door.add(o);
    } else if (o instanceof Key) {
      solid.clearCell(i, j);
      key.add(o);
    }
  });


}

var Finish = Box.extend({
  drawDefault: function(ctx, x, y, w, h) {
    ctx.circle(this.xC(), this.yC(), (w+h)/12, 'blue');
  },
});

var Door = Box.extend({
  drawDefault: function(ctx, x, y, w, h) {
    ctx.circle(this.xC(), this.yC(), (w+h)/5, 'red');
    ctx.font = '20pt Arial';
    ctx.fillStyle = 'blue';
    ctx.fillText("DOOR", this.xC()-40, this.yC()+10)
  },
});


var Key = Box.extend({
  drawDefault: function(ctx, x, y, w, h) {
    ctx.circle(this.xC(), this.yC(), (w+h)/8, 'orange');
    ctx.font = '16pt Arial';
    ctx.fillStyle = 'red';
    ctx.fillText("KEY", this.xC()-20, this.yC()+10)
  },
});
