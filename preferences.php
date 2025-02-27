<?php
session_start();


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $academic_interests = $_POST['academic_interests'] ?? [];
    $career_goals = $_POST['career_goals'] ?? [];
    $learning_style = $_POST['learning_style'] ?? '';
    $difficulty_preference = $_POST['difficulty_preference'] ?? 0;
    $gpa_weight = $_POST['gpa_weight'] ?? 50;
    $interest_weight = $_POST['interest_weight'] ?? 50;

    // Prepare data for database
    $interests_json = json_encode($academic_interests);
    $career_goals_json = json_encode($career_goals);

    // Insert or update preferences
    $upsert_stmt = mysqli_prepare($conn, "
        INSERT INTO user_preferences 
        (user_id, academic_interests, career_goals, learning_style, difficulty_preference, gpa_weight, interest_weight) 
        VALUES (?, ?, ?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        academic_interests = ?, 
        career_goals = ?, 
        learning_style = ?, 
        difficulty_preference = ?, 
        gpa_weight = ?, 
        interest_weight = ?
    ");
    
    mysqli_stmt_bind_param(
        $upsert_stmt, 
        "isssiiiisssiis", 
        $user_id, 
        $interests_json, 
        $career_goals_json, 
        $learning_style, 
        $difficulty_preference, 
        $gpa_weight, 
        $interest_weight,
        $interests_json, 
        $career_goals_json, 
        $learning_style, 
        $difficulty_preference, 
        $gpa_weight, 
        $interest_weight
    );
    
    mysqli_stmt_execute($upsert_stmt);

    // Redirect to recommendations
    header("Location: recommendations.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academic Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <form method="POST" class="max-w-2xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl mb-6 text-center font-bold text-blue-600">Set Your Academic Preferences</h2>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Academic Interests</label>
                <div class="grid grid-cols-3 gap-2">
                    <?php 
                    $interests = [
                        'Computer Science', 'Data Science', 'Business', 
                        'Engineering', 'Mathematics', 'Psychology', 
                        'Biology', 'Economics', 'Marketing'
                    ];
                    foreach ($interests as $interest): ?>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="academic_interests[]" value="<?php echo $interest; ?>" 
                                class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2"><?php echo $interest; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Career Goals</label>
                <div class="grid grid-cols-3 gap-2">
                    <?php 
                    $career_goals = [
                        'Software Developer', 'Data Scientist', 'Business Analyst', 
                        'Product Manager', 'Research Scientist', 'Consultant', 
                        'Entrepreneur', 'Financial Analyst', 'UX Designer'
                    ];
                    foreach ($career_goals as $goal): ?>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="career_goals[]" value="<?php echo $goal; ?>" 
                                class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2"><?php echo $goal; ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Learning Style</label>
                <select name="learning_style" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Learning Style</option>
                    <option value="visual">Visual Learner</option>
                    <option value="auditory">Auditory Learner</option>
                    <option value="kinesthetic">Kinesthetic Learner</option>
                    <option value="reading_writing">Reading/Writing Learner</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Course Difficulty Preference
                    <span class="text-sm text-gray-600 block">How challenging do you want your courses to be?</span>
                </label>
                <input type="range" name="difficulty_preference" min="0" max="100"