<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Add your other styles and scripts here -->
    <style>
        /* Styles for the top button */
        #topButton {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px; /* Adjusted for the bottom right corner */
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            z-index: 99;
        }
    </style>
    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({ behavior: 'smooth' });
        }

        // Function to scroll to the top of the page
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Function to toggle visibility of the top button based on scroll position
        function toggleTopButton() {
            const topButton = document.getElementById('topButton');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                topButton.style.display = 'block';
            } else {
                topButton.style.display = 'none';
            }
        }

        // Event listener for scroll
        window.onscroll = function() {
            toggleTopButton();
        };
    </script>
</head>
<body>

  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
  <p>Hello</p>
    <!-- Top button -->
    <button id="topButton" onclick="scrollToTop()">
        <i class="fa fa-arrow-up"></i> Top
    </button>

</body>
</html>
