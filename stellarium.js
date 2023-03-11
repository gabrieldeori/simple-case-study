var config = {
  particleCount: 50,
  particleSize: 0.2,
  particleSpeed: 1,
  particleColor: '#fff',
  particleOpacity: 0.7,
  initialX: 0,
  initialY: 0,
  canvasWidth: window.innerWidth,
  canvasHeight: window.innerHeight,
  depthFactor: 1
};

function createParticles(config) {
  var particles = [];
  for (var i = 0; i < config.particleCount; i++) {
    var particle = {
      x: Math.random() * config.canvasWidth,
      y: Math.random() * config.canvasHeight,
      size: Math.random() * config.particleSize + 0.1,
      color: config.particleColor,
      opacity: Math.random() * config.particleOpacity + 0.3,
      depth: Math.random() * config.depthFactor + 1
    };
    particles.push(particle);
  }
  return particles;
}

function updateParticles(particles, config) {
  for (var i = 0; i < particles.length; i++) {
    var particle = particles[i];
    particle.x += config.particleSpeed * particle.depth;
    if (particle.x > config.canvasWidth + particle.size) {
      particle.x = -particle.size;
      particle.y = Math.random() * config.canvasHeight;
      particle.depth = Math.random() * config.depthFactor + 1;
    }
  }
}

function renderParticles(particles, canvas) {
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  for (var i = 0; i < particles.length; i++) {
    var particle = particles[i];
    ctx.beginPath();
    ctx.arc(particle.x, particle.y, particle.size * particle.depth, 0, Math.PI * 2);
    ctx.fillStyle = particle.color;
    ctx.globalAlpha = particle.opacity;
    ctx.fill();
  }
}

function mainLoop() {
  var canvas = document.getElementById('myCanvas');
  var particles = createParticles(config);
  function loop() {
    updateParticles(particles, config);
    renderParticles(particles, canvas);
    requestAnimationFrame(loop);
  }
  loop();
}

mainLoop();
