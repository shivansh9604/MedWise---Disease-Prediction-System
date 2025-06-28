<?php
// Get user message from frontend
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data['message']));

// Big list of responses
$responses = [

    // Greetings
    "hello" => ["👋 Hello! How can I help you today?"],
    "hi" => ["👋 Hi there! What health topic would you like to discuss?"],
    "good morning" => ["🌞 Good Morning! Hope you're staying healthy!"],
    "good evening" => ["🌙 Good Evening! How can I assist you?"],
    
    // Health conditions
    "diabetes symptoms" => ["🩺 Common diabetes symptoms include frequent urination, extreme thirst, blurred vision, slow-healing wounds, and fatigue."],
    "pneumonia symptoms" => ["🫁 Pneumonia symptoms may include cough, fever, chills, and shortness of breath."],
    "covid symptoms" => ["🦠 COVID-19 symptoms: fever, dry cough, tiredness, and loss of taste/smell. 😷"],
    "heart attack symptoms" => ["❤️ Heart attack signs: chest pain, shortness of breath, cold sweat, nausea. Call emergency services immediately! 🚑"],

    // General health tips
    "health tips" => ["💡 Tip: Stay hydrated, sleep well, exercise regularly, and manage stress. Your body will thank you!"],
    "diet tips" => ["🥗 Diet Tip: Include more fruits, vegetables, whole grains, and lean proteins in your meals."],
    "exercise benefits" => ["🏃‍♂️ Exercise improves heart health, strengthens muscles, boosts mood, and helps manage weight."],
    "stress management" => ["🧘‍♂️ Try meditation, deep breathing, regular breaks, and maintaining a work-life balance to reduce stress."],

    // Emergency and actions
    "emergency" => ["🚨 If you're facing a medical emergency, please call your local emergency number or go to the nearest hospital."],
    "appointment" => ["📅 I can help you schedule a doctor's appointment if needed! Would you like that?"],
    "nearest hospital" => ["🏥 Please enable location access so I can help find the nearest hospital for you."],

    // Symptoms
    "headache" => ["🤕 Headaches can be caused by stress, dehydration, or underlying conditions. Rest and hydration usually help."],
    "fever" => ["🌡️ A fever could mean your body is fighting an infection. Stay hydrated and rest."],
    "cough" => ["😷 Coughs can be due to allergies, infections, or dry air. Persistent coughing needs medical evaluation."],

    // Medicines
    "paracetamol" => ["💊 Paracetamol is commonly used to reduce fever and relieve mild to moderate pain. Always follow the dosage instructions."],
    "antibiotics" => ["💊 Antibiotics treat bacterial infections, not viral infections. Please use only if prescribed by a doctor."],

    // Preventive advice
    "vaccination" => ["💉 Vaccines protect against many serious diseases. Stay updated with your vaccination schedule!"],
    "hygiene tips" => ["🧼 Wash your hands frequently, keep surfaces clean, and practice good personal hygiene to prevent infections."],
];

// Default fallback replies
$defaultReplies = [
    "🤔 I'm still learning! Can you please rephrase or ask about symptoms, health tips, or medical guidance?",
    "🔎 Sorry, I don't have an answer for that yet. Please try asking about common health conditions or tips.",
    "🤖 I'm growing smarter every day! Try asking about diabetes, pneumonia, COVID-19, stress, diet, exercise, and more."
];

// Smart keyword matching
$responseText = "";
foreach ($responses as $keyword => $reply) {
    if (strpos($userMessage, $keyword) !== false) {
        $responseText = $reply[array_rand($reply)];
        break;
    }
}

// If no match found
if (empty($responseText)) {
    $responseText = $defaultReplies[array_rand($defaultReplies)];
}

// Send JSON response
echo json_encode(["reply" => $responseText]);
?>
