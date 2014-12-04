-- Minh Nguyen
-- Assignment 2, selection. sql
-- 11/9/2014

#1 Find the film title and category name of all films in which SANDRA PECK acted
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
SELECT f.title, c.name FROM film f
INNER JOIN film_actor fa ON f.film_id = fa.film_id
INNER JOIN actor a ON fa.actor_id = a.actor_id
INNER JOIN film_category fc ON fc.film_id = f.film_id
INNER JOIN category c ON fc.category_id = c.category_id
WHERE a.first_name LIKE '%sandra%' 
ORDER BY f.title DESC;


#2 We want to find out how many of each category of film each actor has starred in so return a table with actor's id, actor's first name, actor's last name, category name and the count
#of the number of films that the actor was in which were in that category. Order the results by the actor's id, last name, first name and category name ascending. (Please pay attention that there may be many actors with the same last names, and also there may be few actors with the exact same first names and last names)
SELECT a.actor_id, a.first_name, a.last_name, c.name, COUNT(f.film_id) FROM film f
INNER JOIN film_category fc ON fc.film_id = f.film_id
INNER JOIN category c ON c.category_id = fc.category_id
INNER JOIN film_actor fa ON fa.film_id = f.film_id
INNER JOIN actor a ON a.actor_id = fa.actor_id
ORDER BY a.actor_id, a.last_name, a.first_name, c.name ASC;




#3 Find the first name, last name and total combined film length of Action films for every actor whose last name starts with 'B'.
#That is the result should list the names of actors and the total lenght of Action films they have been in.(Your query should also list those actors whose last names start with 'B', but never acted in an Action film.)

SELECT a.first_name, a.last_name, SUM(f.length) FROM film f
INNER JOIN film_actor fa ON f.film_id = fa.film_id 
INNER JOIN actor a ON a.actor_id = fa.actor_id
LEFT JOIN film_category fc ON fc.film_id = f.film_id
LEFT JOIN category c ON c.category_id = fc.category_id
WHERE a.last_name LIKE "B%" AND ((c.name = 'Action' Or c.name IS NULL) OR a.actor_id NOT IN (SELECT a.actor_id FROM actor a INNER JOIN film_actor fa ON fa.actor_id = a.actor_id INNER JOIN film f ON f.film_id = fa.film_id INNER JOIN film_category fc ON fc.film_id = f.film_id INNER JOIN category c ON c.category_id = fc.category_id AND c.name = 'Action'))
GROUP BY a.actor_id;




#4 Find the first name and last name of all actors who have never been in an Action film that has a length of more than 100 minutes.
SELECT a.first_name, a.last_name FROM actor a 
INNER JOIN film_actor fa ON fa.actor_id = a.actor_id
INNER JOIN film f ON fa.film_id = f.film_id
INNER JOIN film_category fc ON f.film_id = fc.film_id
INNER JOIN category c ON c.category_id = fc.category_id
WHERE f.length > 100 AND a.actor_id NOT IN (SELECT a.actor_id FROM actor a INNER JOIN film_actor fa ON fa.actor_id = a.actor_id INNER JOIN film f ON f.film_id = fa.film_id INNER JOIN film_category fc ON fc.film_id = f.film_id INNER JOIN category c ON c.category_id = fc.category_id AND c.name = 'Action');




#5 Find the film title of all films which feature both SCARLETT DAMON and BEN HARRIS
#Order the results by title, descending (use ORDER BY title DESC at the end of the query)
#Warning, this is a tricky one and while the syntax is all things you know, you have to think oustide
#the box a bit to figure out how to get a table that shows pairs of actors in movies
SELECT f.title FROM film f
INNER JOIN film_actor fa ON f.film_id = fa.film_id
INNER JOIN  actor a ON fa.actor_id = a.actor_id
INNER JOIN  film_actor fa2 ON f.film_id = fa2.film_id
INNER JOIN  actor a2 ON fa2.actor_id = a2.actor_id
WHERE a.first_name = 'SCARLETT' AND a.last_name ='DAMON'
AND a2.first_name = 'BEN' AND a2.last_name = 'HARRIS';

