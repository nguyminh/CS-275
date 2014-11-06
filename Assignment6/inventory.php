<?php
include 'info.php';

$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');


$records = array();

//Post request sent to this logic block
if(!empty($_POST)){
  if(isset($_POST['name'], $_POST['category'], $_POST['price'])){
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price    = trim($_POST['price']);
//if all field is filled, do this block
      if(!empty($name) && !empty($category) && !empty($price)){
//price must be numeric, and less than 1000 as specified       
        if(is_numeric($price) && $price < 1000){
        $insert = $db->prepare("INSERT INTO inventory (name, category, price) VALUES (?, ?, ?)");
        $insert->bind_param('ssd', $name, $category, $price);
        if($insert->execute()){
          $insert->bind_result($name, $category, $price);
          $insert->close();
 	  header('Location: inventory.php');
//if execute fails, it means there are duplicate keys for name field. Since it must be unique
	} else {
          $insert->bind_result($name, $category, $price);
          $count = 1;
          $insert->close();
//while loop to check if name is used twice
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
//if name is used twice, display message and leave POST attempt
           if($count != 0){
           $message = "$name is used twice, please try again!";
           echo "<script type='text/javascript'>alert('$message');</script>";
           break;
           }
          }  
        }     
//If price is not numeric or less than 1000, display error
     } else {
       $message = "price is an invalid entry, please try again";
       echo "<script type='text/javascript'>alert('$message');</script>"; 
     }
//if any of the field is empty, display error
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

//Altering price button
if(isset($_POST['alter']) && isset($_POST['selected'])){
  $alter = (int)$_POST['alter'];
  $selected = $_POST['selected'];
     if(!empty($alter)){
       if(is_numeric($alter) && $alter < 101){
//converts the number input into percentage
           $newAlter = ($alter / 100);
//prepare statement that changes the price to price * percentage
           $update = $db->prepare("UPDATE inventory SET price = (price * ?) WHERE category = ?");
           $update->bind_param('ds', $newAlter, $selected);
         if($update->execute()){
           $update->close();
 	   header('Location: inventory.php');
         } else {
            echo "update failed";
          }
       } else{
          $message = "Invalid percentage input, try again";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
      } else{
        $message = "You forgot to enter in a number!";
         echo "<script type='text/javascript'>alert('$message');</script>";
       }
      
}         

//deleteALL button
if(isset($_POST['deleteAll'])){
   $del = "TRUNCATE TABLE inventory";
  if(!mysqli_query($db, $del)){
       echo "deletion failed!";
  }
}
   
// deleting single rows button
if(isset($_POST['delete'])){
  $id = $_POST['delete'];
  $del = "DELETE FROM inventory WHERE id = ?";
  $delete = $db->prepare($del);
//deletes row via id 
  $delete->bind_param('i', $id);
  if($delete->execute()){
    header('Location: inventory.php');
  }
}

//storing the array to populate in table
if($results = $db->query("SELECT * FROM inventory")){
  if($results->num_rows){
    while($row = $results->fetch_object()){
      $records[] = $row;
    }
  }
}

//storing distinct categories for dropdown menu
$types = array();
if($results = $db->query("SELECT DISTINCT category FROM inventory")){
   if($results->num_rows){
      while($row = $results->fetch_object()){
         $types[] = $row;
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
  	       <?php      //for each table row, echo out what was stored in records array from mysql
 		 foreach($records as $r){
		?>
              <tr>
		<td><?php echo ($r->id);?></td>
		<td><?php echo ($r->name);?></td>
		<td><?php echo ($r->category);?></td>
		<td>$<?php echo ($r->price);?></td>
	        <td><form action="" method="post"> <?php // value must be equal to r-id so it can delete a unique id every new row ?>
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
	     <legend>Alter the price for a category</legend>
             <div class="field">
              <select name="selected">
	        <?php 
                     foreach($types as $cat){
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
  	
