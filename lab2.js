document.addEventListener('DOMContentLoaded', function () {
   
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop,
            behavior: 'smooth'
          });
        }
      });
    });

    function adjustContentPadding() {
              const navbarHeight = document.querySelector('.navbar').offsetHeight;
              document.querySelectorAll('.content').forEach(content => {
                  content.style.paddingTop = navbarHeight + 'px';
              });
          }

          // Initial adjustment
          adjustContentPadding();

          // Re-adjust on window resize
          window.addEventListener('resize', adjustContentPadding);
  });