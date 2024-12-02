<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        body {
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, rgba(0, 0, 0, 0.3) 70%, #001f3f 100%);
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #0c76e0;
            position: relative;
        }

        #snow-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .snowflake {
            position: absolute;
            top: -10px;
            font-size: 1rem;
            color: white;
            opacity: 0.10;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0.5;
            }
        }

        .snowflake:nth-child(odd) {
            animation-duration: 40s;
            font-size: 1.2rem;
        }

        .snowflake:nth-child(even) {
            animation-duration: 30s;
            font-size: 0.8rem;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 45%; /* Center horizontally */
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 100%;
            max-width: 450px; /* Maximum width for larger screens */
            padding: 0 20px; /* Padding for small screens */
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem; /* Adjusted padding for better fit */
            width: 200%; /* Full width of the container */
            height: auto; /* Set to auto for dynamic height based on content */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo img {
            width: 120px;
        }

        .education-text {
            color: grey; /* Set the text color to grey */
            margin-top: 0.5rem; /* Add some space above the text */
            font-weight: bold; /* Optional: Make the text bold */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .line {
            flex-grow: 1;
            height: 1px; /* Thickness of the line */
            background-color: #001f3f; /* Color of the line */
            margin: 0 10px; /* Space around the line */
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-check-label {
            margin-left: 0.5rem;
        }

        .btn-primary {
            background-color: #1A5794;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #004080;
        }

        a {
            color: #001F3F;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .hat {
            position: absolute;
            top: -80px;
            right: -22%;
            width: 240px;
            transform: rotate(14deg);
        }

        .santa-gif {
            position: absolute;
            bottom: -38%;
            left: -660px;
            width: 500px;
            overflow: hidden;
            animation: santa-ride 20s linear infinite;
        }

        .santa-gif img {
            width: 100%;
            height: auto;
        }

        @keyframes santa-ride {
            0% {
                transform: translateX(0) scaleX(1);
            }
            50% {
                transform: translateX(100vw) scaleX(1);
            }
            75% {
                transform: translateX(100vw) scaleX(-1);
            }
            100% {
                transform: translateX(0vw) scaleX(-1);
            }
        }

        /* Pop-out Image */
        #popoutImage {
            position: absolute;
            bottom: -4%; /* Adjust vertical position */
            left: 0%; /* Adjust for left corner */
            width: 120px; /* Adjust as needed */
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        /* Text next to the pop-out image */
        #popoutText {
            position: absolute;
            bottom: 25%; /* Adjust vertical position */
            left: 9.5%; /* Adjust horizontal position */
            background-color: white;
            border: 2px solid #1A5794; /* Border color */
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            color: #1A5794; /* Text color */
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        /* Music Controls */
        #musicControls {
            position: absolute;
            top: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            z-index: 2; /* Bring controls to the front */
        }

        /* Ensure the form elements are aligned properly */
        .form-outline input {
            width: 100%; /* Ensure the input takes full width */
        }

        .btn-block {
            width: 100%; /* Ensure button takes full width */
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%; /* Take up more width on smaller screens */
                padding: 0; /* Remove extra padding */
            }

            .card {
                padding: 1rem; /* Adjust padding for smaller screens */
            }

            .logo img {
                width: 100px; /* Smaller logo for mobile */
            }

            /* Hide music controls and pop-out elements on mobile */
            #musicControls,
            #popoutImage,
            #popoutText {
                display: none; /* Hide these elements */
            }
        }

        @media (max-width: 480px) {
            .hat {
                width: 150px; /* Adjust hat size for mobile */
            }

            .santa-gif {
                width: 300px; /* Adjust Santa gif size for mobile */
            }

            #popoutImage {
                width: 100px; /* Smaller pop-out image */
            }

            #popoutText {
                font-size: 16px; /* Smaller text for mobile */
            }
        }
    </style>
</head>

<body>
    
    <audio id="backgroundMusic" autoplay loop muted>
        <source src="music/jinglebells.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div id="musicControls">
        <button id="playMusic" class="btn btn-primary">Play Music</button>
        <button id="pauseMusic" class="btn btn-secondary">Pause Music</button>
    </div>

    <!-- Snowflake container -->
    <div id="snow-container"></div>

    <!-- Pop-out Image -->
    <img id="popoutImage" src="image/jose1.png" alt="Pop-out Image">
    <!-- Pop-out Text -->
    <div id="popoutText">Merry Christmas!</div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="image/christmashat.png" alt="Santa Hat" class="hat">
                    <div class="santa-gif">
                        <img src="image/santaclaire.gif" alt="Santa Claus with Reindeer">
                    </div>
                    <div class="logo">
                        <img src="image/UCLOGO.png" alt="logo">
                    </div>
                    <div class="education-text" style="margin-top: 5px; margin-bottom:20px; font-size:13px; color:#001f3f;">
                        <div class="line"></div>
                        Basic Education
                        <div class="line"></div>
                    </div>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-outline mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                        <button class="btn btn-primary btn-block mb-3">Login</button>
                        <a href="#" class="text-muted">Forgot Password?</a>
                    </form>

                    <div class="mt-4">
                        <p>Don't have an account? <a href="/register_consent" class="text-primary">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate snowflakes
        const snowContainer = document.getElementById('snow-container');

        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            snowflake.innerHTML = '&#10054;';
            snowflake.style.left = Math.random() * 100 + 'vw';
            snowflake.style.animationDuration = Math.random() * 3 + 7 + 's';
            snowflake.style.opacity = Math.random();
            snowflake.style.fontSize = Math.random() * 10 + 10 + 'px';

            snowContainer.appendChild(snowflake);

            setTimeout(() => {
                snowflake.remove();
            }, 10000);
        }

        setInterval(createSnowflake, 200);

        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', () => {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });

        const audio = document.getElementById('backgroundMusic');
        let toggleInterval;

        document.getElementById('playMusic').addEventListener('click', () => {
            audio.muted = false; 
            audio.play(); 
            toggleImageAndText(); // Show pop-out image and text when music plays
        });

        document.getElementById('pauseMusic').addEventListener('click', () => {
            audio.pause(); 
            stopImageAndText(); // Stop the pop-out image and text when music is paused
        });

        // Pop-out image logic
        const popoutImage = document.getElementById('popoutImage');
        const popoutText = document.getElementById('popoutText');

        function toggleImageAndText() {
            popoutImage.style.opacity = 1; // Show image
            popoutText.style.opacity = 1; // Show text
            setTimeout(() => {
                popoutImage.style.opacity = 0; // Hide image
                popoutText.style.opacity = 0; // Hide text
            }, 3000); // Both shown for 3 seconds
            
            if (!toggleInterval) {
                toggleInterval = setInterval(() => {
                    popoutImage.style.opacity = 1;
                    popoutText.style.opacity = 1;
                    setTimeout(() => {
                        popoutImage.style.opacity = 0; 
                        popoutText.style.opacity = 0; 
                    }, 3000);
                }, 6000); // Repeat every 6 seconds
            }
        }

        function stopImageAndText() {
            clearInterval(toggleInterval); // Stop the interval
            toggleInterval = null; // Reset the interval variable
            popoutImage.style.opacity = 0; // Hide image
            popoutText.style.opacity = 0; // Hide text
        }
        
    </script>
</body>

</html>