<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['medicine_name'])) {
    $medicineName = trim($_POST['medicine_name']);
    $url = "http://example.com/daroo.php?name=" . urlencode($medicineName);
    $response = file_get_contents($url);
    $data = json_decode($response, true);
} else {
    $data = null;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>جستجوی دارو</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        @font-face {
            font-family: 'CustomFont';
            src: url('http://example.com/1.ttf') format('truetype');
        }

        body {
            font-family: 'CustomFont';
            background-color: #f4f4f4;
            color: #333;
            padding: 15px;
            width: 100%;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon {
            width: 35px;
            height: 35px;
            margin-bottom: 10px;
        }

        h1 {
            color: #5a5a5a;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .search-form {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.95rem;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .instructions {
            margin-top: 15px;
            font-size: 0.85rem;
            color: #666;
            line-height: 1.5;
        }

        .result-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        .result-box {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 0 auto;
            width: 100%;
        }

        .result-box h2 {
            color: #4CAF50;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .result-content {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .error {
            color: #e74c3c;
            font-weight: bold;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 500px;
                padding: 20px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .search-form {
                padding: 20px;
            }
            
            .result-box {
                padding: 20px;
                max-width: 500px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href='main.php'><img src='http://example.com/back.svg' alt='بازگشت' class='icon'></a>
            <h1>جستجوی دارو</h1>
        </div>
        
        <form class="search-form" method="POST" action="">
            <div class="form-group">
                <label for="medicine_name">نام دارو:</label>
                <input type="text" id="medicine_name" name="medicine_name" required>
            </div>
            <button type="submit">جستجو</button>
            
            <div class="instructions">
                <p>• برای یافتن دارو، نام دارو را همزمان انگلیسی و فارسی تایپ نکنید</p>

            </div>
        </form>

        <?php if ($data): ?>
            <div class="result-container">
                <div class="result-box">
                    <h2>نتیجه جستجو</h2>
                    <div class="result-content">
                        <?php if (isset($data['error'])): ?>
                            <p class="error"><?php echo htmlspecialchars($data['error']); ?></p>
                        <?php else: ?>
                            <p>دارو: <strong><?php echo htmlspecialchars(key($data)); ?></strong></p>
                            <p>کاربرد: <strong><?php echo htmlspecialchars($data[key($data)]); ?></strong></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
