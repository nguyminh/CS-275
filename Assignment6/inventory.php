<?php
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $password, 'nguyminh-db');
$records = array();

if(!empty($_POST)){
  if(isset($_POST['name'], $_POST['category'], $_POST['price'])){
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price    = trim($_POST['price']);
      if(!empty($name) && !empty($category) && !empty($price)){
        if(is_numeric($price) && $price < 1000){
        $insert = $db->prepare("INSERT INTO inventory (name, category, price) VALUES (?, ?, ?)");
        $insert->bind_param('ssd', $name, $category, $price);
        if($insert->execute()){
          $insert->close();
 	  header('Location: inventory.php');
	} else {
          $insert->bind_result($name, $category, $price);
          $count = 1;
          $insert->close();
          if(empty($price)){
             $msg = "Price must be a number!";
             echo "<script type='text/javascript'>alert('$msg');</script>";
           } 
          while ($count != 0){
            $query = "SELECT COUNT(*) FROM inventory WHERE name = '$name'";
            if($stmt = $db->prepare($query)){
               $stmt->execute();
               $stmt->close();
               $stmt->bind_result($count);
               $stmt->fetch();
            } else {
               die("Query error");
            }
           if($count != 0){
           $message = "$name is used twice, please try again!";
           echo "<script type='text/javascript'>alert('$message');</script>";
           break;
           }
          }  
        }     
     } else {
       $message = "price is an invalid entry, please try again";
       echo "<script type='text/javascript'>alert('$message');</script>"; 
     }
    } else {
        if(empty($name)){
         $message = "name field is empty, please try again";
         echo "<script type='text/javascript'>alert('$message');</script>";
        }
        if(empty($category)){
         $message = "category field is empty, please try again";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        if(empty($price)){
          $message = "price field is empty, please try again";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
      }
    }
}


if(isset($_POST['deleteAll'])){
   $del = "TRUNCATE TABLE inventory";
  if(!mysqli_query($db, $del)){
       echo "deletion failed!";
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
           echo "Table empty. Please enter in an inventory item";
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
            <legend>Add inventory here</legend>
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
	     <input type="submit" value="Add inventory">
          </fieldset>
       </form>
	
	<hr>
	<form action="" method="post">
   	  <fieldset>
	     <legend>Alter the price</legend>
             <div class="field">
              <select>
	        <?php foreach($records as $cat){
                 ?> 
               <option value="<?php echo ($cat->category);?>"><?php echo ($cat->category);?>
               </option><?php } ?>
		</select>
                      
              <label for="percent">Enter in percent</label>
              <input type="text" name="alter">
	      <input type="submit" value="Alter prices">
           </fieldset>
         </form>
	<hr>
	<form action="" method="post">
               <div>
		 <button type="submit" value="" name="deleteAll">Delete all products</button>
 	      </div>
        </form>  	
    </body>
</html>	
  	
