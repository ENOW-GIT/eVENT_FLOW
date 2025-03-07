document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent form submission

    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var errorMessage = document.getElementById('error-message');

    // Regular expression for basic email validation
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        errorMessage.textContent = "Please enter a valid email address!";
    } else if (password !== confirmPassword) {
        errorMessage.textContent = "Passwords do not match!";
    } else {
        errorMessage.textContent = "";
        // Handle form submission
        console.log('Form submitted successfully!');
        alert('Form submitted successfully!');
        // Redirect to site.html
        location.href = 'index.html';
    }
});
