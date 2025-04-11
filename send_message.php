<?php global $conn;
include_once('./header.php'); ?>

<?php
require_once("./connection.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$stmt = $conn->prepare("SELECT * FROM messages WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$messages = $stmt->get_result();
?>

    <div class="container" style="max-width: 800px;">
        <section class="section">
            <h4 class="title">Berichten Systeem</h4>

            <?php if (isset($_GET['msg'])) : ?>
                <div class="notification is-<?php echo htmlspecialchars($_GET['msg']) ?>">
                    <button class="delete"></button>
                    <?php if ($_GET['msg'] === 'success') : ?>
                        <p>Bericht succesvol verzonden!</p>
                    <?php elseif ($_GET['msg'] === 'error') : ?>
                        <p>Fout bij het verzenden van bericht</p>
                    <?php elseif ($_GET['msg'] === 'empty') : ?>
                        <p>Voer een bericht in alstublieft</p>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <div class="box">
                <h5 class="subtitle">Nieuw Bericht</h5>
                <form method="post" action="process_message.php">
                    <div class="field">
                        <label class="label">Uw Bericht</label>
                        <div class="control">
                            <textarea class="textarea" name="message" placeholder="Typ hier uw bericht..." required></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button type="submit" name="btnSendMessage" class="button is-primary">Verstuur Bericht</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box">
                <h5 class="subtitle">Vorige Berichten</h5>
                <?php if ($messages->num_rows > 0) : ?>
                    <div class="content">
                        <?php while ($message = $messages->fetch_assoc()) : ?>
                            <div class="message-box">
                                <p><?php echo htmlspecialchars($message['message']); ?></p>
                                <small>Verzonden op: <?php echo $message['created_at']; ?></small>
                                <hr>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p>Nog geen berichten beschikbaar</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

<?php include_once('./footer.php'); ?>