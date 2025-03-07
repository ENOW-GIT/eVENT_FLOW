// JavaScript function to validate the form
function validateForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var errorMessage = document.getElementById('error-message');
    
    // Clear previous error message
    errorMessage.textContent = '';

    // Check if email is valid
    if (!validateEmail(email)) {
        errorMessage.textContent = 'Invalid email address';
        return false;
    }

    // Check if password meets criteria (for example, minimum 6 characters)
    if (password.length < 6) {
        errorMessage.textContent = 'Password must be at least 6 characters long';
        return false;
    }

    // If everything is correct, redirect to the site
    window.location.href = 'index.html';
    return false;
}

// Function to validate email format
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
