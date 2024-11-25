<?php 
include("header.php");
include("./config/db_connect.php");

$error = ['title'=>'', 'ingredients'=>'', 'email'=>''];

if(isset($_POST["update"])){
    if((!empty($_POST["title"]))){
        $title = htmlspecialchars($_POST["title"]);
    } else{ $error['title'] = 'Please Enter a Valid title';}

    if((!empty($_POST["ingredients"]))){
        $ingredients = htmlspecialchars($_POST["ingredients"]);
    } else{ $error['ingredients'] = 'Please enter valid Ingredients.'; }

    if((!empty($_POST["email"]))){
        $email = htmlspecialchars($_POST["email"]);
    } else{ $error["email"] = "Please enter valid Email"; }

    if((!array_filter($error))){
        $id = $_POST["id"];
        $sql = "UPDATE food_data SET title = '$title', Ingredients = '$ingredients', email = '$email'
                WHERE id = '$id'";
        if( mysqli_query($conn, $sql)){

            session_start();
            $_SESSION["update"] = true;
            header("Location: details.php?id=$id");
            exit();
        }
    }
}

if(isset($_POST["to_edit"])){
    $row = unserialize ($_POST['to_edit']);
    // print_r ($row);
?>
<html>
    <body>
        <div class="flex justify-center text-center bg-yellow-100 min-h-screen">
            <div class="container flex justify-center">

                <form action="edit.php" method="POST" class="border shadow rounded block m-8 p-4 w-full max-w-md mb-auto bg-blue-100" id="form">
                    
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    
                    <label for="title" class="block text-left mb-2 font-bold"> Title:</label>
                    <p id="title"></p>
                    <p class="text-red-500 text-sm pb-2"></p>
                    <input type="text" name="title"  value="<?php echo $row['title']; ?>" 
                        class="block w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">

                    <label for="Ingredients" class="block text-left mb-2 font-bold"> Ingredients:</label>
                    <p id="ingredients" class="text-red-500 text-sm pb-2"></p>
                    <input type="text" name="ingredients"  value="<?php echo $row['Ingredients']; ?>" 
                        class="block w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                    
                    <label for="email" class="block text-left mb-2 font-bold"> Email:</label>
                    <p id="email" class="text-red-500 text-sm pb-2"></p>
                    <input type="email" name="email"  value="<?php echo $row['email']; ?>" 
                        class="block w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                    
                    <button type="submit" name="update" class="bg-blue-500 text-white font-bold  mt-4 py-2 px-4 rounded hover:bg-blue-700">Update</button>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
    document.getElementById('form').addEventListener("submit", ()=>{
        let title = document.getElementsByName("title")[0].value.trim();
        let ingredients =document.getElementsByName("ingredients")[0].value.trim();
        let email = document.getElementsByName("email")[0].value.trim();
        valid = true;
        if(title === ""){
            valid = false;
            document.getElementById('title').innerHTML = 'Please Enter Valid Title';
            
        }

        if(ingredients === ""){
            valid = false;
            document.getElementById('ingredients').innerHTML = 'Please Enter Valid Ingredients [comma separated]';
        }

        if(email === ""){
            valid = false;
            document.getElementById('email').innerHTML = 'Please Enter Valid email';
        }

        if(!valid){
            event.preventDefault();
        }
    });
</script>
    
<?php }
?>

<?php include("footer.php"); ?>