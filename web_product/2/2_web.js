// Select all elements with the "fade-in" class
const fadeElements = document.querySelectorAll('.fade-in');

// Configure the Intersection Observer
const observerOptions = {
  root: null,
  rootMargin: '0px',
  threshold: 0.5 // Adjust this threshold as needed
};

// Create a new Intersection Observer instance
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    // Check if element is intersecting (visible in the viewport)
    if (entry.isIntersecting) {
      // Add the "fade-in" class to the intersecting element
      entry.target.classList.add('fade-in');
      
      // Stop observing the element to avoid unnecessary repetitions
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Start observing each fade element
fadeElements.forEach(element => {
  observer.observe(element);
});
