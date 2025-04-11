<?php
global $conn;
session_start();
include_once('./connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') if (isset($_POST['follow'], $_POST['target_user_id'], $_SESSION['user']['id'])) {
    $followerId = $_SESSION['user']['id'];
    $followedId = (int)$_POST['target_user_id'];

    $stmt = $conn->prepare("INSERT INTO followers (follower_id, followed_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $followerId, $followedId);
    $stmt->execute();

    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
elseif (isset($_POST['unfollow'], $_POST['target_user_id'], $_SESSION['user']['id'])) {
    $followerId = $_SESSION['user']['id'];
    $followedId = (int)$_POST['target_user_id'];

    $stmt = $conn->prepare("DELETE FROM followers WHERE follower_id = ? AND followed_id = ?");
    $stmt->bind_param("ii", $followerId, $followedId);
    $stmt->execute();

    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

// إذا وصلنا إلى هنا فهناك خطأ
header("Location: index.php");
exit();
