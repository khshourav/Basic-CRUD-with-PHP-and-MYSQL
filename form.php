<?php 
include("header.php");
include("./config/db_connect.php");

// Initialize error array
$error = ['mail' => '', 'title' => '', 'ingredients' => ''];
$email = $title = $ingredients = '';

// Form submission logic
if (isset($_POST['submit'])) {
    if (empty($_POST["email"])) {
        $error['mail'] = "Email Missing <br>";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['mail'] = "Invalid email format <br>";
    } else {
        $email = htmlspecialchars($_POST['email']);
    }

    if (empty($_POST["title"])) {
        $error['title'] = "Title Missing <br>";
    } else {
        $title = htmlspecialchars($_POST['title']);
    }

    if (empty($_POST["ingredients"])) {
        $error['ingredients'] = "Ingredients Missing <br>";
    } else {
        $ingredients = htmlspecialchars($_POST['ingredients']);
    }

    if (!array_filter($error)) {
        
        $title = mysqli_real_escape_string($conn, $title);
        $ingredients = mysqli_real_escape_string($conn, $ingredients);
        $email = mysqli_real_escape_string($conn, $email);

        // Query
        $sql = "INSERT INTO food_data (title, ingredients, email) VALUES ('$title', '$ingredients', '$email')";
        

        if (mysqli_query($conn, $sql)) {
           
                header('Location: food.php');
                exit;
            } else {
                echo "<div class='text-red-500 bg-gray-100 p-4 rounded-md'>SQL Error: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='text-red-500 bg-gray-100 p-4 rounded-md'>SQL Prepare Error: " . mysqli_error($conn) . "</div>";
        }
    
}

?>

<div class="flex justify-center min-h-screen bg-yellow-100">
    <div class="container mx-auto px-4 py-6 text-center">
        <h1 class="text-2xl mb-4">Add Pizza</h1>
        <form class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 space-y-4 border border-gray-200 bg-blue-100" 
              action="" method="POST">
            
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="title">Food Title</label>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-red-500 text-sm"><?php echo $error['title']; ?></p>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="ingredients">Ingredients</label>
                <input type="text" id="ingredients" name="ingredients" value="<?php echo $ingredients; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-red-500 text-sm"><?php echo $error['ingredients']; ?></p>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="email">Your Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-red-500 text-sm"><?php echo $error['mail']; ?></p>
            </div>
            <div>
                <input type="submit" name="submit" value="Submit"
                    class="w-full bg-blue-500 text-white font-medium py-2 rounded-md hover:bg-blue-600 transition">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>
