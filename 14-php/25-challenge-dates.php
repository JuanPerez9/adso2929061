<?php
$title       = '25- Challenge Dates';
$description = 'Calculate the age in years.';

include 'template/header.php';
echo "<section>";


$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
$age = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($birthdate)) {
    $birth = strtotime($birthdate);
    $today = time();
    

    $age = floor(($today - $birth) / (365 * 24 * 60 * 60));
}
?>

<h3>Age Calculator</h3>

<form method="POST" action="">
    <label>Birth Date:</label><br>
    <input type="date" name="birthdate" value="<?= $birthdate ?>" required>
    <br><br>
    <button type="submit">Calculate Age</button>
</form>

<?php if ($age !== ''): ?>
    <div style="margin-top: 1rem; padding: 1rem; background: #e9ecef93; border-radius: 20px;">
        <p style="color: black"><strong>Your Age:</strong> <?= $age ?> years old</p>
    </div>
<?php endif; ?>

<?php include 'template/footer.php'; ?>