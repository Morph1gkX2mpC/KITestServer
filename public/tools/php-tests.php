<?php
session_start();

// Initialize session counter
if (!isset($_SESSION['visit_count'])) {
    $_SESSION['visit_count'] = 0;
}
$_SESSION['visit_count']++;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tests - Web Testing Server</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>🐘 PHP Tests</h1>
            <p class="tagline">Test server-side PHP processing and functionality</p>
        </div>
    </header>

    <nav class="main-nav">
        <div class="container">
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="html-tests.html">HTML Tests</a></li>
                <li><a href="css-tests.html">CSS Tests</a></li>
                <li><a href="js-tests.html">JavaScript Tests</a></li>
                <li><a href="php-tests.php" class="active">PHP Tests</a></li>
                <li><a href="form-tests.html">Form Tests</a></li>
                <li><a href="ajax-tests.html">AJAX Tests</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <section class="test-section">
            <h3>PHP Information</h3>
            <p>Testing basic PHP environment information.</p>
            <div class="test-result">
                <strong>PHP Version:</strong> <?php echo phpversion(); ?><br>
                <strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?><br>
                <strong>Server Name:</strong> <?php echo $_SERVER['SERVER_NAME'] ?? 'Unknown'; ?><br>
                <strong>Server Protocol:</strong> <?php echo $_SERVER['SERVER_PROTOCOL'] ?? 'Unknown'; ?><br>
                <strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown'; ?><br>
                <strong>Current Script:</strong> <?php echo $_SERVER['SCRIPT_NAME'] ?? 'Unknown'; ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Date and Time Functions</h3>
            <p>Testing PHP date and time manipulation.</p>
            <div class="test-result">
                <strong>Current Date:</strong> <?php echo date('Y-m-d'); ?><br>
                <strong>Current Time:</strong> <?php echo date('H:i:s'); ?><br>
                <strong>Full DateTime:</strong> <?php echo date('Y-m-d H:i:s'); ?><br>
                <strong>Formatted Date:</strong> <?php echo date('l, F j, Y'); ?><br>
                <strong>Timestamp:</strong> <?php echo time(); ?><br>
                <strong>Timezone:</strong> <?php echo date_default_timezone_get(); ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Session Management</h3>
            <p>Testing PHP session handling.</p>
            <div class="test-result">
                <strong>Session ID:</strong> <?php echo session_id(); ?><br>
                <strong>Visit Count:</strong> <?php echo $_SESSION['visit_count']; ?><br>
                <strong>Session Name:</strong> <?php echo session_name(); ?><br>
            </div>
            <form method="POST" action="" style="margin-top: 1rem;">
                <button type="submit" name="reset_session" class="btn btn-secondary">Reset Session</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_session'])) {
                session_destroy();
                echo '<script>setTimeout(() => window.location.href = "php-tests.php", 1000);</script>';
                echo '<div class="alert alert-success" style="margin-top: 1rem;">Session reset! Reloading...</div>';
            }
            ?>
        </section>

        <section class="test-section">
            <h3>String Functions</h3>
            <p>Testing PHP string manipulation functions.</p>
            <?php
            $testString = "Hello, PHP World!";
            ?>
            <div class="test-result">
                <strong>Original String:</strong> "<?php echo $testString; ?>"<br>
                <strong>Length:</strong> <?php echo strlen($testString); ?><br>
                <strong>Uppercase:</strong> <?php echo strtoupper($testString); ?><br>
                <strong>Lowercase:</strong> <?php echo strtolower($testString); ?><br>
                <strong>Reversed:</strong> <?php echo strrev($testString); ?><br>
                <strong>Word Count:</strong> <?php echo str_word_count($testString); ?><br>
                <strong>Replace "PHP" with "Server":</strong> <?php echo str_replace("PHP", "Server", $testString); ?><br>
                <strong>Substring (0, 5):</strong> <?php echo substr($testString, 0, 5); ?><br>
                <strong>Position of "PHP":</strong> <?php echo strpos($testString, "PHP"); ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Array Functions</h3>
            <p>Testing PHP array operations.</p>
            <?php
            $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            $fruits = ['apple', 'banana', 'cherry', 'date'];
            ?>
            <div class="test-result">
                <strong>Numbers Array:</strong> [<?php echo implode(', ', $numbers); ?>]<br>
                <strong>Count:</strong> <?php echo count($numbers); ?><br>
                <strong>Sum:</strong> <?php echo array_sum($numbers); ?><br>
                <strong>Average:</strong> <?php echo array_sum($numbers) / count($numbers); ?><br>
                <strong>Max:</strong> <?php echo max($numbers); ?><br>
                <strong>Min:</strong> <?php echo min($numbers); ?><br>
                <strong>Reversed:</strong> [<?php echo implode(', ', array_reverse($numbers)); ?>]<br>
                <strong>Fruits Array:</strong> [<?php echo implode(', ', $fruits); ?>]<br>
                <strong>In Array (banana):</strong> <?php echo in_array('banana', $fruits) ? 'true' : 'false'; ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Math Functions</h3>
            <p>Testing PHP mathematical operations.</p>
            <div class="test-result">
                <strong>Random Number (1-100):</strong> <?php echo rand(1, 100); ?><br>
                <strong>Pi:</strong> <?php echo M_PI; ?><br>
                <strong>Square Root of 16:</strong> <?php echo sqrt(16); ?><br>
                <strong>2 to the power of 8:</strong> <?php echo pow(2, 8); ?><br>
                <strong>Absolute of -42:</strong> <?php echo abs(-42); ?><br>
                <strong>Round 4.7:</strong> <?php echo round(4.7); ?><br>
                <strong>Ceil 4.1:</strong> <?php echo ceil(4.1); ?><br>
                <strong>Floor 4.9:</strong> <?php echo floor(4.9); ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>File System Functions</h3>
            <p>Testing PHP file system operations.</p>
            <div class="test-result">
                <strong>Current Directory:</strong> <?php echo getcwd(); ?><br>
                <strong>Script Filename:</strong> <?php echo __FILE__; ?><br>
                <strong>Directory Name:</strong> <?php echo __DIR__; ?><br>
                <strong>File Exists (this file):</strong> <?php echo file_exists(__FILE__) ? 'Yes' : 'No'; ?><br>
                <strong>Is Readable:</strong> <?php echo is_readable(__FILE__) ? 'Yes' : 'No'; ?><br>
                <strong>File Size:</strong> <?php echo filesize(__FILE__); ?> bytes<br>
            </div>
        </section>

        <section class="test-section">
            <h3>JSON Operations</h3>
            <p>Testing PHP JSON encoding and decoding.</p>
            <?php
            $data = [
                'name' => 'Test Server',
                'version' => '1.0',
                'features' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
                'active' => true
            ];
            $json = json_encode($data, JSON_PRETTY_PRINT);
            ?>
            <div class="test-result">
                <strong>PHP Array to JSON:</strong>
                <pre style="background: #2d2d2d; color: #f8f8f2; padding: 1rem; border-radius: 5px; overflow-x: auto;"><?php echo htmlspecialchars($json); ?></pre>
            </div>
        </section>

        <section class="test-section">
            <h3>Request Information</h3>
            <p>Testing PHP request handling.</p>
            <div class="test-result">
                <strong>Request Method:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?><br>
                <strong>Request URI:</strong> <?php echo $_SERVER['REQUEST_URI'] ?? 'Unknown'; ?><br>
                <strong>Query String:</strong> <?php echo $_SERVER['QUERY_STRING'] ?? 'None'; ?><br>
                <strong>User Agent:</strong> <?php echo $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'; ?><br>
                <strong>Remote Address:</strong> <?php echo $_SERVER['REMOTE_ADDR'] ?? 'Unknown'; ?><br>
                <strong>Remote Port:</strong> <?php echo $_SERVER['REMOTE_PORT'] ?? 'Unknown'; ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Form Processing Test</h3>
            <p>Testing PHP form data processing.</p>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_input'])) {
                echo '<div class="alert alert-success">';
                echo '<strong>Form Submitted Successfully!</strong><br>';
                echo 'Received: ' . htmlspecialchars($_POST['test_input']) . '<br>';
                echo 'Timestamp: ' . date('Y-m-d H:i:s');
                echo '</div>';
            }
            ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="test_input">Enter some text:</label>
                    <input type="text" id="test_input" name="test_input" class="form-control" required>
                </div>
                <button type="submit" class="btn">Submit Form</button>
            </form>
        </section>

        <section class="test-section">
            <h3>Conditional Logic</h3>
            <p>Testing PHP conditional statements.</p>
            <div class="test-result">
                <?php
                $hour = date('H');
                if ($hour < 12) {
                    $greeting = "Good Morning";
                } elseif ($hour < 18) {
                    $greeting = "Good Afternoon";
                } else {
                    $greeting = "Good Evening";
                }
                ?>
                <strong>Current Hour:</strong> <?php echo $hour; ?><br>
                <strong>Greeting:</strong> <?php echo $greeting; ?>!<br>
                <strong>Is Evening:</strong> <?php echo ($hour >= 18) ? 'Yes' : 'No'; ?><br>
            </div>
        </section>

        <section class="test-section">
            <h3>Loops</h3>
            <p>Testing PHP loop structures.</p>
            <div class="test-result">
                <strong>For Loop (1-10):</strong><br>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo $i . ($i < 10 ? ', ' : '');
                }
                ?><br><br>
                
                <strong>Foreach Loop (Days):</strong><br>
                <?php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                foreach ($days as $day) {
                    echo $day . '<br>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Web Testing Server | Open Source Project</p>
        </div>
    </footer>

    <script src="../assets/js/main.js"></script>
</body>
</html>
