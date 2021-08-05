<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
</head>
<body>
    <div class="email-container">
        <div class="logo-email">
            <img src="<?php echo e(asset('imgs/b-white.png')); ?>" alt="homepage">
        </div>

        <div class="card">
            <p>Ti è arrivata un email da: <strong><?php echo e($mail->email_sender); ?></strong></p>
            <p id="data">Data: <?php echo e($mail->created_at); ?></p>
            <div class="card-body">
                <p><strong>Messaggio: </strong></p>
                <p><?php echo e($mail->content); ?></p>
            </div>
        </div>

    </div>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Maven Pro', sans-serif;
    }

    body {
        background-color: #71a8cd;
        padding: 20px;
    }

    .logo-email img {
        max-width: 120px;
        width: 100%;
        margin-bottom: 30px;
    }

    .card {
        width: 70%;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba($color: #0000, $alpha: 0.2);
        margin: auto;
        margin-top: 40px:
    }

    .card-body {
        width: 70%;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid gray;
        margin: auto;
    }

    #data {
        margin-bottom: 20px;
        font-size: 12px;
        color: gray;
    }

    @media (max-width: 575px) {

        .card {
            width: 95%;
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba($color: #0000, $alpha: 0.2);
            margin: auto;
            margin-top: 40px:
        }

        .card-body {
            width: 95%;
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid gray;
            margin: auto;
        }
    }

</style>
<?php /**PATH C:\Users\asky_\OneDrive\Desktop\project\boolbnb\resources\views/mail/index.blade.php ENDPATH**/ ?>