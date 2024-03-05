<?php
    session_start();

    $timeout = 30 * 60; 

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();
    }

    $_SESSION['last_activity'] = time();

    $bgColor = isset($_COOKIE['bgColor']) ? $_COOKIE['bgColor'] : '#ffffff'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bgColor = isset($_POST["bgColor"]) ? $_POST["bgColor"] : '#ffffff';
        setcookie('bgColor', $bgColor, time() + 30 * 60, "/");
    }
?>

<?php
    $servername = "localhost";
    $database = "portfolio";
    $username = "rokon";
    $password = "rokon380";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $message = isset($_POST["message"]) ? $_POST["message"] : '';

        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo '<script>alert("Message stored successfully!");</script>';
        } else {
            echo '<script>alert("Error storing message: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
    $result = $conn->query("SELECT name, email, message FROM messages");

    if ($result->num_rows > 0) {
        echo '<div class="changing-background" style="margin: 20px;">';
        echo '<h2>All Messages:</h2>';
        echo '<table border="1" cellpadding="10">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Message</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td>' . $row["message"] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p>No messages found.</p>';
    }
    echo '<div class="changing-background" style="margin: 20px;">';
    echo '<h2>Upload Projects:</h2>';
    echo '<form action="admin.php" method="post" enctype="multipart/form-data">';
    echo '<div class="form-group">';
    echo '<label for="projectName">Project Name:</label>';
    echo '<input type="text" id="projectName" name="projectName" required>';
    echo '</div>';
    echo '<div class="form-group changing-background">';
    echo '<label for="projectDescription">Project Description:</label>';
    echo '<textarea id="projectDescription" name="projectDescription" rows="4" required></textarea>';
    echo '</div>';
    echo '<div class="form-group changing-background">';
    echo '<label for="projectImage">Project Image:</label>';
    echo '<input type="file" id="projectImage" name="projectImage" accept="image/*" required>';
    echo '</div>';
    echo '<div class="form-group changing-background">';
    echo '<button type="submit" name="uploadProject">Upload Project</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';

    if (isset($_POST["uploadProject"])) {
        $projectName = $_POST["projectName"];
        $projectDescription = $_POST["projectDescription"];
        $projectImage = file_get_contents($_FILES["projectImage"]["tmp_name"]);

        $stmt = $conn->prepare("INSERT INTO projects (name, description, project_image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $projectName, $projectDescription, $projectImage);

        if ($stmt->execute()) {
            echo '<script>alert("Project uploaded successfully!");</script>';
            header("Location: admin.php");
            exit();
        } else {
            echo '<script>alert("Error uploading project: ' . $stmt->error . '");</script>';
        }
    }

    $resultProjects = $conn->query("SELECT name, description, project_image FROM projects");
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <!-- Add your head content here -->
</head>

<body class="changing-background" style="margin: 20px;">

    <div style="margin-top: 20px;">
        <h2>Upload Projects:</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <!-- Add your project upload form here -->
        </form>
    </div>

    <section class="container1 project-section" id="project">
        <?php
        if ($resultProjects->num_rows > 0) {
            while ($row = $resultProjects->fetch_assoc()) {
                echo '<div class="project-item">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["project_image"]) . '" alt="' . $row["name"] . '" class="project-img">';
                echo '<div class="project-content">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No projects found.</p>';
        }
        ?>
    </section>

    <!-- Your remaining code here -->

</body>

</html>
