<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Course Selection Portal</title>
  <link rel="stylesheet" href="homepage.css" />
</head>
<body>
  <!-- Add an id to header for the Home anchor -->
  <header id="home">
    <div class="container">
      <h1>University Course Selection Portal</h1>
    </div>
  </header>

  <nav>
    <a href="#home">Home</a>
    <a href="#courses">Courses</a>
    <a href="#departments">Departments</a>
    <a href="#consultation">Course Consultation</a>
    <a href="login.php">Registration</a>
  </nav>

  <section class="hero">
    <div class="container">
      <h1>Choose Your Academic Path</h1>
      <p>
        Discover engaging courses that will shape your future and unlock your potential across diverse academic disciplines.
      </p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="container features">
    <div class="feature">
      <h2>Explore Programs</h2>
      <p>
        Browse through a wide range of undergraduate and graduate courses across multiple departments and disciplines.
      </p>
    </div>
    <div class="feature">
      <h2>Course Details</h2>
      <p>
        Access comprehensive course descriptions, syllabi, and instructor information to make informed decisions.
      </p>
    </div>
    <div class="feature">
      <h2>Smart Selection</h2>
      <p>
        Utilize our intelligent course recommendation system to find classes that align with your academic goals.
      </p>
    </div>
  </section>

  <!-- Courses Section -->
  <section id="courses" class="container courses">
    <h2>Courses Offered</h2>
    <div class="courses-grid">
      <div class="course-card">
        <h3>Computer Science</h3>
        <p>
          Learn the fundamentals of computing, programming, and software development.
        </p>
      </div>
      <div class="course-card">
        <h3>Business Administration</h3>
        <p>
          Master management, finance, and entrepreneurship skills.
        </p>
      </div>
      <div class="course-card">
        <h3>Medicine</h3>
        <p>
          Explore the world of healthcare, diagnostics, and patient care.
        </p>
      </div>
      <div class="course-card">
        <h3>Engineering</h3>
        <p>
          Develop technical skills in various fields of engineering.
        </p>
      </div>
    </div>
  </section>

  <!-- Departments Section -->
  <section id="departments" class="container departments">
    <h2>Departments by University</h2>
    <div class="university">
      <h3>University of Nairobi</h3>
      <ul>
        <li>
          <strong>Department of Computer Science:</strong> Data Structures, Algorithms, Artificial Intelligence, Software Engineering.
        </li>
        <li>
          <strong>Department of Business:</strong> Management, Marketing, Finance.
        </li>
      </ul>
    </div>
    <div class="university">
      <h3>Kenyatta University</h3>
      <ul>
        <li>
          <strong>Department of Engineering:</strong> Civil, Mechanical, Electrical Engineering.
        </li>
        <li>
          <strong>Department of Medicine:</strong> Nursing, Public Health, Clinical Sciences.
        </li>
      </ul>
    </div>
    <div class="university">
      <h3>Moi University</h3>
      <ul>
        <li>
          <strong>Department of Agriculture:</strong> Agronomy, Horticulture, Agricultural Economics.
        </li>
        <li>
          <strong>Department of Education:</strong> Teaching Methods, Educational Psychology.
        </li>
      </ul>
    </div>
  </section>

  <!-- Contact/Consultation Section -->
  <section id="consultation" class="container contact-form">
    <h2>Course Consultation</h2>
    <form id="contactForm">
      <input type="text" name="name" placeholder="Your Name" required />
      <input type="email" name="email" placeholder="Your Personal Email" required />
      <textarea name="message" placeholder="Describe your academic interests or course selection challenges" rows="5" required></textarea>
      <button type="submit">Request Consultation</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 University Course Selection Portal. All Rights Reserved.</p>
  </footer>

  <script>
    // Contact form handler
    document.getElementById('contactForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const name = this.name.value;
      const email = this.email.value;
      const message = this.message.value;
      if (!name || !email || !message) {
        alert('Please fill out all fields');
        return;
      }
      alert(`Thank you, ${name}! Your consultation request has been received. We'll contact you at ${email} soon.`);
      this.reset();
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        // If link is to the login page, let it redirect normally.
        if (this.getAttribute('href') === 'login.php') {
          return;
        }
        e.preventDefault();
        const targetID = this.getAttribute('href');
        const targetSection = document.querySelector(targetID);
        if (targetSection) {
          targetSection.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  </script>
</body>
</html>