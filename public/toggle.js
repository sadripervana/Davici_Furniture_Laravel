let toggle = document.querySelector("#header .toggle-button");
    let collapse = document.querySelectorAll("#header .collapse1");

    toggle.addEventListener('click' , function(){
        collapse.forEach(col => col.classList.toggle("collapse1-toggle"));
    })

    function toggleSearchForm() {
    var searchContainer = document.getElementById('search-container');
    searchContainer.classList.toggle('expanded');
  }


  // Slick
  $('.slider').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 270,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
  $('.slider2').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 270,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

// Get references to the elements in the HTML
const numberDisplay = document.getElementById('numberDisplay');
const incrementButton = document.getElementById('incrementButton');
const decrementButton = document.getElementById('decrementButton');

// Initialize the counter variable
let counter = 1; // Set the minimum value to 1

// Function to update the display
function updateDisplay() {
  numberDisplay.textContent = counter;
}

// Add a click event listener to the increment button
incrementButton.addEventListener('click', () => {
  // Increment the counter by 1
  counter++;

  // Update the display
  updateDisplay();
});

// Add a click event listener to the decrement button
decrementButton.addEventListener('click', () => {
  // Decrement the counter by 1 only if it's greater than 1
  if (counter > 1) {
    counter--;
  }

  // Update the display
  updateDisplay();
});

