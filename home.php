<?php
global $conn;
include_once('./header.php');
session_start();
include_once('./connection.php');
?>
    <!-- Voeg CSS-bestand toe -->
    <link rel="stylesheet" href="./style.css">

    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body">
            <div class="container">
                <?php if (isset($_SESSION['user'])) : ?>
                    <!-- Profiel sectie -->
                    <div class="user-profile">
                        <figure class="image">
                            <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['user']['email']))); ?>?s=128&d=identicon" alt="Profiel afbeelding">
                        </figure>
                        <div class="profile-info">
                            <h1 class="title is-3"><?php echo htmlspecialchars($_SESSION['user']['username']); ?></h1>
                            <p class="subtitle is-6 has-text-grey">
                            <span class="icon is-small">
                                <i class="fas fa-envelope"></i>
                            </span>
                                <?php echo htmlspecialchars($_SESSION['user']['email']); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Volgers statistieken -->
                    <div class="stats-container">
                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) FROM followers WHERE followed_id = ?");
                        $stmt->bind_param("i", $_SESSION['user']['id']);
                        $stmt->execute();
                        $followersCount = $stmt->get_result()->fetch_row()[0];

                        $stmt = $conn->prepare("SELECT COUNT(*) FROM followers WHERE follower_id = ?");
                        $stmt->bind_param("i", $_SESSION['user']['id']);
                        $stmt->execute();
                        $followingCount = $stmt->get_result()->fetch_row()[0];
                        ?>
                        <div class="stat-box">
                            <p class="stat-number"><?php echo $followersCount; ?></p>
                            <p class="is-size-6">Volgers</p>
                        </div>
                        <div class="stat-box">
                            <p class="stat-number"><?php echo $followingCount; ?></p>
                            <p class="is-size-6">Volgend</p>
                        </div>
                    </div>

                    <!-- Gebruikers suggesties -->
                    <div class="box">
                        <h2 class="title is-5 has-text-centered">Ontdek nieuwe mensen</h2>
                        <div class="suggestions-grid">
                            <?php
                            $stmt = $conn->prepare("
                            SELECT u.id, u.username 
                            FROM users u
                            WHERE u.id != ? 
                            AND u.id NOT IN (
                                SELECT followed_id FROM followers WHERE follower_id = ?
                            )
                            ORDER BY RAND() LIMIT 5
                        ");
                            $stmt->bind_param("ii", $_SESSION['user']['id'], $_SESSION['user']['id']);
                            $stmt->execute();
                            $suggestions = $stmt->get_result();

                            if ($suggestions->num_rows > 0) {
                                while ($user = $suggestions->fetch_assoc()) {
                                    $stmt = $conn->prepare("SELECT id FROM followers WHERE follower_id = ? AND followed_id = ?");
                                    $stmt->bind_param("ii", $_SESSION['user']['id'], $user['id']);
                                    $stmt->execute();
                                    $isFollowing = $stmt->get_result()->num_rows > 0;
                                    ?>
                                    <div class="suggestion-card">
                                        <div class="is-flex is-align-items-center">
                                            <figure class="image is-32x32 mr-3">
                                                <img class="is-rounded" src="https://www.gravatar.com/avatar/<?php echo md5(strtolower($user['username'])); ?>?s=32&d=identicon">
                                            </figure>
                                            <span class="has-text-weight-semibold"><?php echo htmlspecialchars($user['username']); ?></span>
                                        </div>
                                        <form action="follow_action.php" method="POST">
                                            <input type="hidden" name="target_user_id" value="<?php echo $user['id']; ?>">
                                            <?php if ($isFollowing) : ?>
                                                <button class="button is-danger is-small is-outlined" type="submit" name="unfollow">
                                                <span class="icon is-small">
                                                    <i class="fas fa-user-minus"></i>
                                                </span>
                                                    <span>Ontvolgen</span>
                                                </button>
                                            <?php else : ?>
                                                <button class="button is-primary is-small is-outlined" type="submit" name="follow">
                                                <span class="icon is-small">
                                                    <i class="fas fa-user-plus"></i>
                                                </span>
                                                    <span>Volgen</span>
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<p class="has-text-grey">Geen suggesties beschikbaar</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Berichten sectie -->
                    <div class="box">
                        <h2 class="title is-5 has-text-centered">Jouw recente berichten</h2>
                        <?php
                        $userId = $_SESSION['user']['id'];
                        $stmt = $conn->prepare("SELECT message, created_at FROM messages WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="message-box">
                                    <p><?php echo htmlspecialchars($row['message']); ?></p>
                                    <p class="message-time">
                                    <span class="icon is-small">
                                        <i class="far fa-clock"></i>
                                    </span>
                                        <?php echo date('d M Y H:i', strtotime($row['created_at'])); ?>
                                    </p>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="notification is-light">Nog geen berichten. Schrijf je eerste bericht!</div>';
                        }
                        ?>
                    </div>

                    <!-- Nieuw bericht formulier -->
                    <div class="box">
                        <h2 class="title is-5 has-text-centered">Nieuw bericht</h2>
                        <form action="send_message.php" method="POST" class="message-form">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea" name="message" placeholder="Schrijf je bericht hier..." required></textarea>
                                </div>
                            </div>
                            <div class="field has-text-centered">
                                <button class="button is-primary is-medium" type="submit" name="btnSendMessage">
                                <span class="icon">
                                    <i class="fas fa-paper-plane"></i>
                                </span>
                                    <span>Bericht versturen</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Uitlogknop -->
                    <div class="has-text-centered mt-6">
                        <a class="button is-light is-outlined" href="logout.php">
                        <span class="icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                            <span>Uitloggen</span>
                        </a>
                    </div>

                <?php else : ?>
                    <div class="notification is-warning has-text-centered">
                        <p class="is-size-5">Je moet ingelogd zijn om deze pagina te zien.</p>
                        <a href="login.php" class="button is-warning is-inverted mt-3">
                        <span class="icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                            <span>Klik hier om in te loggen</span>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>

<?php include_once('./footer.php'); ?>