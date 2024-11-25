<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="countries.ico" type="image/png">
  <title>PHP - MYSQL CRUD Operation </title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

  <!-- Sticky Navbar -->
  <nav class="bg-blue-500 p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <a href="index.php" class="text-white font-bold text-xl">C R U D</a>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-6 font-bold text-xl">
        <a href="index.php" class="text-white hover:text-gray-300">Home</a>
        <a href="form.php" class="text-white hover:text-gray-300">Add Food</a>
        <a href="food.php" class="text-white hover:text-gray-300">Foods</a>
        <a href="deleted.php" class="text-white hover:text-gray-300">Deleted</a>
      </div>

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="text-white md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="menu" class="hidden md:hidden">
      <a href="index.php" class="block text-white py-2 px-4 hover:bg-blue-700">Home</a>
      <a href="form.php" class="block text-white py-2 px-4 hover:bg-blue-700">Add Food</a>
      <a href="food.php" class="block text-white py-2 px-4 hover:bg-blue-700">Foods</a>
      <a href="deleted.php" class="block text-white py-2 px-4 hover:bg-blue-700">Deleted</a>
    </div>
  </nav>

  <script>
    // JavaScript to toggle the mobile menu
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    menuBtn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>

</body>
</html>
