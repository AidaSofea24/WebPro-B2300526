document.getElementById('mentalHealthForm').addEventListener('submit', function(event) {
    let isValid = true;
    let errorMessage = "";

    // Check if all required text inputs are filled
    const requiredTextInputs = ['fullName', 'age', 'email', 'phone'];
    requiredTextInputs.forEach(function(id) {
        const input = document.getElementById(id);
        if (input.value.trim() === '') {
            errorMessage += `Please fill out the ${input.previousElementSibling.innerText}\n`;
            isValid = false;
        }
    });

    // Check if a gender is selected
    const gender = document.getElementById('gender');
    if (gender.value === '') {
        errorMessage += "Please select a gender.\n";
        isValid = false;
    }

    // Validate email format
    const email = document.getElementById('email').value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        errorMessage += "Please enter a valid email address.\n";
        isValid = false;
    }

    // Validate phone number format
    const phone = document.getElementById('phone').value;
    const phonePattern = /^\d{10}$/; // Simple pattern for 10 digit phone numbers
    if (!phonePattern.test(phone)) {
        errorMessage += "Please enter a valid phone number (10 digits).\n";
        isValid = false;
    }

    // Validate that all radio buttons for questionnaire are selected
    const questionCategories = ['sad', 'anxious', 'hopeless', 'enjoying', 'irritable', 'sleep', 'tired', 'concentrating', 'symptoms', 'appetite', 'withdrawn', 'conflicts', 'substances', 'overwhelmed', 'confident', 'rating'];
    questionCategories.forEach(function(category) {
        const options = document.getElementsByName(category);
        let isChecked = false;
        for (let option of options) {
            if (option.checked) {
                isChecked = true;
                break;
            }
        }
        if (!isChecked) {
            errorMessage += `Please rate: ${options[0].closest('fieldset').querySelector('legend').innerText.split('\n')[0]} - ${options[0].closest('label').innerText}\n`;
            isValid = false;
        }
    });

    // Validate treatment details if treatment is "Yes"
    const treatment = document.querySelector('input[name="treatment"]:checked');
    if (treatment && treatment.value === 'Yes') {
        const treatmentDetails = document.getElementById('treatmentDetails').value;
        if (treatmentDetails.trim() === '') {
            errorMessage += 'Please specify the type of treatment you are receiving.\n';
            isValid = false;
        }
    }

    if (!isValid) {
        alert(errorMessage);
        event.preventDefault();
    }

    
});
