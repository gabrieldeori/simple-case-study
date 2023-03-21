const numericButtons = document.querySelectorAll('.numeric-button');
const operationButtons = document.querySelectorAll('.operation-button');
const dotButton = document.getElementById('dotButton');
const equalButton = document.getElementById('equalButton');
const ceButton = document.getElementById('ceButton');
const mrcButton = document.getElementById('mrcButton');
const mmButton = document.getElementById('mmButton');
const mpButton = document.getElementById('mpButton');
const inputScreen = document.getElementById('screenInput');

function showResult(value) {
  inputScreen.value = value;
}

function makeCalc(array) {
  let result = 0;
  let operation = "+";
  
  for (let i = 0; i < array.length; i++) {
    const curr = array[i];
    
    if (!isNaN(curr)) {
      switch (operation) {
        case "+":
          result += Number(curr);
          break;
        case "-":
          result -= Number(curr);
          break;
        case "*":
          result *= Number(curr);
          break;
        case "/":
          if (curr === "0") {
            return "Divisão por 0";
          }
          result /= Number(curr);
          break;
      }
    } else {
      operation = curr;
    }
  }
  
  return result;
}

function buttonAddListeners() {
  operationButtons.forEach((button) => {
    const regex = /\d$/;
    button.addEventListener('click', ({ target: value }) => {
      if (regex.test(inputScreen.value)) {
        inputScreen.value += " " + value.innerText + " ";
      }
    });
  });
  
  dotButton.addEventListener('click', () => {
    const regex = /(?<=\d)/;
    if (regex.test(inputScreen.value)) {
      inputScreen.value += '.';
    }
  })
  
  numericButtons.forEach((button) => {
    button.addEventListener('click', ({ target: value }) => {
        inputScreen.value += value.innerText;
    });
  });

  equalButton.addEventListener('click', () => {
    const getScreen = inputScreen.value.split(" ");
    const result = makeCalc(getScreen);
    showResult(result);
  });

  ceButton.addEventListener('click', () => {
    inputScreen.value = "";
  });
}

buttonAddListeners();
