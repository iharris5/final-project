$(document).ready(function () {
    $('input[name="lives_in_US"]').on('change', function () {
        const value = $('input[name="lives_in_US"]:checked').val();
        if (value === 'Yes') {
            $('#us-shipping').show();
            $('#intl-shipping').hide();
        } else {
            $('#us-shipping').hide();
            $('#intl-shipping').show();
        }
    });

    $('input[name="form_of_contact"]').on('change', function () {
        const contact = $('input[name="form_of_contact"]:checked').val();
        $('#insta-handle-container').toggle(contact === 'Instagram');
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    $('#review-submit').on('click', function (e) {
        e.preventDefault();

        $('.is-invalid').removeClass('is-invalid');
        $('.error-message').hide();
        $('#error-container').empty();

        $('#review-submit').prop('disabled', true);

        const livesInUS = $('input[name="lives_in_US"]:checked').val();
        let mailing_address = '';

        if (livesInUS === 'Yes') {
            mailing_address = $('#us_mailing_address').val().trim();
        } else {
            mailing_address = $('#intl_mailing_address').val().trim();
        }

        const formData = {
            email: $('#email').val().trim(),
            design: $('#design').val().trim(),
            shoe_size: $('#shoe_size').val().trim(),
            name: $('#name').val().trim(),
            lives_in_US: livesInUS,
            mailing_address: mailing_address,
            form_of_contact: $('input[name="form_of_contact"]:checked').val(),
            insta_handle: $('#insta_handle').val().trim(),
            payment_method: $('input[name="payment_method"]:checked').val(),
        };

        const missingFields = [];
        let firstInvalidField = null; 

        if (!formData.email) {
            missingFields.push("Email");
            $('#email').addClass('is-invalid');
            $('#email-error').text("Please enter your email address").show();
            if (!firstInvalidField) firstInvalidField = '#email';
        } else if (!validateEmail(formData.email)) {
            missingFields.push("Email");
            $('#email').addClass('is-invalid');
            $('#email-error').text("Please enter a valid email address").show();
            if (!firstInvalidField) firstInvalidField = '#email';
        }

        if (!formData.design) {
            missingFields.push("Design");
            $('#design').addClass('is-invalid');
            $('#design-error').text("Please describe your design").show();
            if (!firstInvalidField) firstInvalidField = '#design';
        }

        if (!formData.shoe_size) {
            missingFields.push("Shoe Size");
            $('#shoe_size').addClass('is-invalid');
            $('#shoe_size-error').text("Please enter your shoe size").show();
            if (!firstInvalidField) firstInvalidField = '#shoe_size';
        }

        if (!formData.name) {
            missingFields.push("Full Name");
            $('#name').addClass('is-invalid');
            $('#name-error').text("Please enter your full name").show();
            if (!firstInvalidField) firstInvalidField = '#name';
        }

        if (!formData.lives_in_US) {
            missingFields.push("US Residency");
            $('input[name="lives_in_US"]').parent().addClass('is-invalid');
            $('#lives_in_us-error').text("Please select your residency status").show();
            if (!firstInvalidField) firstInvalidField = 'input[name="lives_in_US"]:first';
        }

        if (!formData.mailing_address) {
            missingFields.push("Mailing Address");
            const addressField = livesInUS === 'Yes' ? '#us_mailing_address' : '#intl_mailing_address';
            $(addressField).addClass('is-invalid');
            $(`${addressField}-error`).text("Please enter your mailing address").show();
            if (!firstInvalidField) firstInvalidField = addressField;
        }

        if (!formData.form_of_contact) {
            missingFields.push("Preferred Contact Method");
            $('input[name="form_of_contact"]').parent().addClass('is-invalid');
            $('#form_of_contact-error').text("Please select a preferred contact method").show();
            if (!firstInvalidField) firstInvalidField = 'input[name="form_of_contact"]:first';
        }

        if (formData.form_of_contact === 'Instagram' && !formData.insta_handle) {
            missingFields.push("Instagram Handle");
            $('#insta_handle').addClass('is-invalid');
            $('#insta_handle-error').text("Please enter your Instagram handle").show();
            if (!firstInvalidField) firstInvalidField = '#insta_handle';
        }

        if (!formData.payment_method) {
            missingFields.push("Payment Method");
            $('input[name="payment_method"]').parent().addClass('is-invalid');
            $('#payment_method-error').text("Please select a payment method").show();
            if (!firstInvalidField) firstInvalidField = 'input[name="payment_method"]:first';
        }

        if (missingFields.length > 0) {
            $('#error-container').html(`
                <div class="alert alert-danger mt-3">
                    <strong>Please complete the following fields:</strong>
                    <ul>${missingFields.map(field => `<li>${field}</li>`).join('')}</ul>
                </div>
            `);
            $('#review-submit').prop('disabled', false);

            if (firstInvalidField) {
                $('html, body').animate({
                    scrollTop: $(firstInvalidField).offset().top - 100
                }, 500);
            }

            return;
        }

        $.ajax({
            url: '/api/requests',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function (response) {
                console.log("Server Response:", response);
                if (response.success && response.id) {
                    window.location.href = `/thank-you`;
                } else {
                    alert('Something went wrong. Please try again.');
                    $('#review-submit').prop('disabled', false);
                }
            },
            error: function () {
                alert('Submission failed. Check your input and try again.');
                $('#review-submit').prop('disabled', false);
            }
        });
    });
});

