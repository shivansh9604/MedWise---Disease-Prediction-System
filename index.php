<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo "<script>console.log('User ID:', '{$_SESSION['user_id']}');</script>";
} else {
    echo "<script>console.error('User ID is missing!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Prediction System</title>
    
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background: #f4f4f4;
            transition: background 0.3s, color 0.3s;
        }
        .navbar {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar img {
            height: 70px;
            width: 250px;
            margin-right: 25px;
        }
        .hero {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            padding: 100px 0;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        .typewriter span {
            font-size: 1.5rem;
            font-weight: bold;
            border-right: 3px solid white;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
        }
        .btn-custom {
            background: #ff9800;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #e68900;
            transform: scale(1.05);
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: scale(1.05);
        }
        .statistics {
            background: #0275d8;
            color: white;
            padding: 40px 0;
        }
        .dark-mode {
            background: #222;
            color: white;
        }
        .tracker-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            text-align: center;
        }
        .progress {
            height: 15px;
            text-align: right;
            line-height: 15px;
            color: white;
            font-size: 12px;
            border-radius: 10px;
            transition: width 1s ease-in-out; 
        }
        .progress-bar {
            transition: width 0.8s ease-in-out;
            width: 100%;
            background-color: #ddd;
            border-radius: 10px;
            overflow: hidden;
            height: 15px;
        }
        .icon {
            font-size: 22px;
            margin-right: 8px;
        }
        .title {
            font-weight: bold;
            font-size: 24px;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        <!-- Symptom Checker CSS -->
        .symptom-btn {
            background: #f8f9fa;
            color: #333;
            border: 2px solid #ddd;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .symptom-btn:hover {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .symptom-btn.selected {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .card {
            border-radius: 15px;
            background: #fff;
        }

        .alert {
            font-size: 18px;
            font-weight: bold;
        }

        .health-tips-container {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: auto;
        }

        .health-tip-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            color: #333;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .health-tip-box:hover {
            transform: scale(1.05);
        }

        button {
            background: #ff9800;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background: #e68900;
        }


        /* News Section Styling */
        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* Carousel Styling */
        .carousel-img {
            height: 400px;
            object-fit: cover;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 10px;
        }

        
        .hospital-list-container {
            background: #f4f4f4;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            max-width: 1500px;
            margin: 50px auto;
        }

        .hospital-card {
            background: white;
            padding: 15px;
            margin: 50px 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
            cursor: pointer;
        }

        .hospital-card:hover {
            transform: scale(1.05);
            background: #e3f2fd;
        }

        .hospital-info {
            text-align: left;
            flex: 1;
        }

        .hospital-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .hospital-address {
            font-size: 14px;
            color: #666;
        }

        .hospital-icon {
            font-size: 24px;
            margin-left: 10px;
            color: #2b8a3e;
        }

        @media (max-width: 600px) {
            .hospital-card {
                flex-direction: column;
                text-align: center;
            }
        }
        .fab-refresh {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            font-size: 18px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: 0.3s;
        }
        .fab-refresh:hover {
            background: #0056b3;
            transform: rotate(90deg);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

       /* Chatbot Toggle Button */
.chat-toggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 12px 20px;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(0, 114, 255, 0.5);
    animation: glow 2s infinite alternate;
    z-index: 9999;
}

@keyframes glow {
    0% { box-shadow: 0 0 10px #00c6ff; }
    100% { box-shadow: 0 0 20px #0072ff; }
}

.chat-icon {
    width: 25px;
}

/* Chatbot Main */
.chatbot-container {
    position: fixed;
    bottom: 80px;
    left: 20px;
    width: 320px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
    overflow: hidden;
    display: none;
    flex-direction: column;
    animation: fadeInUp 0.5s ease;
    z-index: 9998;
}

/* Header */
.chatbot-header {
    background: linear-gradient(135deg, #0072ff, #00c6ff);
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    position: relative;
}

.ai-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    position: absolute;
    top: 10px;
    left: 10px;
}

.close-btn {
    position: absolute;
    right: 15px;
    top: 10px;
    cursor: pointer;
    font-size: 22px;
}

/* Messages */
.chatbot-messages {
    padding: 10px;
    max-height: 300px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* User and Bot Messages */
.user-message, .bot-message {
    max-width: 80%;
    padding: 10px 14px;
    border-radius: 16px;
    font-size: 14px;
    animation: messageFade 0.3s ease-in-out;
}

.user-message {
    background: #0072ff;
    color: white;
    align-self: flex-end;
}

.bot-message {
    background: #f0f0f0;
    color: #333;
    align-self: flex-start;
}

/* Input Box */
.chatbot-input {
    display: flex;
    padding: 10px;
    border-top: 1px solid #ccc;
}

.chatbot-input input {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
}

#send-btn {
    background: #0072ff;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 16px;
    margin-left: 10px;
    cursor: pointer;
    transition: background 0.3s;
}

#send-btn:hover {
    background: #005bb5;
}

@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes messageFade {
    0% { opacity: 0; transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
    <img src="logo.png" alt="MedWise Logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link btn btn-warning text-dark" href="predict.php">Make Prediction</a></li>
                <li class="nav-item"><a class="nav-link btn btn-warning text-dark" href="pneumonia_ui.php">Pneumonia</a></li>
                <li class="nav-item">
                    <button class="btn btn-dark ms-2" id="toggleDarkMode"><i class="fas fa-moon"></i></button>
                </li>
            </ul>
        </div>
    </div>  
</nav>

<!-- Hero Section -->
<header class="hero">
    <!-- Dynamic Greeting -->
    <div class="container text-center mt-4">
        <h2 id="greeting"></h2>
    </div>
    <div class="container">
        <h1>Predict Diseases with AI</h1>
        <p class="typewriter"><span id="typing-text"></span></p>
        <a href="predict.php" class="btn btn-lg btn-custom">Try Now</a>
    </div>
</header>

<!-- Live Statistics -->
<section class="statistics text-center">
    <div class="container">
        <h2 class="mb-4">Live Statistics</h2>
        <div class="row">
            <div class="col-md-4">
                <h3><i class="fas fa-users"></i> <span id="totalUsers">3,245</span></h3>
                <p>Users Registered</p>
            </div>
            <div class="col-md-4">
                <h3><i class="fas fa-check-circle"></i> <span id="totalPredictions">9,872</span></h3>
                <p>Predictions Made</p>
            </div>
            <div class="col-md-4">
                <h3><i class="fas fa-shield-alt"></i> 99.2%</h3>
                <p>Prediction Accuracy</p>
            </div>
        </div>
    </div>
</section>

<!-- Health Goal Tracker with Progress -->
<div class="tracker-container">
    <h3 class="text-center text-primary"><i class="fa-solid fa-heartbeat"></i> Live Health Tracker</h3>

    <div class="mb-3">
        <label class="fw-bold"><i class="fa-solid fa-shoe-prints icon text-primary"></i> Steps Taken: <span id="stepsValue">0</span></label>
        <div class="progress">
            <div id="stepsBar" class="progress-bar bg-primary" style="width: 0%;"></div>
        </div>
    </div>

    <div class="mb-3">
        <label class="fw-bold"><i class="fa-solid fa-fire icon" style="color: #e74c3c;"></i> Calories Burned: <span id="caloriesValue">0</span></label>
        <div class="progress">
            <div id="caloriesBar" class="progress-bar bg-danger" style="width: 0%;"></div>
        </div>
    </div>

    <div class="mb-3">
        <label class="fw-bold"><i class="fa-solid fa-heart icon" style="color: #f1c40f;"></i> Heart Rate: <span id="heartRateValue">0</span></label>
        <div class="progress">
            <div id="heartRateBar" class="progress-bar bg-warning" style="width: 0%;"></div>
        </div>
    </div>
</div>


<!-- AI Symptom Checker with Modern UI -->
<div class="container my-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center text-primary"><i class="fas fa-stethoscope"></i> AI Symptom Checker</h3>
        <p class="text-center text-muted">Select your symptoms to get AI-based health insights</p>
        
        <!-- Symptom Selection Grid with Icons -->
        <div id="symptom-buttons" class="d-flex flex-wrap justify-content-center gap-3">
            <button class="symptom-btn" data-symptom="fever"><i class="fas fa-thermometer-three-quarters"></i> Fever</button>
            <button class="symptom-btn" data-symptom="cough"><i class="fas fa-lungs-virus"></i> Cough</button>
            <button class="symptom-btn" data-symptom="headache"><i class="fas fa-head-side-virus"></i> Headache</button>
            <button class="symptom-btn" data-symptom="fatigue"><i class="fas fa-battery-quarter"></i> Fatigue</button>
            <button class="symptom-btn" data-symptom="chest pain"><i class="fas fa-heartbeat"></i> Chest Pain</button>
            <button class="symptom-btn" data-symptom="sore throat"><i class="fas fa-microphone-alt-slash"></i> Sore Throat</button>
            <button class="symptom-btn" data-symptom="shortness of breath"><i class="fas fa-wind"></i> Shortness of Breath</button>
            <button class="symptom-btn" data-symptom="loss of taste"><i class="fas fa-utensils"></i> Loss of Taste</button>
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-lg btn-primary" onclick="checkSymptoms()"><i class="fas fa-search"></i> Check Health Condition</button>
        </div>
        
        <!-- Display Result -->
        <div id="symptomResult" class="alert alert-info mt-3 text-center" style="display: none;"></div>
    </div>
</div>


<!-- Features Section -->
<!-- <section class="container text-center my-5">
    <h2 class="mb-4">Our Features</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-3">
                <img src="img/diabetes.jpg" class="card-img-top" alt="Diabetes Prediction">
                <div class="card-body">
                    <h5 class="card-title">Diabetes Prediction</h5>
                    <p class="card-text">Upload a CSV file with medical details and get instant diabetes risk assessment.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-3">
                <img src="img/xray.jpg" class="card-img-top" alt="Pneumonia Detection">
                <div class="card-body">
                    <h5 class="card-title">Pneumonia Detection</h5>
                    <p class="card-text">Upload a chest X-ray and let our AI model detect signs of pneumonia.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card feature-card shadow-sm p-3">
                <img src="img/security.jpg" class="card-img-top" alt="Data Security">
                <div class="card-body">
                    <h5 class="card-title">Data Security</h5>
                    <p class="card-text">Your medical data is encrypted and protected with the latest security standards.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<div class="health-tips-container">
    <h2>💡 Health Tip of the Day</h2>
    <div class="health-tip-box">
        <p id="health-tip">Loading health tip...</p>
        <button onclick="newHealthTip()">🔄 New Tip</button>
    </div>
</div>




<!-- Live Medical News Section -->
<div class="container my-5">
    <h2 class="mb-4 text-center">📰 Latest Medical News</h2>

    <!-- News Loader -->
    <div id="news-loader" class="text-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p>Loading news...</p>
    </div>

    <!-- Trending News Carousel -->
    <div id="newsCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner" id="news-carousel-container"></div>
        <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- News Grid -->
    <div class="row" id="news-container"></div>
        <ul id="news-list" class="list-group"></ul>
    </div>

    
<!-- Nearby Hospitals & Pharmacies -->
<div class="hospital-list-container">
    <h2>📍 Nearby Hospitals & Pharmacies
        <i class="fas fa-moon toggle-theme" onclick="toggleTheme()"></i>
    </h2>
    <input type="text" id="search" class="search-bar" placeholder="Search hospitals or pharmacies...">
    <button onclick="findNearbyPlaces()">Find Nearby</button>
    <div id="hospital-list"></div>
</div>


<!-- Chatbot Toggle Button -->
<button id="chatbot-toggle" class="chat-toggle">
    <img src="chatbot-icon.png" alt="Chatbot" class="chat-icon">
    <span>Chat</span>
</button>

<!-- Chatbot Container -->
<div id="chatbot" class="chatbot-container">
    <div class="chatbot-header">
        <img src="ai-avatar.png" alt="AI" class="ai-avatar">
        <h2>MedWise AI Assistant 🤖</h2>
        <span id="chatbot-close" class="close-btn">&times;</span>
    </div>
    <div id="chatbot-messages" class="chatbot-messages"></div>
    <div class="chatbot-input">
        <input type="text" id="user-input" placeholder="Ask about your health...">
        <button id="send-btn">Send</button>
    </div>
</div>

    

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2025 Medical Prediction System | Powered by AI</p>
</footer>

<!-- JavaScript & OpenStreetMap API -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- JavaScript -->
<script>
    let userId = <?php echo isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null'; ?>;

if (userId) {
    console.log("User ID from session:", userId);
} else {
    console.error("User ID is missing in JavaScript!");
}

window.onload = function() {
    const synth = window.speechSynthesis;

    // Detect time-based greeting
    const now = new Date();
    let greeting;
    const hour = now.getHours();

    if (hour < 12) {
        greeting = "Good morning! Welcome to MedWise, your AI health companion.";
    } else if (hour < 18) {
        greeting = "Good afternoon! Welcome to MedWise. Let’s care for your health together.";
    } else {
        greeting = "Good evening! Welcome to MedWise, your AI health assistant.";
    }

        const speakGreeting = () => {
            const utterance = new SpeechSynthesisUtterance(greeting);
            utterance.rate = 0.95;
            utterance.pitch = 1.1;
            utterance.volume = 1;

            // Choose preferred voice
            const voices = synth.getVoices();
            const preferredVoice = voices.find(voice => 
                voice.name.includes('Google') && voice.lang.includes('en-US')
            ) || voices.find(voice => voice.lang.includes('en-US'));

            if (preferredVoice) {
                utterance.voice = preferredVoice;
            }

            synth.speak(utterance);
        };

        // Wait until voices are loaded
        if (synth.onvoiceschanged !== undefined) {
            synth.onvoiceschanged = speakGreeting;
        } else {
            setTimeout(speakGreeting, 500); // Fallback in case voiceschanged isn't fired
        }
    };

    document.getElementById('toggleDarkMode').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
     // Dynamic Greeting
     function updateGreeting() {
            const hours = new Date().getHours();
            let greeting = "Welcome!";
            if (hours < 12) greeting = "Good Morning! ☀️";
            else if (hours < 18) greeting = "Good Afternoon! 🌤️";
            else greeting = "Good Evening! 🌙";
            document.getElementById("greeting").innerText = greeting;
        }
        updateGreeting();

    // Live Statistics Update
    setInterval(() => {
        document.getElementById('totalUsers').textContent = parseInt(document.getElementById('totalUsers').textContent) + Math.floor(Math.random() * 5);
        document.getElementById('totalPredictions').textContent = parseInt(document.getElementById('totalPredictions').textContent) + Math.floor(Math.random() * 10);
    }, 5000);

    // Typewriter Effect
    const textArray = ["Upload your medical data!", "Get AI-powered health insights!", "Stay ahead with early detection!"];
    let textIndex = 0, charIndex = 0;
    function typeWriter() {
        if (charIndex < textArray[textIndex].length) {
            document.getElementById("typing-text").textContent += textArray[textIndex][charIndex];
            charIndex++;
            setTimeout(typeWriter, 100);
        } else {
            setTimeout(() => {
                document.getElementById("typing-text").textContent = "";
                charIndex = 0;
                textIndex = (textIndex + 1) % textArray.length;
                typeWriter();
            }, 2000);
        }
    }
    typeWriter();

    // Health Goal Tracker with Progress
    function fetchLiveData() {
        $.ajax({
            url: 'get_health_data.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    console.error("Error: " + data.error);
                    return;
                }

                $("#stepsValue").text(data.steps);
                $("#caloriesValue").text(data.calories);
                $("#heartRateValue").text(data.heart_rate);

                // Updating progress bars dynamically
                $("#stepsBar").css("width", (data.steps / 10000) * 100 + "%");
                $("#caloriesBar").css("width", (data.calories / 500) * 100 + "%");
                $("#heartRateBar").css("width", (data.heart_rate / 180) * 100 + "%");
            },
            error: function (xhr, status, error) {
                console.error("Error fetching live data:", error);
            }
        });
    }

    // Fetch data every 5 seconds
    setInterval(fetchLiveData, 5000);


    // AI Symptom Checker Logic
    function checkSymptoms() {
        if (selectedSymptoms.length === 0) {
            alert("❌ Please select at least one symptom.");
            return;
        }

        // Conditions based on symptoms
        let conditions = {
            "fever": "Flu, COVID-19, or Infection",
            "cough": "Common Cold, Bronchitis, or Asthma",
            "headache": "Migraine, Stress, or Dehydration",
            "fatigue": "Anemia, Thyroid Issue, or Lack of Sleep",
            "chest pain": "Heart Condition, Anxiety, or Lung Issue",
            "sore throat": "Strep Throat, Common Cold, or Flu",
            "shortness of breath": "Asthma, Pneumonia, or Heart Disease",
            "loss of taste": "COVID-19, Sinus Infection, or Nutritional Deficiency"
        };

        let results = selectedSymptoms.map(symptom => `🩺 <b>${conditions[symptom]}</b>`).join("<br>");
        let suggestions = selectedSymptoms.includes("fever") ? "🔔 Stay Hydrated, Get Rest & Monitor Temperature" :
                         selectedSymptoms.includes("chest pain") ? "⚠️ Seek Medical Advice if Persistent" :
                         selectedSymptoms.includes("shortness of breath") ? "🛑 If severe, seek emergency help!" :
                         "💡 Maintain a Healthy Diet & Exercise";

        document.getElementById("symptomResult").style.display = "block";
        document.getElementById("symptomResult").innerHTML = `<strong>Possible Conditions:</strong><br>${results}<br><br><strong>Recommendations:</strong><br>${suggestions}`;
    }

    // ----------------------------------------------------------------------

    const healthTips = [
    "Drink at least 8 glasses of water daily to stay hydrated. 💧",
    "Get 7-9 hours of sleep for better health and productivity. 😴",
    "Eat more fruits and vegetables to boost your immunity. 🍏🥦",
    "Exercise for at least 30 minutes a day to stay fit. 🏋️‍♂️",
    "Practice deep breathing to reduce stress and anxiety. 🧘",
    "Avoid excessive screen time and take breaks. 👀",
    "Wash your hands regularly to prevent infections. 🧼",
    "Limit sugar intake for better heart health. ❤️",
];

function newHealthTip() {
    let randomIndex = Math.floor(Math.random() * healthTips.length);
    document.getElementById("health-tip").innerText = healthTips[randomIndex];
}

// Auto-change tip every 5 seconds
setInterval(newHealthTip, 5000);

// Load a tip on page load
newHealthTip();


//---------------------------------------------------------------------------------------

    async function fetchNews() {
        try {
            document.getElementById("news-loader").style.display = "block";

            let response = await fetch('https://newsapi.org/v2/top-headlines?category=health&country=us&apiKey=ee98c5d1e47b479e914f59366b914b09');
            let data = await response.json();
            let newsHTML = "";
            let carouselHTML = "";

            // Show trending news in the carousel (Top 3)
            data.articles.slice(0, 3).forEach((article, index) => {
                carouselHTML += `
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="${article.urlToImage || 'https://via.placeholder.com/800x400'}" class="d-block w-100 carousel-img" alt="News Image">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>${article.title}</h5>
                            <p>${article.description ? article.description.slice(0, 100) + '...' : 'No description available.'}</p>
                            <a href="${article.url}" target="_blank" class="btn btn-warning">Read More</a>
                        </div>
                    </div>
                `;
            });

            // Show latest news in grid format (Next 6)
            data.articles.slice(3, 9).forEach(article => {
                newsHTML += `
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-lg news-card">
                            <img src="${article.urlToImage || 'https://via.placeholder.com/350'}" class="card-img-top" alt="News Image">
                            <div class="card-body">
                                <h5 class="card-title">${article.title}</h5>
                                <p class="card-text">${article.description ? article.description.slice(0, 80) + '...' : 'No description available.'}</p>
                                <a href="${article.url}" target="_blank" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                `;
            });

            document.getElementById("news-carousel-container").innerHTML = carouselHTML;
            document.getElementById("news-container").innerHTML = newsHTML;
            document.getElementById("news-loader").style.display = "none";
        } catch (error) {
            console.log("Error fetching news", error);
            document.getElementById("news-container").innerHTML = "<p class='text-center text-danger'>Failed to load news. Try again later.</p>";
        }
    }
    fetchNews();

    function findNearbyPlaces() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                let userLat = position.coords.latitude;
                let userLon = position.coords.longitude;

                let query = `[out:json];
                (
                    node["amenity"="hospital"](around:5000, ${userLat}, ${userLon});
                    node["amenity"="pharmacy"](around:5000, ${userLat}, ${userLon});
                );
                out;`;

                let url = "https://overpass-api.de/api/interpreter?data=" + encodeURIComponent(query);

                fetch(url)
                    .then(response => response.json())
                    .then(data => displayPlaces(data.elements))
                    .catch(error => console.error("Error fetching places:", error));
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function displayPlaces(places) {
        const placesList = document.getElementById("hospital-list");
        placesList.innerHTML = ""; // Clear previous results

        if (places.length === 0) {
            placesList.innerHTML = "<div class='hospital-card'>No hospitals or pharmacies found nearby.</div>";
            return;
        }

        let limitedPlaces = places.slice(0, 5);
        
        limitedPlaces.forEach((place, index) => {
            let name = place.tags.name || "Unknown Name";
            let address = place.tags["addr:street"] || "No address available";
            let type = place.tags.amenity === "hospital" ? "🏥 Hospital" : "💊 Pharmacy";
            let googleSearchUrl = `https://www.google.com/search?q=${encodeURIComponent(name + " " + address)}`;

            let card = document.createElement("div");
            card.className = "hospital-card";
            card.style.animationDelay = `${index * 0.2}s`;
            card.onclick = () => window.open(googleSearchUrl, "_blank");
            card.innerHTML = `
                <div class="hospital-info">
                <div class="hospital-name">${name}</div>
                <div class="hospital-address">${address} (${type})</div>
                </div>
                <div class="hospital-icon">🏥</div>
            `;
            placesList.appendChild(card);
        });
    }

    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbot = document.getElementById('chatbot');
    const chatbotClose = document.getElementById('chatbot-close');
    const sendBtn = document.getElementById('send-btn');
    const userInput = document.getElementById('user-input');
    const chatbotMessages = document.getElementById('chatbot-messages');

    // Open chatbot
    chatbotToggle.addEventListener('click', () => {
        chatbot.style.display = "flex";
    });

    // Close chatbot
    chatbotClose.addEventListener('click', () => {
        chatbot.style.display = "none";
    });

    // Send message
    sendBtn.addEventListener('click', () => {
        sendMessage();
    });

    // Handle Enter key
    userInput.addEventListener('keypress', (e) => {
        if (e.key === "Enter") sendMessage();
    });

    // Send message function
    function sendMessage() {
        const message = userInput.value.trim();
        if (message === "") return;

        // Append user message
        const userMsg = document.createElement('div');
        userMsg.className = "user-message";
        userMsg.innerText = message;
        chatbotMessages.appendChild(userMsg);
        userInput.value = "";
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        // Show typing...
        const typing = document.createElement('div');
        typing.className = "bot-message";
        typing.innerText = "MedWise is typing...";
        chatbotMessages.appendChild(typing);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        // Fetch bot response
        fetch('chatbot_backend.php', {
            method: 'POST',
            body: JSON.stringify({ message }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            setTimeout(() => {
                typing.remove();
                const botMsg = document.createElement('div');
                botMsg.className = "bot-message";
                botMsg.innerText = data.reply;
                chatbotMessages.appendChild(botMsg);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }, 800); // simulate typing delay
        });
    }


    setInterval(() => {
        document.getElementById('totalUsers').textContent = parseInt(document.getElementById('totalUsers').textContent) + Math.floor(Math.random() * 5);
        document.getElementById('totalPredictions').textContent = parseInt(document.getElementById('totalPredictions').textContent) + Math.floor(Math.random() * 10);
    }, 5000);
</script>

</body>
</html>
