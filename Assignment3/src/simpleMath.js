SimpleMath = function() {};
/**
 * @param {number} number - input into the factorial function
 *
 * @return {number} factorial of number, throw an error
 * if the number is negative
*/
SimpleMath.prototype.getFactorial = function(number) {

  if (typeof number != 'number') {
    throw new Error('There is no factorial for non-numbers');
  }
  else if (number < 0) {
    throw new Error('There is no factorial for negative numbers');
  }
  
  else {
	var factorial = 1;
	for (var i = 1; i < number + 1; i++){
		factorial *= i;
		}
    return factorial;
	}
  
 };

/**
* @param {number} number - number to test
*
* @return {number} - 1 if `number` is positive, 0 if 0, -1 if negative.
* Behaviour on non-numbers is undefined.
*/
SimpleMath.prototype.signum = function(number) {
	if (number > 0){
		return 1;
	}else if (number === 0){
		return 0;
	}else {
	return -1;
	}

 };

/**
* @param {number} number1 - first number to average
* @param {number} number2 - second number to average
*
* @return {number} the mathematical average of the two numbers.
*/
SimpleMath.prototype.average = function(number1, number2) {
		return (number1 + number2) / 2;
  
};

