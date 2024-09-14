import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var marqueeContent = document.querySelector('.marquee-content');
    var originalContent = marqueeContent.innerHTML;
    marqueeContent.innerHTML += originalContent;
});
