<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php include_once '../inc/dashBoradNavInc.php'; ?>

    <div class="button-wrapper">
        <form action="../auth/logout.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </div>

    <div class="button-wrapper">
        <a href="./shippingStatus.php" role="button">
            <button type="button">Shipping Status</button>
        </a>
    </div>


    <style>
        .button-wrapper {
            width: 220px;
            margin: 1rem auto; /* centers horizontally with auto left/right margin */
        }

        .button-wrapper button {
            width: 100%;
            background-color: #DB4444;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            padding: 0.75rem 0;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 6px 12px rgba(219, 68, 68, 0.35);
            transition: background-color 0.3s ease, transform 0.15s ease, box-shadow 0.3s ease;
            user-select: none;
        }

        .button-wrapper button:hover,
        .button-wrapper button:focus {
            background-color: #b93b3b;
            box-shadow: 0 8px 20px rgba(219, 68, 68, 0.5);
            transform: translateY(-2px);
            outline: none;
        }

        .button-wrapper button:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(219, 68, 68, 0.3);
        }

        .button-wrapper a {
            text-decoration: none;
        }

    </style>

</body>
</html>