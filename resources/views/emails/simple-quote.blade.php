<!DOCTYPE html>
<html>
<head>
    <title>New Quote Request</title>
</head>
<body>
    <h2>New Quote Request Received</h2>
    
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    <p><strong>Message:</strong> {{ $message }}</p>
    
    @if($product_name)
    <p><strong>Product:</strong> {{ $product_name }}</p>
    @endif
    
    <p><em>Sent from PrintHelp website</em></p>
</body>
</html>