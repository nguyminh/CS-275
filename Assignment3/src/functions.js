/**
* the \@param notation indicates an input paramater for a function. For example
* @param {string} foobar - indicates the function should accept a string
* and it should be called foobar, for example function(foobar){}
* \@return is the value that should be returned
*/

/**
* Write a function called `uselessFunction`.
* It should accept no arguments.
* It should return the string primitive 'useless'.
* @return {string} - 'useless'.
*/


function uselessFunction(){
return "useless";
}


var bar = 'not a function';
var barType = typeof bar;

/**
* Assign the above variable 'bar' to an anonymous function.
* @param {doubleArray|number} doubleArray - an aray of numbers.
* The function should multiply every number in the array by 2 (this should
* change the content of the array).
* @return {boolean} - true if the operation was sucessful, false otherwise.
* This should return false if a value in the array cannot be doubled.
*/


bar = function(doubleArray){
	var doubled = 0;
	
	for (var i = 0; i < doubleArray.length; i++) {
		doubleArray[i] = doubleArray[i] * 2;
    if (!isNaN(doubleArray[i])) {
      doubled++;
    }
  }
  if (doubled === doubleArray.length) {
    return true;
  }else {
    return false;
  }
};
		

	

/**
* Create a function to parse email addresses called emailParse
* @param {array.<string>} emailArray - an array of email address strings of the
* format [local]@[domain].[gTLD]
* a gTLD is a generic top-level domain (ex. com, edu, gov). The original arrray
* should remain unchanged.
* @return {array.<array.<string>>} - return an array of 3 arrays. The arrays
* should
* contain the local, domin and gTLD's respectivley. return[0] should be an
* array of local parts. return[0][5] + '@' + return[1][5] + '.' + return[2][5]
* should reconstruct the 5th email address.
*/

function emailParse(emailArray){
var arrayLoc = [];
var arrayDom = [];
var arrayGTLD = [];
var tmpArr1 = [];
var tmpArr2 = [];

var fullArr = [arrayLoc, arrayDom, arrayGTLD];

for (var i = 0; i < emailArray.length; i++){
	tmpArr1 = emailArray[i].split('@'); //splits everything before @ symbol 
	fullArr[0].push(tmpArr1[0]); //pushes local split to full email
	tmpArr2 = tmpArr1[1].split('.'); //split domain and GTLD
	fullArr[1].push(tmpArr2[0]); //push 1st element of tmpArr2 which is domain
	fullArr[2].push(tmpArr2[1]); //push 2nd element of tmpArr2 which is gtld
	}
	return fullArr;
};

