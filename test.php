<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    section {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2em;
    }

    #section1 {
      background-color: #87CEEB;
    }

    #section2 {
      background-color: #98FB98;
    }

    #section3 {
      background-color: #FFD700;
    }

    button {
      font-size: 1.5em;
      padding: 10px;
      margin: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <button onclick="scrollToSection('section1')">Section 1</button>
  <button onclick="scrollToSection('section2')">Section 2</button>
  <button onclick="scrollToSection('section3')">Section 3</button>

  <section id="section1">
    Section 1 Content
  </section>

  <section id="section2">
    Section 2 Content
  </section>

  <section id="section3">
    Section 3 Content
  </section>

  <script>
    function scrollToSection(sectionId) {
      const section = document.getElementById(sectionId);
      section.scrollIntoView({ behavior: 'smooth' });
    }
  </script>

</body>
</html>
