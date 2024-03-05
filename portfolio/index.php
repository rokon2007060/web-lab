<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>AL Shahriar Rokon</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $database = "portfolio";
        $username = "rokon";
        $password = "rokon380";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo '<script>alert("Database connected successfully");</script>';
        }
        $resultProjects = $conn->query("SELECT name, description, project_image FROM projects");
        $conn->close();
    ?>
    <header class="container">
        <div class="page-header">
            <div class="logo">
                <a href="#">Al Shahriar Rokon</a>
            </div>
            <input type="checkbox" id="click">
            <label for="click" class="mainicon">
                <div class="menu">
                    <i class='bx bx-menu'></i>
                </div>
            </label>
            <ul>
                <li><a href="#home" class="active" style="--navAni:1">Home</a></li>
                <li><a href="#about" style="--navAni:2">About</a></li>
                <li><a href="#skill" style="--navAni:3">Skills</a></li>
                <li><a href="#project" style="--navAni:4">Projects</a></li>
                <li><a href="#contact" style="--navAni:5">Contact</a></li>
            </ul>
            <label class="mode">
                <input type="checkbox" id="darkbtn">
                <i class='bx bxs-moon'></i>
            </label>
        </div>
    </header>
    <section class="container1" id="home">
        <div class="main">
            <div class="social">
                <a href="#" style="--socialAni:1"><i class='bx bxl-linkedin'></i></a>
                <a href="#" style="--socialAni:2"><i class='bx bxl-instagram'></i></a>
                <a href="#" style="--socialAni:4"><i class='bx bxl-facebook-circle'></i></a>
            </div>
            <div class="detail">
                <h1>Hi, I'm <span> a Student and </span></h1>
                <h3>Web Developer</h3>
                <p>I'm a professional Web Developer. I will not stop until my work is perfect or aesthetically pleasing.</p>
                <div class="btn">
                    <button>Download CV</button>
                </div>
            </div>
            <div class="img-sec">
                <div class="images">
                    <img src="rokon.png" alt="" class="img-w" style="scale: 2;">
                </div>
            </div>
        </div>
    </section>
    <section class="container1" id="about">
        <h2>About Me:</h2>
        <div class="about-content">
            <p class="fade-in">
                I come from a loving family consisting of my parents, two elder sisters, and one younger sister. My elder brother also plays a significant role in our family dynamics. I was born on December 30, 2002.
            </p>
            <p class="fade-in">
                In terms of my academic journey, I attended Nachole Upazila School for my primary and secondary education. Later, I completed my higher secondary education from New Government Degree College, Rajshahi, specializing in science. Currently, I am pursuing my studies in the Computer Science and Engineering department at Khulna University of Engineering and Technology (KUET).
            </p>
        </div>
    </section>
    <section class="container1 skills-section" id="skill">
        <h2>Skills:</h2>
        <div class="skill-item">
            <div class="skill-name">HTML</div>
            <div class="progress-bar" style="--progress: 80%;">80%</div>
        </div>
        <div class="skill-item">
            <div class="skill-name">CSS</div>
            <div class="progress-bar" style="--progress: 70%;">70%</div>
        </div>
        <div class="skill-item">
            <div class="skill-name">JavaScript</div>
            <div class="progress-bar" style="--progress: 50%;">50%</div>
        </div>
        <div class="skill-item">
            <div class="skill-name">PHP</div>
            <div class="progress-bar" style="--progress: 20%;">20%</div>
        </div>
    </section>
    <h2 class="container1" style="margin-top: 2rem;">Projects:</h2>
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
    <section class="container1 message-section" id="message">
        <h2 class="container1 message-form" style="margin-top: 5rem;">Leave a Message:</h2>
        <br>
        <div class="message-form">
            <form id="contactForm" action="admin.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </section>
    <section class="container1 contact-section" id="contact">
        <h2>Contact Me:</h2>
        <div class="contact-content">
            <p>
                📞 Phone Numbers:<br>
                <span class="phone-number">017XXXXXXX</span><br>
                <span class="phone-number">015XXXXXXX</span>
            </p>
            <p>
                ✉ Email:<br>
                <span class="email">asrkn3789@gmail.com</span>
            </p>
            <p>
                ☎ Landline:<br>
                <span class="landline">2344 7337</span>
            </p>
        </div>
    </section>
    <hr class="separator-line">
    <section class="container1 copyright-section">
        <p>&copy; AL Shahriar Rokon. All rights reserved. Unauthorized use or reproduction of any content is prohibited.</p>
        <p>This website is protected by copyright law. Any attempt to copy or reproduce the content without permission may result in legal action.</p>
        <p>Warning: Unauthorized reproduction of content is subject to legal consequences.</p>
    </section>
    <script src="script.js"></script>
</body>
</html>
