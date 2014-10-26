/*Minh Nguyen
Assignment 4
studentlibrary.js
*/

//Main ajax function, returns a response object to be tested
function ajaxRequest(URL, Type, Parameters) {
  var REQ = new XMLHttpRequest();
  if (!REQ) {
    alert('Unable to create HttpRequest.');
    return undefined;
  }
  
  //Creating response object to return. Sets as undefined to initiate for fail tests.
  var Response = {}
  Response.success = false;
  Response.code = undefined;
  Response.codeDetail = undefined;
  Response.response = undefined;
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4) {
      Response.code = REQ.status;
      Response.codeDetail = REQ.statusText;
      Response.response = REQ.responseText;
    }
    if (REQ.status === 200) {
      Response.success = true;
    }
  }
   if (Type === 'GET') {
    URL += '?' + addParams(Parameters);
    REQ.open(Type, URL, true);
    REQ.send();
  } else {
    REQ.open(Type, URL, true);
    REQ.setRequestHeader('Content-Type',
      'application/x-www-form-urlencoded');
    REQ.send(addParams(Parameters));
  }
  return Response;
}

//addParams function for finishing off parameters with encodeURIComponent built in function
function addParams(param) {
  var last = '';
  for (obj in param) {
    last += encodeURIComponent(obj) + '=' +
      encodeURIComponent(param[obj]) + '&';
  }
  return last;
}  

//Tests if LocalStorage works, returns true if it does, false if doesn't
function localStorageExists() {
  localStorage.setItem('Try', 'It works!');
  var outcome = localStorage.getItem('Try');
  if (outcome === 'It works!')
    return true;
   else
    return false;
}	
 



