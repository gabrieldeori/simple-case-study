const numericButtons = document.querySelectorAll('.numeric-button');
const operationButtons = document.querySelectorAll('.operation-button');
const dotButton = document.getElementById('dotButton');
const equalButton = document.getElementById('equalButton');
const ceButton = document.getElementById('ceButton');
const mrButton = document.getElementById('mrButton');
const mcButton = document.getElementById('mcButton');
const mmButton = document.getElementById('mmButton');
const mpButton = document.getElementById('mpButton');
const memoryIdentificator = document.getElementById('memoryIdentificator');
const inputScreen = document.getElementById('screenInput');

let secoMemory = "";

function showResult(value) {
  inputScreen.value = value;
}

function makeCalc(array) {
  let result = 0;
  let operation = "+";

  for (let i = 0; i < array.length; i++) {
    const curr = array[i];
    
    if (curr === "*" || curr === "/") {
      const prev = array[i-1];
      const next = array[i+1];
      const currResult = curr === "*" ? prev * next : prev / next;
      array.splice(i-1, 3, currResult);
      i -= 2;
    }
  }

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
      }
    } else {
      operation = curr;
    }
  }
  
  return `${result}`;
}

function buttonAddListeners() {
  operationButtons.forEach((button) => {
    const regex = /[0-9]$/;
    button.addEventListener('click', ({ target: value }) => {
      console.log(value);
      console.log(value.value);
      if (regex.test(inputScreen.value)) {
        inputScreen.value += value.value;
      }
    });
  });
  
  dotButton.addEventListener('click', () => {
    const regex = /^(?:(?!\.)\d)+(?:\.\d+)?(?:[+\-*/](?:(?!\.)\d)+(?:\.\d+)?)*$/;
    if (regex.test(inputScreen.value)) {
      inputScreen.value += '.';
    }
  })
  
  numericButtons.forEach((button) => {
    button.addEventListener('click', ({ target: value }) => {
        inputScreen.value += value.value;
    });
  });

  equalButton.addEventListener('click', () => {
    const regex = /([-+*/])/g
    const getScreen = inputScreen.value.split(regex, -1);
    const result = makeCalc(getScreen);
    showResult(result);
  });

  ceButton.addEventListener('click', () => {
    inputScreen.value = "";
  });

  delButton.addEventListener('click', () => {
    inputScreen.value = inputScreen.value.slice(0, -1);
  });

  mrButton.addEventListener('click', () => {
    if(secoMemory != "") {
      inputScreen.value += secoMemory;
    }
  });

  mcButton.addEventListener('click', () => {
    secoMemory = "";
    memoryIdentificator.innerText = "";
  });

  mpButton.addEventListener('click', () => {
    if(isNaN(secoMemory) || isNaN(inputScreen.value)) {
      secoMemory += inputScreen.value;
    } else {
      secoMemory = Number(secoMemory) + Number(inputScreen.value);
    }
    memoryIdentificator.innerText = "m";
  });

  mmButton.addEventListener('click', () => {
    if(isNaN(secoMemory) || isNaN(inputScreen.value)) {
      secoMemory += "-" + inputScreen.value;
    } else {
      secoMemory = Number(secoMemory) - Number(inputScreen.value);
    }
    memoryIdentificator.innerText = "m";
  });
}

buttonAddListeners();
