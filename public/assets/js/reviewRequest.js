$(document).ready(function () {
    const requestData = JSON.parse(localStorage.getItem("customRequestData"));

    if (!requestData) {
        console.log("No data found in localStorage. Redirecting to form...");
        alert("No data found. Redirecting back to form...");
        window.location.href = "/api/request"; 
        return;
    }

    // Log the request data for debugging
    console.log("Request Data:", requestData);

    // Fill in the review summary with the request data
    const $summary = $("#review-summary");
    $summary.html(`
        <li><strong>Name:</strong> ${requestData.name}</li>
        <li><strong>Email:</strong> ${requestData.email}</li>
        <li><strong>Shoe Size:</strong> ${requestData.shoe_size}</li>
        <li><strong>Design:</strong> ${requestData.design}</li>
        <li><strong>Lives in US:</strong> ${requestData.lives_in_US}</li>
        <li><strong>Mailing Address:</strong> ${requestData.mailing_address}</li>
        <li><strong>Form of Contact:</strong> ${requestData.form_of_contact}</li>
        ${requestData.insta_handle ? `<li><strong>Instagram:</strong> ${requestData.insta_handle}</li>` : ""}
        <li><strong>Payment Method:</strong> ${requestData.payment_method}</li>
    `);

    $("#edit-btn").click(function () {
        window.location.href = "/api/request"; 
    });

    $("#final-submit-btn").click(function () {
        $.ajax({
            url: `/api/requests/${requestData.id}`,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({ confirmed: true }),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert("Your request has been submitted!");
                    localStorage.removeItem("customRequestData"); 
                    window.location.href = "/"; 
                } else {
                    alert("Submission error: " + response.error);
                }
            },
            error: function () {
                alert("Something went wrong. Please try again.");
            }
        });
    });
});

