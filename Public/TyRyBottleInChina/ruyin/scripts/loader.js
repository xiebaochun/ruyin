function webgl(img,width,height) {
var CANVAS_WIDTH=width;
var CANVAS_HEIGHT=height;
var RESOURCE_IMAGE=img;
	
	
var CANVAS_ELE     = document.getElementById('mybottle');
// 设置加载的瓶子的模型的路径
var RESOURCE_MODEL = './models/bottle-global.html';

// 设置渲染到瓶子盖子的图片
var TEXTURE_HAT    = './images/bottle-hat.png';

// 设置渲染到瓶子颈部和底部的图片
var TEXTURE_BODY   = './images/bottle-neck.png';
var container;
var camera, scene, renderer;

var mouseX         = 0, mouseY = 0;
var windowHalfX    = window.innerWidth / 2;
var windowHalfY    = window.innerHeight / 2;

var currentTime    = Date.now();
var duration       = 12000; // ms
var obj;

var POSITION_X     = 0;
var POSITION_Y     = 0;
var POSITION_Z     = 0;
var C_POSITION_X   = 0;
var C_POSITION_Y   = 16;
var C_POSITION_Z   = 45;
var SCALE          = 2;

function init() {

  container = CANVAS_ELE;

  // ----- Camera -----
  
  camera = new THREE.PerspectiveCamera( 
    45, 
    CANVAS_WIDTH / CANVAS_HEIGHT, 
    1, 
    4000
  );
  camera.position.z = C_POSITION_Z;
  camera.position.x = C_POSITION_X;
  camera.position.y = C_POSITION_Y;

  // ----- Scene -----

  scene = new THREE.Scene();

  var ambient = new THREE.AmbientLight( 0x111111 );
  scene.add( ambient );

  var directionalLight = new THREE.DirectionalLight( 0xffeedd );
  directionalLight.position.set( 0, 0, 1 );
  scene.add( directionalLight );

  // ----- Texture -----

  var manager = new THREE.LoadingManager();
  var textureBody = new THREE.Texture();
  var textureNeck = new THREE.Texture();
  var textureHat = new THREE.Texture();

  manager.onProgress = function ( item, loaded, total ) {
     console.log( item, loaded, total );
  };

  var onProgress = function ( xhr ) {
    if ( xhr.lengthComputable ) {
      var percentComplete = xhr.loaded / xhr.total * 100;
      console.log( Math.round(percentComplete, 2) + '% downloaded' );
    }
  };

  var onError = function ( xhr ) {
  };

  var loader = new THREE.ImageLoader(manager);
  loader.load(RESOURCE_IMAGE, function (image) {
    textureBody.image = image;
    textureBody.needsUpdate = true;
  });

  loader.load(TEXTURE_HAT, function (image) {
    textureHat.image = image;
    textureHat.needsUpdate = true;
  });

  loader.load(TEXTURE_BODY, function (image) {
    textureNeck.image = image;
    textureNeck.needsUpdate = true;
  });

  // ----- Model -----
  
  var loader = new THREE.OBJLoader( manager );
  loader.load( RESOURCE_MODEL, function ( object ) {
    obj = object;
    object.traverse( function ( child ) {
      if ( child instanceof THREE.Mesh ) {
        switch (child.name) {
          case "group1_polySurface10" : 
            child.material.map = textureNeck;
            break;
          case "polySurface1_group1" :
            child.material.map = textureBody;
            break;
          case "group1_polySurface8" :
            child.material.map = textureHat;
            break;
        }
      }
    });

    object.position.x = POSITION_X;
    object.position.y = POSITION_Y;
    object.position.z = POSITION_Z;

    object.scale.x = SCALE;
    object.scale.y = SCALE;
    object.scale.z = SCALE;

    scene.add( object );

    // Async loading complete and start apps
    animate();

  }, onProgress, onError );

  // ----- Render -----
  
  renderer = new THREE.WebGLRenderer({
    alpha: true,
    antialias:true
  });
  renderer.setPixelRatio( window.devicePixelRatio );
  renderer.setSize( CANVAS_WIDTH, CANVAS_HEIGHT );
  renderer.setClearColor( 0xffffff, 0 );
  container.appendChild( renderer.domElement );

  // ----- Events -----
  
  // window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize() {
  windowHalfX = window.innerWidth / 2;
  windowHalfY = window.innerHeight / 2;
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize( window.innerWidth, window.innerHeight );
}

function animate() {
  requestAnimationFrame( animate );
  render();
}

function render() {
  var now    = Date.now();
  var deltat = now - currentTime;
  currentTime = now;
  var fract = deltat / duration;
  var angle = Math.PI * 2 * fract;

  obj.rotation.y +=  angle;
  renderer.render( scene, camera );
}

init();

}
