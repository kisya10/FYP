<!-- login.php -->

<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $eth_address = $_POST['eth_address'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND eth_address = ?");
    $stmt->bind_param("ss", $username, $eth_address);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();

    if ($id) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['eth_address'] = $eth_address;
        header("Location: schedule.php");
    } else {
        echo "Invalid credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="text" id="eth_address" name="eth_address" placeholder="Ethereum Address" readonly required><br><br>
        <button type="button" onclick="connectWallet()">Connect Wallet</button><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
