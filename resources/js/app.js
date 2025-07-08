import './bootstrap';

// Automatically scroll marked divs to bottom
document.addEventListener('DOMContentLoaded', () => {
    const scrollDivs = document.querySelectorAll("[data-scroll-to-bottom]");

    scrollDivs.forEach((div) => {
        div.scrollTop = div.scrollHeight;
    });
});
