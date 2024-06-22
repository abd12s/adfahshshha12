<?php
session_start();

// بيانات المشرف (يمكن استبدالها ببيانات حقيقية)
$admin_username = "asdajjammxbbzj527#&";
$admin_password = "smisushayqqoapia928#*";

// الدالة للتحقق من تسجيل الدخول
function check_login($username, $password) {
    global $admin_username, $admin_password;
    return ($username == $admin_username && $password == $admin_password);
}

// إذا تم تقديم نموذج تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // التحقق من صحة اسم المستخدم وكلمة المرور
    if (check_login($username, $password)) {
        $_SESSION['admin'] = true; // تعيين جلسة لتسجيل الدخول
        header("Location: control_panel.php"); // إعادة توجيه إلى لوحة التحكم
        exit();
    } else {
        $error_message = "اسم المستخدم أو كلمة المرور غير صحيحة.";
    }
}

// إذا كان المشرف مسجلاً دخوله بالفعل، توجيهه مباشرة إلى لوحة التحكم
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    header("Location: control_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تسجيل الدخول</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="تسجيل الدخول">
        </form>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>