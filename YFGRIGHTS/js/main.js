(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.nav-bar').addClass('sticky-top shadow-sm').css('top', '0px');
        } else {
            $('.nav-bar').removeClass('sticky-top shadow-sm').css('top', '-100px');
        }
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        animateOut: 'fadeOut',
        items: 1,
        margin: 0,
        stagePadding: 0,
        autoplay: true,
        smartSpeed: 500,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
    });



    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="fa fa-arrow-right"></i>',
            '<i class="fa fa-arrow-left"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 5,
        time: 2000
    });


   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


})(jQuery);

//expanding cards js codes
document.querySelectorAll('.expand-btn').forEach(function(button) {
      button.addEventListener('click', function() {
        const featureItem = this.closest('.feature-item');
        const paragraphShort = featureItem.querySelector('.paragraph-content');
        const paragraphFull = featureItem.querySelector('.full-paragraph');

        // Toggle between short and full content
        if (paragraphFull.style.display === 'none') {
            paragraphFull.style.display = 'block';
            paragraphShort.style.display = 'none';  // Hide the short content
            this.textContent = 'Show Less';         // Change button text
        } else {
            paragraphFull.style.display = 'none';
            paragraphShort.style.display = 'block';  // Show the short content again
            this.textContent = 'Learn More';         // Reset button text
        }
    });
  });

document.querySelectorAll('.expand-btn').forEach(function(button) {
       button.addEventListener('click', function() {
           const featureItem = this.closest('.feature-item');
           const shortContent = featureItem.querySelector('.short-content');
           const fullContent = featureItem.querySelector('.full-content');

           // Toggle between short and full content
           if (fullContent.style.display === 'none') {
               fullContent.style.display = 'block';
               shortContent.style.display = 'none';  // Hide short content
               this.textContent = 'Show Less';       // Change button text
           } else {
               fullContent.style.display = 'none';
               shortContent.style.display = 'block'; // Show short content again
               this.textContent = 'Learn More';      // Reset button text
           }
       });
   });

   document.querySelectorAll('.expand-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const featureItem = this.closest('.feature-item');
            const shortText = featureItem.querySelector('.short-text');
            const fullText = featureItem.querySelector('.full-text');

            // Toggle between short and full content
            if (fullText.style.display === 'none') {
                fullText.style.display = 'block';
                shortText.style.display = 'none';  // Hide short content
                this.textContent = 'Show Less';       // Change button text
            } else {
                fullText.style.display = 'none';
                shortText.style.display = 'block'; // Show short content again
                this.textContent = 'Learn More';      // Reset button text
            }
        });
    });

    document.querySelectorAll('.expand-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const featureItem = this.closest('.feature-item');
            const shortContent = featureItem.querySelector('.short-display');
            const fullContent = featureItem.querySelector('.full-display');

            // Toggle between short and full content
            if (fullContent.style.display === 'none') {
                fullContent.style.display = 'block';
                shortContent.style.display = 'none';  // Hide short content
                this.textContent = 'Show Less';       // Change button text
            } else {
                fullContent.style.display = 'none';
                shortContent.style.display = 'block'; // Show short content again
                this.textContent = 'Learn More';      // Reset button text
            }
        });
    });

    document.querySelectorAll('.expand-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const featureItem = this.closest('.feature-item');
            const shortContent = featureItem.querySelector('.short-data');
            const fullContent = featureItem.querySelector('.full-data');

            // Toggle between short and full content
            if (fullContent.style.display === 'none') {
                fullContent.style.display = 'block';
                shortContent.style.display = 'none';  // Hide short content
                this.textContent = 'Show Less';       // Change button text
            } else {
                fullContent.style.display = 'none';
                shortContent.style.display = 'block'; // Show short content again
                this.textContent = 'Learn More';      // Reset button text
            }
        });
    });


    document.querySelectorAll('.expand-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const aboutItem = this.closest('.about-item-content');
            const shortAbout = aboutItem.querySelector('.short-about');
            const fullAbout = aboutItem.querySelector('.full-about');

            // Toggle between short and full content
            if (fullAbout.style.display === 'none') {
                fullAbout.style.display = 'block';
                shortAbout.style.display = 'none';  // Hide short content
                this.textContent = 'Show Less';       // Change button text
            } else {
                fullAbout.style.display = 'none';
                shortAbout.style.display = 'block'; // Show short content again
                this.textContent = 'Read More';       // Reset button text
            }
        });
    });

// gallery scripts
document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            // Toggle active class on buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Show/hide items based on the selected filter
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
