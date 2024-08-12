<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Static Template</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>

<body style="
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      font-size: 14px;
      display:flex;
      align-items:center;
      flex-direction:column
    ">
    <div style="
        max-width: 680px;
        margin: 0 auto;
        padding: 45px 30px 60px;
        background: #000000;
        background-image: url('https://alexondev.net/images/images/bg.png');
        background-repeat: no-repeat;
        background-size: 800px 452px;
        background-position: top center;
        font-size: 14px;
        color: #8c8c8c;
      ">
        <header>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 0;">
                        <td>
                            <img alt="" <img src="https://alexondev.net/images/images/logo.png">

                        </td>

                    </tr>
                </tbody>
            </table>
        </header>

        <main>
            <div style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 115px;
            background: #ffffff;
            border-radius: 30px;
            text-align: center;
          ">
                <div style="width: 100%; max-width: 489px; margin: 0 auto;">
                    <h1 style="
                margin: 0;
                font-size: 24px;
                font-weight: 500;
                color: #1f1f1f;
              ">
                        JAWRAA OTP
                    </h1>
                    <p style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 500;
              ">
                        Greetings from Jarwaa <br> Your Trusted Apple Authorized Reseller!
                    </p>
                    <p style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">
                        As part of our commitment to your account security, we've implemented a one-time account
                        verification process. <br> Below is your One-Time Passcode (OTP) :

                        <span style="font-weight: 600; color: #1f1f1f;"></span>

                    </p>
                    <p style="
                margin: 0;
                margin-top: 60px;
                font-size: 40px;
                font-weight: 600;
                letter-spacing: 25px;
                color: #ba3d4f;
              ">
                        {{$otp}}
                    </p>
                </div>
            </div>

            <p style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #8c8c8c;
          ">
                Need help? Ask at
                <a href="mailto:archisketch@gmail.com"
                    style="color: #f2c343; text-decoration: none;">info@jawraa.com</a>
                <br> or visit our
                <a href="" target="_blank" style="color: #f2c343; text-decoration: none;">JAAR website</a>
            </p>
        </main>

        <footer style="
          width: 100%;
          max-width: 490px;
          margin: 20px auto 0;
          text-align: center;
          border-top: 1px solid #e6ebf1;
        ">
            <p style="
            margin: 0;
            margin-top: 40px;
            font-size: 16px;
            font-weight: 600;
            color: #8c8c8c;
          ">
                JAWRAA | Apple Authorized Reseller
            </p>
            <p style="margin: 0; margin-top: 8px; color: #8c8c8c;">
                Al-Imam Abdur Rahaman Bin Faisal, Al-Khuzama District 12572 – 8220 Riyadh, Saudi Arabia
            </p>
            <div style="margin: 0 auto; margin-top: 16px; ">
                <a href="" target="_blank" style="display: inline-block;">
                    <!-- <img -->
                    <!-- width="36px" -->
                    <!-- alt="Facebook" -->
                    <!-- src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661502815169_682499/email-template-icon-facebook" -->
                    <!-- /> -->
                    <!-- </a> -->
                    <!-- <a
            href=""
            target="_blank"
            style="display: inline-block; margin-left: 8px;"
          >
            <img
              width="36px"
              alt="Instagram"

              <img src="https://alexondev.net/images/images/email-template-icon-instagram.png">
        </a>
          <a
            href=""
            target="_blank"
            style="display: inline-block; margin-left: 8px;"
          >
            <img
              width="36px"
              alt="Twitter"
              <img src="https://alexondev.net/images/images/email-template-icon-twitter.png">

          </a>
          <a
            href=""
            target="_blank"
            style="display: inline-block; margin-left: 8px;"
          >
            <img
              width="36px"
              alt="Youtube"

              <img src="https://alexondev.net/images/images/email-template-icon-youtube.png">
          </a>
        </div> -->
                    <p style="margin: 0; margin-top: 16px; color: #8c8c8c;">
                        Copyright © 2024 JAAR. All rights reserved.
                    </p>
        </footer>
    </div>
</body>

</html>
