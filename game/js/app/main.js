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
        player.src = new SpriteMap(player_image, {
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
      star = '<span class="glyphicon glyphicon-star" id="star" aria-hidden="true"></span>';
      second_star = '<span class="glyphicon glyphicon-star" id="second_star" aria-hidden="true"></span>';
      third_star = '<span class="glyphicon glyphicon-star" id="third_star" aria-hidden="true"></span>';
      if(time<30){
        $("#first_star").append(second_star);
        $("#second_star").append(third_star);
      } else if(time<60){
        $("#first_star").append(second_star);
        $("#second_star").append(star);
      } else {
        $("#first_star").append(star);
        $("#star").append(star);
      }
      $("#main").hide(function(){
        $("#result").show(500);
      });
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
  context.drawPattern(background_image, 0, 0, world.width, world.height);
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

  time = 0;
  setInterval(function(){
    time++;
  },1000)
  // world.resize() changes the size of the world, in pixels; defaults to the canvas size
  world.resize(MAZE_WIDTH*120, MAZE_HEIGHT*120);

  // the GRAVITY property enables gravity
  Actor.prototype.GRAVITY = false;

  // the arguments to create a new player specify its pixel coordinates
  // upper-left is (0, 0)
  player = new Player(130, 130, 90, 90);
  player.src = new SpriteMap(player_image, {
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
  solid = new TileMap(grid, {X: tile_image, x: tile_image
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
      ctx.drawImage('images/block_finish.png', x, y, 120, 120);
    }
  });

  var Door = Box.extend({
    drawDefault: function(ctx, x, y, w, h) {
      ctx.drawImage('images/door.png', x, y, 120, 120);
    }
  });


  var Key = Box.extend({
    drawDefault: function(ctx, x, y, w, h) {
      ctx.drawImage('images/key.png', x+30, y+30, 60, 60);
    },
  });
