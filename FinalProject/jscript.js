//ajax login function
function login() {
  var REQ = new XMLHttpRequest();
  var url = "logjax.php";
  var name = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var vars = "username="+name+"&password="+password;
  REQ.open("POST", url, true);
  REQ.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4 && REQ.status === 200) {
      var response = REQ.responseText;
	  document.getElementById("status").innerHTML = response;
	}
  }
  REQ.send(vars);
  document.getElementById("status").innerHTML = "processing...";
}

//ajax chat function to send
function sendchat() {
  var REQ = new XMLHttpRequest();
  var url = "chatIn.php";
  var chat = document.getElementById("chat").value;
  var vars = "chat="+chat;
  REQ.open("POST", url, true);
  REQ.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4 && REQ.status === 200) {
      var response = REQ.responseText;
	  document.getElementById("stat").innerHTML = response;
	  document.getElementById("chat").innerHTML = "";
	}
  }
  REQ.send(vars);
  document.getElementById("stat").innerHTML = "sending text...";
  document.getElementById("chat").innerHTML = "";
}

//ajax chat function to fill in chat box
function showChat() {
  var REQ = new XMLHttpRequest();
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4 && REQ.status === 200) {
      var response = REQ.responseText;
	  document.getElementById("view").innerHTML = response;
	}
  }
  REQ.open("GET", "chatOut.php", true);
  REQ.send();
  setTimeout(showChat, 1000);
}

//ajax count function to display # of users
function counter() {
  var REQ = new XMLHttpRequest();
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4 && REQ.status === 200) {
      var response = REQ.responseText;
	  document.getElementById("viewCount").innerHTML = response;
	}
  }
  REQ.open("GET", "counter.php", true);
  REQ.send();
  setTimeout(counter, 10000);
}

//function to erase text field after clicking send message
function erase() {
  document.getElementById("chat").value = "";
}






