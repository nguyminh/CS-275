var settings = null;
var REQ = new XMLHttpRequest();

function SaveAll() {
  localStorage.setItem('city', document.getElementById('cityID').value);
  localStorage.setItem('state', document.getElementById('stateID').value);
  localStorage.setItem('wind', document.getElementById('check1').checked);
  localStorage.setItem('mint', document.getElementById('check2').checked);
  localStorage.setItem('maxt', document.getElementById('check3').checked);
  localStorage.setItem('currt', document.getElementById('check4').checked);
}
 
function LoadAll() {
  document.getElementById('cityID').value = localStorage.getItem('city');
  document.getElementById('stateID').value = localStorage.getItem('state');
  if (localStorage.getItem('wind') === 'true') {
    document.getElementById('check1').checked = true;
  }
  if (localStorage.getItem('mint') === 'true') {
    document.getElementById('check2').checked = true;
  }
  if (localStorage.getItem('maxt') === 'true') {
    document.getElementById('check3').checked = true;
  }
  if (localStorage.getItem('currt') === 'true') {
    document.getElementById('check4').checked = true;
  }
}

window.onload = function() {
  LoadAll();
};

function GetAll() {
  if(!REQ) {
    throw 'Unable to create HttpRequest!';
  }
  var city = document.getElementById('cityID').value;
  var state = document.getElementById('stateID').value;
  var partialURL = 'http://api.openweathermap.org/data/2.5/weather?q=';
  var url = partialURL + city + ',' + state + '&units=imperial';
  REQ.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      var response = JSON.parse(this.responseText);
      var winddi = response.wind.deg;
      var windsp = response.wind.speed;
      var currt = response.main.temp;
      var mint = response.main.temp_min;
      var maxt = response.main.temp_max;
      document.getElementById('cityOUT').innerHTML =
        document.getElementById('cityID').value;
      document.getElementById('stateOUT').innerHTML =
        document.getElementById('stateID').value;

      if (document.getElementById('check1').checked === true) {
        document.getElementById('windDIR').innerHTML = winddi;
      } else {
        document.getElementById('windDIR').innerHTML =
          "No information requested";
      }
      if (document.getElementById('check1').checked === true) {
        document.getElementById('windSPD').innerHTML = windsp + ' mph';
      } else {
        document.getElementById('windSPD').innerHTML =
          "No information requested";
      }
      if (document.getElementById('check2').checked === true) {
        document.getElementById('minOUT').innerHTML = mint +
          ' degrees fahrenheit';
      } else {
        document.getElementById('minOUT').innerHTML =
          "No information requested";
      }
      if (document.getElementById('check3').checked === true) {
        document.getElementById('maxOUT').innerHTML = maxt +
          ' degrees fahrenheit';
      } else {
        document.getElementById('maxOUT').innerHTML =
          "No information requested";
      }
      if (document.getElementById('check4').checked === true) {
        document.getElementById('currOUT').innerHTML = currt +
          ' degrees fahrenheit';
      } else {
        document.getElementById('currOUT').innerHTML =
          "No information requested";
      }

      REQ.open('GET', url);
      REQ.send();
    }
  };	 

function clearStorage() {
  localStorage.clear();
}


