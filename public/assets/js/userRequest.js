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

    $('#review-submit').on('click', function (e) {
        e.preventDefault();

        const livesInUS = $('input[name="lives_in_US"]:checked').val();
        let mailing_address = '';
        
        if (livesInUS === 'Yes') {
            mailing_address = $('#us_mailing_address').val();
        } else {
            mailing_address = $('#intl_mailing_address').val();
        }

        if (!$('#email').val() || !$('#design').val() || !$('#shoe_size').val() || !$('#name').val() || !livesInUS || !mailing_address || !$('input[name="form_of_contact"]:checked').val() || ($('#insta-handle-container').is(':visible') && !$('#insta_handle').val()) || !$('input[name="payment_method"]:checked').val()) {
            alert("Please fill out all required fields.");
            return;
        }

        const formData = {
            email: $('#email').val(),
            design: $('#design').val(),
            shoe_size: $('#shoe_size').val(),
            name: $('#name').val(),
            lives_in_US: livesInUS,
            mailing_address: mailing_address,
            form_of_contact: $('input[name="form_of_contact"]:checked').val(),
            insta_handle: $('#insta_handle').val(),
            payment_method: $('input[name="payment_method"]:checked').val(),
        };

        $.ajax({
            url: '/api/requests',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function (response) {
                console.log("Server Response:", response);
		if (response.success && response.id) {
                    window.location.href = `/requests/${response.id}/review`;
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            error: function (xhr, status, error) {
                alert('Submission failed. Check your input and try again.');
            }
        });
    });
});

