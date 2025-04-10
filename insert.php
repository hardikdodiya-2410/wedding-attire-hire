<?php
function isInternetAvailable() {
    $connected = @fsockopen("www.google.com", 80); 
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Internet Check</title>
</head>
<body>

<?php if (!isInternetAvailable()): ?>
    <script>
        alert("Internet not available!");
        // Optional: redirect or hide content
        document.body.innerHTML = "<h2 style='color:red; text-align:center;'>Please check your internet connection.</h2>";
    </script>
<?php else: ?>
    <h1>Welcome! Internet is working ✅</h1>
    <!-- You can load other content here -->
<?php endif; ?>

</body>
</html>
