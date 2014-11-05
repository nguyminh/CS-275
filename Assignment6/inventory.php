<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $password, 'nguyminh-db');
$records = array();

if(!empty($_POST)){
  if(isset($_POST['name'], $_POST['category'], $_POST['price'])){
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price    = trim($_POST['price']);
      if(!empty($name) && !empty($category) && !empty($price)){
	$insert = $db->prepare("INSERT INTO inventory (name, category, price) VALUES (?, ?, ?)");
        $insert->bind_param('ssd', $name, $category, $price);
        if($insert->execute()){
 	  header('Location: inventory.php');
	}
      } 
   }
}

if(isset($_POST['delete'])){
  $id = $_POST['delete'];
  $del = "DELETE FROM inventory WHERE id = ?";
  $delete = $db->prepare($del);
  $delete->bind_param('i', $id);
  if($delete->execute()){
    header('Location: inventory.php');
  }
}

if($results = $db->query("SELECT * FROM inventory")){
  if($results->num_rows){
    while($row = $results->fetch_object()){
      $records[] = $row;
    }
  }
}

?>

<!DOCTYPE html> 
<html>
  <head>
    <title>Inventory</title>
  </head>
  <body>
     <h3>Inventory</h3>
     <?php 
      if(!count($records)){
           echo "no records";
          } else {
          ?>
     <table border='1px solid black'>
        <thead>
           <tr>
                <th>id</th>
  		<th>name</th>
		<th>category</th>
   		<th>price</th>
       	   <tr>
         </thead>
        <tbody>
  	       <?php
 		 foreach($records as $r){
		?>
              <tr>
		<td><?php echo ($r->id);?></td>
		<td><?php echo ($r->name);?></td>
		<td><?php echo ($r->category);?></td>
		<td><?php echo ($r->price);?></td>
	        <td><form action="" method="post">
 		<button type="submit" value="<?php echo ($r->id);?>" name="delete">Delete</button>
		</form>
	      </tr>
 	       <?php
		}
	        ?>
	</tbody>  
      </table>
        <?php
         }
         ?>
      <hr>
	
       <form action="" method="post">
	 <fieldset>
            <legend>Add products here</legend>
	   <div class="field">
		<label for="name">name</label>
		<input type="text" name="name" id="name">
	   </div>
	  <div class="field">
		<label for="category">category</label>
		<input type="text" name="category" id="category">
	  </div>
	   <div class="field">
		<label for="price">price</label>
		<input type="text" name="price" id="price">
      	  </div>
	     <input type="submit" value="Add Product">
          </fieldset>
       </form>
	
	<hr>
	<form action="" method="post">
   	  <fieldset>
	     <legend>Alter the price</legend>
             <div class="field">
	        <select>
		  <option value="1">1
 		  <option value="2">2
		</select>
              <label for="percent">Enter in percent</label>
              <input type="text" name="alter">
	      <input type="submit" value="Alter prices">
           </fieldset>
         </form>
    </body>
</html>	
  	
