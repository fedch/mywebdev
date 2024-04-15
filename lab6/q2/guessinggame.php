<?php
session_start();

// Check if the session variable for the random number exists, if not, create it
if (!isset($_SESSION['randNum'])) {
    $_SESSION['randNum'] = rand(0, 100);
    $_SESSION['guessCount'] = 0;
}

$message = '';
$success = false;

// Check if a guess was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['guessCount']++;

    if ($guess < 0 || $guess > 100 || !is_numeric($_POST['guess'])) {
        $message = "Please enter a number between 0 and 100.";
    } else if ($guess < $_SESSION['randNum']) {
        $message = "Higher!";
    } else if ($guess > $_SESSION['randNum']) {
        $message = "Lower!";
    } else {
        $message = "Congratulations, you guessed the hidden number";
        $success = true;
    }
}

// Reset game
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: guessinggame.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guessing Game</title>
</head>
<body>
    <h1>Welcome to the Guessing Game</h1>
    <p>Enter a number between 1 and 100,
        then press the Guess button.</p>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (!$success): ?>
    <form method="post">
        <input type="number" name="guess">
        <button type="submit">Guess</button>
    </form>
    <?php endif; ?>
    <p>Number of guesses: <?php echo $_SESSION['guessCount']; ?></p>
    <br><a href="giveup.php">Give Up</a>
    <br><a href="startover.php">Start Over</a>
</body>
</html>
