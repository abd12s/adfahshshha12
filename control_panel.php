<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}

// إذا تم إرسال نموذج الرفع
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // التحقق من حجم الملف
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "عذرًا، حجم الملف كبير جدًا.";
        $uploadOk = 0;
    }

    // السماح بأنواع الملفات المعينة (JPG, JPEG, PNG, GIF, PY)
    $allowedExtensions = array("jpg", "jpeg", "png", "gif", "py");
    if (!in_array($fileType, $allowedExtensions)) {
        echo "عذرًا، يسمح فقط بتحميل ملفات الصور JPG, JPEG, PNG, GIF & PY.";
        $uploadOk = 0;
    }

    // إذا لم يكن هناك أخطاء، قم بتحميل الملف
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "تم تحميل الملف " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . ".";
        } else {
            echo "حدث خطأ أثناء تحميل الملف.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .logout {
            text-align: center;
            margin-bottom: 20px;
        }

        .upload-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .upload-form label {
            display: block;
            margin-bottom: 10px;
        }

        .upload-form input[type="file"] {
            margin-bottom: 10px;
        }

        .upload-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .upload-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="logout.php">تسجيل الخروج</a>
        </div>
        <h1>لوحة التحكم</h1>
        <div class="upload-form">
            <h2>تحميل الملفات</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="تحميل الملف">
            </form>
        </div>
    </div>
</body>
</html>