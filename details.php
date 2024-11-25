<?php 
include("header.php");
include("./config/db_connect.php");
if(isset($_POST["delete"])){
    $id = mysqli_real_escape_string($conn, $_POST["to_delete"]);
    $query = "SELECT * from food_data WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_assoc($result);

        $id = mysqli_real_escape_string($conn, $row['id']);
        $title = mysqli_real_escape_string($conn, $row['title']);
        $ingredients = mysqli_real_escape_string($conn, $row['Ingredients']);
        $email = mysqli_real_escape_string($conn, $row['email']);
        $created_at = mysqli_real_escape_string($conn, $row['created_at']);


        $query = "INSERT INTO deleted_data(title,Ingredients,email,created_at)
                    VALUES ('$title', '$ingredients', '$email', '$created_at')";
        if(mysqli_query($conn, $query)){
            $delete_query = "DELETE from food_data where id = $id";
            if(mysqli_query($conn, $delete_query)){
                
            }
        }
        else{ echo"Delete Failed!";
        }
    }
    mysqli_free_result($result);

}

$row = null;

if(isset($_GET["id"])){
    // echo "ID received: " . htmlspecialchars($_GET["id"]);
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * from food_data WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    session_start();
    $update = $_SESSION['update'] ?? null;
    unset($_SESSION['update']);
    // if(isset($_SESSION["update"])){
    //     $update = $_SESSION['update'];
    //     unset($_SESSION['update']);
    // }
    

    mysqli_free_result($result);
    mysqli_close($conn);  
}
?>

<html>
    <body>
        <div class="flex justify-center bg-yellow-50">
        <div class="container block text-center p-8 mb-auto min-h-screen">
            <?php

            
            
            if(!empty($row)){
            ?>
                <h2 class="text-center pb-4 font-bold"> Details</h2>
                <table class="table-auto mx-auto w-3/4 border border-gray-300 bg-blue-100">
                    <?php if($update){ echo "<div class=' w-3/4 bg-green-500 text-white mx-auto text-center mb-3 font-bold text-2xl py-2'> Data Updated! <div> "; } ?>
                    <tr>
                        <td class="w-1/4 shadow px-4 py-2 border border-gray-300"> Name: </td>
                        <td class="w-3/4  shadow px-4 py-2 border border-gray-300"> 
                            <?php echo "$row[title]"; ?> 
                        </td>
                    </tr>

                    <tr>
                    <td class="w-1/4 shadow px-4 py-2 border border-gray-300"> Ingredients: </td>
                        <td class="w-3/4  shadow px-4 py-2 border border-gray-300"> 
                            <?php echo "$row[Ingredients]"; ?> 
                        </td>
                    </tr>

                    <tr>
                    <td class="w-1/4 shadow px-4 py-2 border border-gray-300"> Created By: </td>
                        <td class="w-3/4  shadow px-4 py-2 border border-gray-300"> 
                            <?php echo "$row[email]"; ?> 
                        </td>
                    </tr>

                    <tr>
                    <td class="w-1/4 shadow px-4 py-2 border border-gray-300"> Created at: </td>
                        <td class="w-3/4  shadow px-4 py-2 border border-gray-300"> 
                            <?php echo "$row[created_at]"; ?> 
                        </td>
                    </tr>

                </table>
                    
                    <div class="flex flex-row gap-4 justify-center">

                        <form action="edit.php" method="POST">
                            <input type="hidden" name="to_edit" value="<?php echo htmlspecialchars(serialize( $row)); ?>">
                            <input type="submit" name="edit" value="Edit" 
                                class="bg-blue-500 text-white font-bold my-4 py-2 px-6 rounded hover:bg-blue-700">
                        </form>

                        <form action="details.php" method="POST">
                                <input type="hidden" name="to_delete" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="delete" value="Delete" 
                                    class="bg-blue-500 text-white font-bold my-4 py-2 px-4 rounded hover:bg-blue-700">
                        </form>
                    </div>
                

                
            <?php } else{
                echo"No data found";
            } ?>
        </div>
        </div>
    </body>
</html>




<?php
include("footer.php");
?>

