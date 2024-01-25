<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Estilos CSS (mantidos os mesmos) */
    body {
      background-color: grey;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      flex-direction: column;
    }

    canvas {
      border: 1px solid #000;
    }

    #score, #satoshis { /* Modificado o ID */
      font-family: fantasy;
      font-size: 20px;
      margin-top: 10px;
      text-transform: uppercase;
    }

    #winMessage {
      display: none;
      font-family: 'Game Font', sans-serif;
      font-size: 24px;
      font-weight: bold;
      color: green;
      margin-top: 20px;
    }
  </style>
  <title>Snake Game</title>
</head>
<body>
  <!-- Estrutura HTML (modificação no elemento #coins) -->
  <canvas id="snakeCanvas" width="400" height="400"></canvas>
  <p id="score">SCORE: 0</p>
  <p id="satoshis">SATOSHIS: 0</p> <!-- Modificado o ID -->
  <p id="winMessage">Parabéns! Você ganhou!</p>

  <script>
    // Configurações do jogo (mantidas as mesmas)
    const canvas = document.getElementById('snakeCanvas');
    const scoreElement = document.getElementById('score');
    const satoshiElement = document.getElementById('satoshis'); // Modificado o ID
    const winMessageElement = document.getElementById('winMessage');
    const ctx = canvas.getContext('2d');
    const gridSize = 20;
    let snake = [{ x: 10, y: 10 }];
    let food = { x: 15, y: 15 };
    let direction = 'none';
    let frameCount = 0;
    const framesPerUpdate = 10;
    let score = 0;
    let satoshis = 0; // Removido o uso do localStorage
    const foodImage = new Image();
    foodImage.src = 'bitcoin.png';
    const backgroundImage = new Image();
    backgroundImage.src = 'fundo.png';
    const snakeColors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#FFA500', '#008000', '#800080', '#800000'];
    let currentSnakeColor;
    let obstacles = [];
    let obstacleFrequency = 100;
    let gameWon = false; // Adicionada a variável para controlar se o jogo foi ganho

    function getRandomSnakeColor() {
      const randomIndex = Math.floor(Math.random() * snakeColors.length);
      return snakeColors[randomIndex];
    }

    function drawSnake() {
      ctx.fillStyle = currentSnakeColor;
      snake.forEach(segment => {
        ctx.fillRect(segment.x * gridSize, segment.y * gridSize, gridSize, gridSize);
      });
    }

    function drawFood() {
      ctx.drawImage(foodImage, food.x * gridSize, food.y * gridSize, gridSize, gridSize);
    }

    function drawObstacles() {
      ctx.fillStyle = 'black';
      obstacles.forEach(obstacle => {
        ctx.fillRect(obstacle.x * gridSize, obstacle.y * gridSize, gridSize, gridSize);
      });
    }

    function drawScore() {
      scoreElement.textContent = 'Score: ' + score;
    }

    function drawSatoshi() { // Modificado o nome da função
      satoshiElement.textContent = 'Satoshis: ' + satoshis; // Modificado o ID
    }

    function showWinMessage() {
      winMessageElement.style.display = 'block';
      setTimeout(() => {
        satoshis += 10; // Adiciona 10 satoshis ao ganhar o jogo
        drawSatoshi();
        resetGame();
        hideWinMessage();
      }, 4000); // Ajustado o tempo para 4 segundos
    }

    function hideWinMessage() {
      winMessageElement.style.display = 'none';
    }

    function drawBackground() {
      ctx.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);
    }

    function updateSnake() {
      if (gameWon) return; // Não atualiza a cobra se o jogo já foi ganho

      frameCount++;

      if (frameCount < framesPerUpdate) {
        return;
      }

      frameCount = 0;

      const head = { ...snake[0] };
      let newDirection;

      switch (direction) {
        case 'up':
          head.y -= 1;
          break;
        case 'down':
          head.y += 1;
          break;
        case 'left':
          head.x -= 1;
          break;
        case 'right':
          head.x += 1;
          break;
      }

      if (
        (newDirection === 'up' && direction !== 'down') ||
        (newDirection === 'down' && direction !== 'up') ||
        (newDirection === 'left' && direction !== 'right') ||
        (newDirection === 'right' && direction !== 'left')
      ) {
        direction = newDirection;
      }

      snake.unshift(head);

      if (head.x === food.x && head.y === food.y) {
        generateFood();
        score += 10;
        drawScore();

        if (score >= obstacleFrequency) {
          obstacleFrequency += 100;
          generateObstacle();
        }

        if (score >= 200) {
          gameWon = true;
          showWinMessage();
        }
      } else {
        snake.pop();
      }
    }

    function generateFood() {
      let newFood;
      do {
        newFood = {
          x: Math.floor(Math.random() * (canvas.width / gridSize)),
          y: Math.floor(Math.random() * (canvas.height / gridSize))
        };
      } while (isFoodOnSnake(newFood));

      food = newFood;
    }

    function isFoodOnSnake(newFood) {
      return snake.some(segment => segment.x === newFood.x && segment.y === newFood.y);
    }

    function generateObstacle() {
      const obstacle = {
        x: Math.floor(Math.random() * (canvas.width / gridSize)),
        y: Math.floor(Math.random() * (canvas.height / gridSize))
      };
      obstacles.push(obstacle);
    }

    function checkCollisions() {
      const head = snake[0];

      if (head.x < 0 || head.x >= canvas.width / gridSize || head.y < 0 || head.y >= canvas.height / gridSize) {
        gameOver();
      }

      for (let i = 1; i < snake.length; i++) {
        if (head.x === snake[i].x && head.y === snake[i].y) {
          gameOver();
        }
      }

      obstacles.forEach(obstacle => {
        if (head.x === obstacle.x && head.y === obstacle.y) {
          gameOver();
        }
      });
    }

    function gameOver() {
      resetGame();
    }

    function resetGame() {
      snake = [{ x: 10, y: 10 }];
      direction = 'none';
      score = 0;
      drawScore();
      generateFood();
      currentSnakeColor = getRandomSnakeColor();
      obstacles = [];
      obstacleFrequency = 100;
      gameWon = false; // Reinicia a variável de controle de vitória
      drawSatoshi(); // Modificado o nome da função
    }

    function gameLoop() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      drawBackground();
      drawSnake();
      drawFood();
      drawObstacles();
      drawScore();
      drawSatoshi(); // Modificado o nome da função
      updateSnake();
      checkCollisions();
      requestAnimationFrame(gameLoop);
    }

    document.addEventListener('keydown', (event) => {
      let newDirection;

      switch (event.key) {
        case 'ArrowUp':
          newDirection = 'up';
          break;
        case 'ArrowDown':
          newDirection = 'down';
          break;
        case 'ArrowLeft':
          newDirection = 'left';
          break;
        case 'ArrowRight':
          newDirection = 'right';
          break;
      }

      if (
        (newDirection === 'up' && direction !== 'down') ||
        (newDirection === 'down' && direction !== 'up') ||
        (newDirection === 'left' && direction !== 'right') ||
        (newDirection === 'right' && direction !== 'left')
      ) {
        direction = newDirection;
      }
    });

    generateFood();
    resetGame();
    gameLoop();
  </script>
</body>
</html>
