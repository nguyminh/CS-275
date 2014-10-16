/*
Input:
a: a whole, positive number

Output:
plus5: a number that is the sum of 5 and `a`
asString: a string that is just `a` converted to a string
asStringWithFoo: a string that is `a` with the string 'foo' appended
a: the original a number
*/
function variableModification(a) {
  var plus5;
  var asString;
  var asStringWithFoo;
 
   plus5 = a + 5;
   asString = a + '';
   asStringWithFoo = a + 'foo';

  return [plus5, asString, asStringWithFoo, a];
  
}

/*
Input:
b: could be anything

Output:
return true if b is a primitive string value, false otherwise
*/
function isString(b) {
  if (b instanceof Object){
	 return false;
	} else if (b + 5 == b - 5 + 10) {
		return false;
	} else {
		return true;
	}
  
  
}

/*
Input:
c: could be anything

Output:
return true if c is undefined, false otherwise
*/
function isUndefined(c) {
 if ( c === undefined){
	return true;
 } else {
	return false;
}
  
}
