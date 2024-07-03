let gameButton = document.getElementById('gameButton');
let scoreDisplay = document.getElementById('score');
let score = 0;
let gameActive = false;
const gameDuration = 10; // Game duration in seconds

function startGame() {
  if (!gameActive) {
    gameActive = true;
    score = 0;
    scoreDisplay.textContent = 'Score: ' + score;
    gameButton.textContent = 'Click Fast!';
    setTimeout(endGame, gameDuration * 1000);
  }
}

function incrementScore() {
  if (gameActive) {
    score++;
    scoreDisplay.textContent = 'Score: ' + score;
  }
}

function endGame() {
  gameActive = false;
  gameButton.textContent = 'Start Game';
  alert('Game Over! Your final score is: ' + score);
}

// Add event listeners
gameButton.addEventListener('click', startGame);
gameButton.addEventListener('click', incrementScore);
