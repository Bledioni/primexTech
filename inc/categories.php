<?php

  require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Category Scroll</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <link rel="stylesheet" href="../display/css/categories.css">
</head>
<body>

  <div id="categories">
    <div id="todays-header">
        <div id="todaysBox">
        
        </div>
        <div id="todays-text">
            Category
        </div>
    </div>

    <div class="scroll">
      <h3 style="text-align:center;">Browse By Category</h3>
    <div class="scroll-buttons">
      <button onclick="CategoriesScrollLeft()" aria-label="Scroll Left">
        <i class="fa-solid fa-arrow-left"></i>
      </button>
      <button onclick="CategoriesScrollRight()" aria-label="Scroll Right">
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>
    </div>

    <form action="../inc/productCategory.php" method="get">
      <div id="categories-container">
        <button type="submit" name="category" value="computer">
          <img
            src="../assets/photos/computersCategory.png"
            alt="Computers"
            class="categories-images"
          />
        </button>
        <button type="submit" name="category" value="gaming">
          <img
            src="../assets/photos/gamingCategories.png"
            alt="Gaming"
            class="categories-images"
          />
        </button>
        <button type="submit" name="category" value="camera">
          <img
            src="../assets/photos/cameraCategories.png"
            alt="Camera"
            class="categories-images"
          />
        </button>
        <button type="submit" name="category" value="headphones">
          <img
            src="../assets/photos/headphonesCategories.png"
            alt="HeadPhones"
            class="categories-images"
          />
        </button>
        <button type="submit" name="category" value="phones">
          <img
            src="../assets/photos/phonesCategory.png"
            alt="Phones"
            class="categories-images"
          />
        </button>
        <button type="submit" name="category" value="smartwatch">
          <img
            src="../assets/photos/smartwatchCategories.png"
            alt="SmartWatch"
            class="categories-images"
          />
        </button>
      </div>
    </form>
  </div>
</body>
</html>
<script src="../assets/js/categoriesSlider.js"></script>