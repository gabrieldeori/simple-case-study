ZODIAC_SEARCH = "zodiac-search.json";
PTBR = "ptbr";

async function loadDatabase(file) {
  try {
    const response = await fetch(file);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Erro ao carregar o arquivo JSON:', error);
    throw error;
  }
}

async function zodiacSearch(receivedDate) {
  const actualDate = new Date(receivedDate)
  try {
    const signs = await loadDatabase(ZODIAC_SEARCH);

    const signResult = Object.entries(signs).find(([key, sign]) => {
      const dateMin = new Date(sign.dateMin);
      const dateMax = new Date(sign.dateMax);
      
      if (key === "capricorn") {
        return actualDate >= dateMin || actualDate <= dateMax;
      }
      return (actualDate >= dateMin && actualDate  <= dateMax);
    })
    return signResult;
    
  } catch (erro) {
    console.error('Erro ao usar os dados:', erro);
  }
}

async function zodiacConstructor([key, value], language) {
  try {
    const languageMatch = await loadDatabase(language);
    const concatInfo = Object.assign(value, languageMatch[key]) // prioridade languageMatch
    return concatInfo;
  } catch (erro) {
    console.error('Erro ao usar os dados: ', erro);
  }
}

async function getZodiac(date, language) {
  languagePath = language + ".json";
  const zodiac = await zodiacSearch(date);
  const zodiacSign = await zodiacConstructor(zodiac, languagePath);
  return zodiacSign;
}

function updateResultField(sign) {
  const elements = ["fogo", "terra", "ar", "água"];
  document.getElementById("signResult").classList.remove("hidden");
  const title = document.getElementById("resultTitle");
  const data = document.getElementById("resultData");
  const pedra = document.getElementById("resultPedra");
  const elemento = document.getElementById("resultElemento");

  title.innerText = `${sign.symbol} ${sign.name} ${sign.symbol}`;
  data.innerText = `Formato (Mês-Dia) ${sign.dateMin} até ${sign.dateMax}`;
  pedra.innerText = `${sign.stone}`;
  elemento.innerText = `${elements[sign.element]}`;
}

async function getDateFromInput() {
  const dateInput = document.getElementById("dataNascimento");

  await dateInput.addEventListener('change', async ({ target: { value } }) => {
    if (value != "") {
      const splitDate = value.split('-');
      const dMDate = `${splitDate[1]}-${splitDate[2]}`;
      const clientZodiacSign = await getZodiac(dMDate, PTBR);
      updateResultField(clientZodiacSign);
    }
  });
}

getDateFromInput();
