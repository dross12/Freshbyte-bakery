document.addEventListener("DOMContentLoaded", function() {

    // === 1. Mobile Menu Toggle ===
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('nav ul');

    if(menuToggle){
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }

    // === 2. Contact Form Validation ===
    const contactForm = document.querySelector('form[action="contact.php"]');
    if(contactForm){
        contactForm.addEventListener('submit', function(e){
            let errors = [];
            const name = contactForm.querySelector('#name').value.trim();
            const email = contactForm.querySelector('#email').value.trim();
            const message = contactForm.querySelector('#message').value.trim();

            if(name === '') errors.push("Name is required.");
            if(email === '' || !/^\S+@\S+\.\S+$/.test(email)) errors.push("Valid email is required.");
            if(message === '') errors.push("Message cannot be empty.");

            if(errors.length > 0){
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });
    }

    // === 3. Smooth Scroll for Internal Links ===
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e){
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target){
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // === 4. Fade-In Animation for Gallery Items ===
    const galleryItems = document.querySelectorAll('.gallery-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.1 });

    galleryItems.forEach(item => observer.observe(item));
});
