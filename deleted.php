<?php 
include("header.php");
include("./config/db_connect.php");

//restore queries
if(isset($_POST['restore'])){
    $id = mysqli_real_escape_string($conn, $_POST['to_restore']);
    $sql = "SELECT * from deleted_data WHERE id= $id";
    $result1 = mysqli_query($conn, $sql);
    $row1 =mysqli_fetch_assoc($result1);

    $sql2 = "INSERT into food_data(title,ingredients,email)
                VALUES( '$row1[title]', '$row1[Ingredients]', '$row1[email]' ) ";
    
    if(mysqli_query($conn, $sql2)){
        $sql3 = "DELETE from deleted_data WHERE id = $id";
        if(mysqli_query($conn, $sql3)){
            echo"<p class='text-center mt-6 text-green-800 font-italic text-xl'>Restore Success!</p>";
        }
        
    }
    else{ echo "Query Error"; }

}

//deleted_data table query
$sql= "SELECT * from deleted_data";
$result = mysqli_query($conn, $sql);
// $res_q = mysqli_fetch_assoc($result);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html>
<body class="">
    <div class="min-h-screen bg-blue-100">
        <div class="container mx-auto p-4">
            
            <div class="overflow-x-auto flex lg:justify-center sm:justify-start">
                <?php if ($res) { ?>
                    <table class="table-auto border border-solid m-8 sm:m-4 w-4/3 max-w-full">
                        <thead>
                            <tr class="border border-black bg-gray-200 text-sm sm:text-base">
                                <th class="border border-black px-4 py-2 text-center">ID</th>
                                <th class="border border-black px-4 py-2">Title</th>
                                <th class="border border-black px-4 py-2">Ingredients</th>
                                <th class="border border-black px-4 py-2">Email</th>
                                <th class="border border-black px-4 py-2 text-center">Created At</th>
                                <th class="border border-black px-4 py-2 text-center">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($res as $row) { ?>
                                <tr class="border border-black bg-white hover:bg-blue-50">
                                    <td class="border border-black px-4 py-2 text-sm text-center whitespace-nowrap">
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td class="border border-black px-4 py-2 text-sm truncate">
                                        <?php echo $row['title']; ?>
                                    </td>
                                    <td class="border border-black px-4 py-2 text-sm truncate">
                                        <?php echo $row['Ingredients']; ?>
                                    </td>
                                    <td class="border border-black px-4 py-2 text-sm truncate">
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td class="border border-black px-4 py-2 text-sm text-center whitespace-nowrap">
                                        <?php echo $row['created_at']; ?>
                                    </td>
                                    <td class="border border-black px-4 py-2 text-sm text-center">
                                        <form action="deleted.php" method="POST">
                                            <input type="hidden" name="to_restore" value="<?php echo $row['id']; ?>">
                                            <input type="submit" name="restore" value="Restore" 
                                                class="bg-blue-500 text-white font-bold my-1 py-1 px-2 rounded cursor-pointer hover:bg-blue-700">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="p-6 m-6 text-center text-2xl font-bold">
                        No Deleted Data Found
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>





</html>


<?php
include("footer.php");
?>