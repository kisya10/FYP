<!-- register.php -->

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $eth_address = htmlspecialchars($_POST['eth_address']);

    $stmt = $conn->prepare("INSERT INTO users (username, email, eth_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $eth_address);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>
    <script>
        async function connectWallet() {
            if (window.ethereum) {
                try {
                    await window.ethereum.request({ method: 'eth_requestAccounts' });
                    const accounts = await web3.eth.getAccounts();
                    document.getElementById('eth_address').value = accounts[0];
                } catch (error) {
                    console.error(error);
                    alert('MetaMask authentication failed');
                }
            } else {
                alert('MetaMask is not installed');
            }
        }
    </script>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" id="eth_address" name="eth_address" placeholder="Ethereum Address" readonly required><br><br>
        <button type="button" onclick="connectWallet()">Connect Wallet</button><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
