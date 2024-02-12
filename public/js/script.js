// public/js/popup.js
document.addEventListener('DOMContentLoaded', function() {
    const learnMoreLinks = document.querySelectorAll('.learn-more-trigger');
    const closePopupLinks = document.querySelectorAll('.close-popup');
    const popups = document.querySelectorAll('.popup');

    learnMoreLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const popupId = this.getAttribute('href');
            const popup = document.querySelector(popupId);
            popup.style.display = 'block';
        });
    });

    closePopupLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const popup = this.closest('.popup');
            popup.style.display = 'none';
        });
    });
});
