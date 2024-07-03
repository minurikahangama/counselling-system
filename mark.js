const checkButton = document.getElementById('checkButton');
const scoreInput = document.getElementById('score');
const resultDiv = document.getElementById('result');

function checkStage() {
  const score = parseInt(scoreInput.value);
  let stage;

  if (score >= 1 && score <= 10) {
    stage = "Normal";
  } else if (score >= 11 && score <= 16) {
    stage = "Mild mood disturbance";
  } else if (score >= 17 && score <= 20) {
    stage = "Borderline clinical depression";
  } else if (score >= 21 && score <= 30) {
    stage = "Moderate depression";
  } else if (score >= 31 && score <= 40) {
    stage = "Severe depression";
  } else if (score > 40) {
    stage = "Extreme depression";
  } else {
    stage = "Invalid score. Please enter a number between 1 and 50.";
  }

  resultDiv.textContent = `Your depression stage is: ${stage}`;
}

checkButton.addEventListener('click', checkStage);
