var canvas = document.getElementById('myCanvas');

var config = {
  particleCount: 50,
  particleSize: 1,
  particleSpeed: 10,
  particleColor: '#ffffff',
  particleOpacity: 0.7,
  initialX: 0,
  initialY: 0,
  canvasWidth: window.innerWidth,
  canvasHeight: window.innerHeight
};

function createParticles(config) {
  var particles = [];
  for (var i = 0; i < config.particleCount; i++) {
    var particle = {
      x: Math.random() * config.canvasWidth,
      y: Math.random() * config.canvasHeight + config.canvasHeight,
      size: Math.random() * config.particleSize,
      color: config.particleColor,
      opacity: Math.random() * config.particleOpacity
    };
    particles.push(particle);
  }
  return particles;
}

function updateParticles(particles, config) {
  for (var i = 0; i < particles.length; i++) {
    var particle = particles[i];
    particle.y -= config.particleSpeed;
    if (particle.y < 0 - config.particleSize) {
      particle.y = Math.random() * config.canvasHeight + config.canvasHeight;
      particle.x = Math.random() * config.canvasWidth;
    }
  }
}

function renderParticles(particles, canvas) {
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  for (var i = 0; i < particles.length; i++) {
    var particle = particles[i];
    ctx.save(); // salva o estado do canvas antes de fazer alterações de rotação
    ctx.translate(particle.x, particle.y); // move a partícula para sua posição atual
    ctx.rotate(particle.rotate * Math.PI / 180); // roda a partícula em sua direção
    ctx.beginPath();
    ctx.arc(0, 0, particle.size, 0, Math.PI * 2);
    ctx.fillStyle = particle.color;
    ctx.globalAlpha = particle.opacity;
    ctx.fill();
    ctx.restore(); // restaura o estado original do canvas
  }
}

function mainLoop() {
  var particles = createParticles(config);
  function loop() {
    updateParticles(particles, config);
    renderParticles(particles, canvas);
    requestAnimationFrame(loop);
  }
  loop();
}

mainLoop();