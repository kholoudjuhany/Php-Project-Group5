
<script src="http://localhost/php-project/php-project/navbar/navbarScript.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- swiper script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- swiper script -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- swiper -->
<script>
  const swiper = new Swiper('.mySwiper', {
    navigation: true,
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 50,
      },
    },
  });
</script>

<!-- zaid -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const buttons = document.querySelectorAll(".card-item-btn");

  buttons.forEach(button => {
    button.addEventListener("click", function() {
      const description = this.nextElementSibling;
      const plusIcon = this.querySelector(".plus-icon");
      const minusIcon = this.querySelector(".minus-icon");

      description.classList.toggle("open");

      if (description.classList.contains("open")) {
        description.style.maxHeight = description.scrollHeight + "px";
        plusIcon.style.display = "none";
        minusIcon.style.display = "block";
      } else {
        description.style.maxHeight = 0;
        plusIcon.style.display = "block";
        minusIcon.style.display = "none";
      }
    });
  });
});

</script>

<!-- zaid cart start-->\
<script>
 document.querySelectorAll('.toggle-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelector('.cart-sidebar').style.transform = 'translateX(0)'; 
    });
});

document.querySelector('.close-btn').addEventListener('click', function() {
    document.querySelector('.cart-sidebar').style.transform = 'translateX(100%)';
});

document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', function() {
        let input = this.nextElementSibling;
        if (input.value > 1) {
            input.value--;
        }
    });
});

document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', function() {
        let input = this.previousElementSibling;
        input.value++;
    });
});

// Zaid's (start edt)
document.querySelector('.continue-shopping-btn').addEventListener('click', function() {
    document.querySelector('.cart-sidebar').style.transform = 'translateX(100%)';
});

function showMessage(message) {
    const messageDiv = document.getElementById('message-container-cart');
    messageDiv.textContent = message;
    messageDiv.style.display = 'block';

    setTimeout(() => {
        messageDiv.style.display = 'none';
    }, 3000);
}

document.querySelectorAll('#Trash_Single').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.cart-item').remove();
        showMessage('Item removed from cart.');
    });
});

document.querySelector('.Trash_main img').addEventListener('click', function() {
    document.querySelectorAll('.cart-item').forEach(item => {
        item.remove();
        showMessage('All items removed from cart.');
    });
});

// Uncomment and update this function as needed
// function updateEmptyCartMessage() {
//     const cartItems = document.querySelectorAll('.cart-item');
//     const messageDiv = document.getElementById('message-container-cart');
//     if (cartItems.length === 0) {
//         messageDiv.textContent = 'Your cart is empty';
//         messageDiv.style.display = 'block';
//     }
// }


</script>
<!-- zaid cart end -->
</body>
</html>