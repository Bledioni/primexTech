function CategoriesScrollLeft() {
      const container = document.getElementById("categories-container");
      container.scrollBy({ left: -300, behavior: "smooth" });
    }
    function CategoriesScrollRight() {
      const container = document.getElementById("categories-container");
      container.scrollBy({ left: 300, behavior: "smooth" });
    }