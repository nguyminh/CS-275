function ajaxRequest(URL, Type, Parameters) {
  var REQ = new XMLHttpRequest();
  if (!REQ) {
    throw 'Unable to create HttpRequest.';
  }
  var pass;
  REQ.onreadystatechange = function() {
    if (REQ.readyState === 4 && REQ.status === 200) {
      pass = true;
    } else {
      pass = false;
    }
    var requestStat = REQ.status;
    var Details = REQ.statusText;
    var respo = JSON.parse(REQ.responseText);
  };
  REQ.open(Type, URL, true);
  REQ.send();

  return {
    success: pass,
    code: requestStat,
    codeDetail: Details,
    response: respo
  };
}


  
function localStorageExists() {
  localStorage.setItem('Try', 'It works!');
  var outcome = localStorage.getItem('Try');
  if (outcome === 'It works!')
    return true;
   else
     return false;
}	
 



