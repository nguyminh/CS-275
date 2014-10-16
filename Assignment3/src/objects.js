/**
* Create an object literal with the following key value pairs:
* type: {string} 'Goldfish'
* brand: {string} 'Pepperidge Farm'
* flavor: {string} 'Cheddar'
* count: {number} 2000
* It should be returned direcly by the following function
* @return {object} - the object literal
*/

function returnObjectLiteral() {
 
  return {
			type: "Goldfish", 
			brand: "Pepperidge Farm", 
			flavor: "Cheddar", 
			count: 2000
		  }; 
  
}

/**
* Create a constructor function for a `Cat` object.
* @constructor
* @param {string} name - The name of the cat as a string
* @param {string} color - The color of the cat
* The above values should be stored and be accessable via the name and color
* properties respectively. In addition, the following methods should be
* callable on a Cat object:
* destroyFurniture({string} name, {number} cost) - adds a piece of destroyed
* furnature
* lastDestroyedFurniture() - returns a object with two key value pairs with
* keys 'name' and 'cost' and values corrisponding to the name and cash money
* value of the last item destroyed.
* totalDestroyed() - returns a {number} that is the total value of destroyed
* furnature.
* nthDestroyed( {number} n ) - Returns the nth destroyed furnature. 0 should
* return the first item destroyed, 1 the second and so on. It should return it
* as an object just as lasatDestroyedFurniture does.
*/
function Cat(name, color){
	this.name = name;
	this.color = color; 
	
	var destroy = [];
	this.destroyFurniture = function(name, cost){
		destroy.push([name,cost]);
		}

	this.lastDestroyedFurniture = function(){
		var lastDestroyed = {
			name: destroy[destroy.length - 1][0],
			cost: destroy[destroy.length - 1][1]
			};
			return lastDestroyed;
		};

	this.totalDestroyed = function(){
		var totalValue = 0;
		for (var i = 0; i < destroy.length; i++){
			totalValue += destroy[i][1];
		}
		return totalValue;
	};
	
	this.nthDestroyed = function(n) {
	var nDestroy = {
		name: destroy[n][0],
		cost: destroy[n][1]
		};
		return nDestroy;
	};
};

/**
* Create an instance of a 'Orange' cat with the name 'Maru' stored in a variable
* called myCat. Call the destroyFurniture function on at least $1000 of
* furniture.
*/

var myCat = new Cat('Maru', 'Orange');
myCat.destroyFurniture('sofa', '1000');

/**
* Add a method to the cat prototype called 'pet'. This function should accept
* a {number} n as an argument. If that {number} is greater than 2.5 it should
* return the {string} 'CLAW!' if that {number} is less than or equal to 2.5
* it should return the {string} 'Purr.'.
* @param {number} n - The number of pets
* @return {string} - The cats reaction.
*/
Cat.prototype.pet = function(n) {
	if (n > 2.5){
	return 'CLAW!';
	} else {
	 return 'Purr.';
	 }
	};
