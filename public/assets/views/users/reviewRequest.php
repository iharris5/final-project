<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Your Request</title>
    <link rel="stylesheet" href="/assets/styles/homepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/styles/review.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Review Your Custom Order</h1>
        <p><strong>Email:</strong> <?= htmlspecialchars($requestData['email']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($requestData['name']) ?></p>
        <p><strong>Shoe Size:</strong> <?= htmlspecialchars($requestData['shoe_size']) ?></p>
        <p><strong>Design:</strong> <?= htmlspecialchars($requestData['design']) ?></p>
        <p><strong>Lives in US:</strong> <?= htmlspecialchars($requestData['lives_in_US']) ?></p>
        <p><strong>Mailing Address:</strong> <?= htmlspecialchars($requestData['mailing_address']) ?></p>
        <p><strong>Contact Method:</strong> <?= htmlspecialchars($requestData['form_of_contact']) ?></p>
        <?php if ($requestData['form_of_contact'] === 'Instagram'): ?>
            <p><strong>Instagram Handle:</strong> <?= htmlspecialchars($requestData['insta_handle']) ?></p>
        <?php endif; ?>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($requestData['payment_method']) ?></p>

	<div class="btn-wrapper">
        	<button id="cancel-btn">Cancel</button>
        	<button id="final-submit-btn">Submit</button>
	</div>
    </div>
	<script>
	document.getElementById('cancel-btn').addEventListener('click', function () {
		if (confirm('Are you sure you want to cancel and go back to the form?')) {
            		fetch('/api/requests/<?= $requestData['id'] ?>', {
                	method: 'DELETE',
            	})
            		.then(response => response.json())
            		.then(data => {
                		alert('Your request was cancelled.');
                		window.location.href = '/api/request'; 
            		})
            		.catch(error => {
                		console.error('Error cancelling:', error);
                		alert('Cancellation failed. Please try again.');
            		});
        	}
    	});
        document.getElementById('final-submit-btn').addEventListener('click', function () {
            window.location.href = '/thank-you';
        })
    </script>
</body>
</html>

