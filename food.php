<?php 
include("header.php");
include("./config/db_connect.php");

$sql = "SELECT title, Ingredients, id FROM food_data ORDER BY id DESC;";
$sql_result = $conn->query($sql);

if (!$sql_result) {
    die("Query Error: " . $conn->error);
}

$food_data = mysqli_fetch_all($sql_result, MYSQLI_ASSOC);
mysqli_free_result($sql_result);
mysqli_close($conn);
?>

<div class="flex flex-wrap mx-auto  justify-center min-h-screen bg-yellow-50">
    <div class="container text-center px-4 py-6">
        <h1 class="text-2xl my-4"> Foods</h1>
        <ul class="gap-4 flex flex-row flex-wrap justify-center w-full">
            <?php if(!empty($food_data)){
                foreach($food_data as $row){ ?>
                    <li class =' flex flex-col rounded text-gray-700 pt-6 text-2xl border shadow bg-yellow-100 w-full sm:w-1/2 md:w-1/3 lg:w-1/4'> 
                        <?php echo htmlspecialchars("$row[title] "); ?> 
                        <ul class='pt-4 border-t p-2 m-2'>
                            <?php foreach(explode(',',$row['Ingredients']) as $ingre){ ?>
                                <li class="text-left pl-8 text-xl"> - <?php echo htmlspecialchars($ingre); ?> </li>
                            <?php } ?>
                        </ul>
                        <div class="border-t pt-4 m-4 mt-auto flex justify-center items-center text-sm font-bold hover:text-blue-500">
                            <a href="details.php?id=<?php echo $row['id']; ?>" target="_blank">Find Out More</a>
                        </div>
                    </li>
                    
           <?php } ?>
        </ul>
            <?php } else { ?>
                <p class="text-gray-700 my-4 text-center">No food data found.</p>
            <?php } ?>
    </div>

</div>

<?php include("footer.php"); ?>
