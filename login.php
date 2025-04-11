<?php
global $conn;
include_once('./header.php');

// Import db connection
require_once("./connection.php");

// Start Session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    // Sanitize and validate input
    $emailUser = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    $passwordUser = $_POST['passwordUser']; // Password will be verified, no need to sanitize

    if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
        header('Location: login.php?msg=danger');
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT id, username, email, password FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        // Handle SQL error
        error_log("SQL prepare error: " . mysqli_error($conn));
        header('Location: login.php?msg=danger');
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $emailUser);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($passwordUser, $row['password'])) {
            // Successful login
            $_SESSION['user'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email']
            ];
            header('Location: home.php');
            exit();
        }
    }

    // If we get here, login failed
    header('Location: login.php?msg=danger');
    exit();
}
?>

    <div class="container" style="max-width: 600px;">
        <?php if (isset($_GET['msg'])) : ?>
            <div class="notification is-<?php echo htmlspecialchars($_GET['msg']) ?>">
                <button class="delete"></button>
                <?php if ($_GET['msg'] === 'success') : ?>
                    <p>Your registration is successful</p>
                <?php elseif ($_GET['msg'] === 'danger') : ?>
                    <p>Your email or password is invalid</p>
                <?php endif ?>
            </div>
        <?php endif ?>

        <section class="section is-small">
            <h4 class="title">Login</h4>
            <form method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" name="emailUser" type="email" placeholder="Your Email" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" name="passwordUser" type="password" placeholder="Password" minlength="8" required>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-link" name="btnLogin" type="submit">Login</button>
                </div>
            </form>
        </section>
    </div>

<?php include_once('./footer.php'); ?>