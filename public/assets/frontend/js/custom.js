/* <![CDATA[ */

jQuery(document).ready(function() {
    jQuery(".offer_slider").slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    
    jQuery(".hero_slider").slick({
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 50000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
    
    jQuery(".new_arrival_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    jQuery(".best_seller_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
    
    
    jQuery(".testimonial_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    dots: true,
                    autoplaySpeed: 8000,
                }
            }
        ]
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Change tab on hover instead of click
    document.querySelectorAll('#pills-tab [data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('mouseenter', function () {
        let tabTrigger = new bootstrap.Tab(this);
        tabTrigger.show();
        });
    });

    

    $(".search-trigger").click(function() {
        $('#searchbar').addClass("active");
    });
    $("#closeSearch").click(function() {
        $('#searchbar').removeClass("active");
    });

    document.getElementById("shipAddress").addEventListener("change", function() {
        const collapseElement = document.getElementById("shipping_fields");
        const collapse = new bootstrap.Collapse(collapseElement, {
            toggle: false // prevent auto toggle on init
        });

        if (this.checked) {
            collapse.show();
        } else {
            collapse.hide();
        }
    });
});



/* ]]&gt; */


// single product page js code
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
  direction: "vertical",

  // ✅ Responsive breakpoints
  breakpoints: {
    0: {
      direction: "horizontal", // 992px se niche
      slidesPerView: 4
    },
    992: {
      direction: "vertical",   // 992px se upar
      slidesPerView: 4
    }
  }
});

var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});



// zoom effect 
// $("#zoomImage").ezPlus();




// Clear localStorage on frontend logout
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged out using data attribute
    const isAuthenticated = document.documentElement.getAttribute('data-is-authenticated') === 'true';
    
    if (!isAuthenticated) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        localStorage.removeItem('token_expires_at');
    }
    
    // Add logout confirmation
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                // Clear localStorage
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('token_expires_at');
                // Submit the form
                this.submit();
            }
        });
    });
});

