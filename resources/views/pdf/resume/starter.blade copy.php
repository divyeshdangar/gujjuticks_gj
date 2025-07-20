<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            background-color: #d9d5a6;
            background-size: cover;
        }
        body {
            font-family: 'confidente';
            font-size: 16px;
            color: #2c3e50;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: #e74c3c;
        }

        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Custom Font PDF</h1>
    <img src="{{ public_path('images/pdf/resume/starter/profile.jpeg') }}" alt="Profile Image" style="width: 120px; height: 120px; border-radius: 60px; border: 2px solid #fff; object-fit: cover;">
    <p>
        This PDF uses the Confidente font located in <code>public/fonts/</code>. You can style the text using regular CSS, and the font will apply across the document.
    </p>
</body>
</html>









<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            background-color: #d9d5a6;
            background-size: cover;
        }

        body {
            background-color: #d9d5a6;
            /* font-family: 'confidente'; */
            font-size: 16px;
            color: #2c3e50;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: #e74c3c;
        }

        .rounded-box {
            background-color: #ecf0f1;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="width: 40%; vertical-align: top; text-align: center; background-color: #ffffff; padding:20px;">
                <img src="{{ public_path('images/pdf/resume/starter/profile.jpeg') }}" alt="Profile Image"
                    style="width: 120px; height: 120px; border-radius: 12px; border: 2px solid #fff; object-fit: cover;">
                <p>
                    This section is wrapped in a rounded corner block. You can use this for summaries,
                    highlights, or any important content. You can also style the border, background, etc.
                </p>
            </td>
            <td style="width: 60%; color: rgb(86, 79, 0); padding: 30px;">
                <h1>Divyesh Dangar</h1>
                <br>

                <h2>Q: Which are the popular new cars available in India in 2025?</h2>
                <p>Top 3 popular new cars available in India in 2025 are Toyota Urban Cruiser Hyryder, Mahindra Thar Roxx
                and Mahindra XUV 3XO. Check out all popular models.</p>
                <h2>Q: Which are popular cars brands in India?</h2>
                <p>Top 3 popular car brands in India are Toyota, Mahindra and Hyundai.</p>
                <h2>Q: Are there any upcoming cars in India?</h2>
                <p>Yes. There are upcoming cars in India. Top 3 upcoming cars which are going to launch soon in India are:
                MG M9 EV, Renault Triber 2025 and MG Cyberster. Check out all upcoming cars.</p>


                <h2>Q: Which are the popular new cars available in India in 2025?</h2>
                <p>Top 3 popular new cars available in India in 2025 are Toyota Urban Cruiser Hyryder, Mahindra Thar Roxx
                and Mahindra XUV 3XO. Check out all popular models.</p>
                <h2>Q: Which are popular cars brands in India?</h2>
                <p>Top 3 popular car brands in India are Toyota, Mahindra and Hyundai.</p>
                <h2>Q: Are there any upcoming cars in India?</h2>
                <p>Yes. There are upcoming cars in India. Top 3 upcoming cars which are going to launch soon in India are:
                MG M9 EV, Renault Triber 2025 and MG Cyberster. Check out all upcoming cars.</p>


            </td>

        </tr>
    </table>
</body>

</html>







<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
            background-size: cover;
        }

        body {
            background-color: #d9d5a6;
            /* font-family: 'confidente'; */
            color: #2c3e50;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="width: 65%; color: rgb(32, 32, 32); padding: 15px;">
                <div style="font-family: oswald_light; font-size: 45px;">DANGAR</div>
                <div style="font-family: oswald_bold; font-size: 50px;">DIVYESH</div>
                <br>
                <div style="font-size: 18px; color: #787878;">Senior Software Engineer</div>
            </td>
            <td style="width: 35%; text-align: center; padding:15px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fa; font-size: 16px;">&#xf3c5;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">
                            Market street 1, New York, 12341 United States
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fa; font-size: 16px;">&#xf095;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">
                            +(000) 123-45678
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fa; font-size: 16px;">&#xf0e0;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">
                            <a href="mailto:yourinfo@example.com" style="color: inherit; text-decoration: none;">YourInfo@example.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fa; font-size: 16px;">&#xf0ac;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">
                            <a href="https://www.youtube.com" style="color: inherit; text-decoration: none;">www.yourweb.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" cellpadding="0" cellspacing="0" autosize="1" nobr="false">
        <tr>
            <td style="color: rgb(49, 49, 49); width: 30%; vertical-align: top; text-align: left; padding:15px; page-break-inside: auto; page-break-after: auto;">
                
                {{-- Image --}}
                <img src="{{ public_path('images/pdf/resume/starter/profile.jpeg') }}" alt="Profile Image" style="width: 180px; border-radius: 12px; object-fit: cover;">
                <br><br>

                {{-- Skills --}}
                <b style="font-size: 18px;">SKILLS</b>
                <br><br>
                <ul>
                    <li>Adobe Photoshop CC</li>
                    <li>Adobe Illustrator CC</li>
                    <li>Adobe Indesign CC</li>
                    <li>Adobe Flash CC</li>
                    <li>HTML & CSS</li>
                    <li>Javascript & Jquery</li>
                    <li>Microsoft Office</li>
                </ul>
                <br><hr>


                {{-- Education --}}
                <b style="font-size: 18px;">EDUCATION</b>
                <br><br>

                @for($i = 0; $i < 2; $i++)
                    <b style="font-size: 15px;">ENTER YOUR DEGREE</b><br>
                    <p style="color: rgb(98, 98, 98); font-size: 15px;">Your University Name | New Delhi</p>
                    <p style="color: rgb(138, 138, 138); font-size: 15px;">JAN 18 - MAR 22</p>
                    <br>                    
                @endfor
                
                <b style="font-size: 15px;">ENTER YOUR DEGREE</b><br>
                <p style="color: rgb(98, 98, 98); font-size: 15px;">Your School Name | Ahmedabad</p>
                <p style="color: rgb(138, 138, 138); font-size: 15px;">MAR 22 - MAR 25</p>
                
                <br><hr>

            </td>
            <td style="width: 70%; vertical-align: top; color: rgb(32, 32, 32); padding: 15px; page-break-inside: auto; page-break-after: auto;">

                {{-- About Us --}}
                <b style="font-size: 18px;">ABOUT ME</b>
                <br><br>
                <p style="color: rgb(49, 49, 49);">
                    I am a motivated and detail-oriented professional with a passion for learning and growth. With a
                    strong background in problem-solving and teamwork, I thrive in dynamic environments. I value clear
                    communication and consistently aim to exceed expectations in every project. My goal is to contribute
                    meaningfully while continuing to evolve personally and professionally.
                </p><br>
                <hr>

                {{-- Experiences --}}
                <b style="font-size: 18px;">EXPERIENCES</b>
                <br><br>

                <b style="font-size: 15px;">ENTER JOB POSITION | 2014-2016</b><br>
                <p style="color: rgb(98, 98, 98); font-size: 15px;">Barde as Software | New York City</p>
                <p style="color: rgb(49, 49, 49);"><br>
                    I am a motivated and detail-oriented professional with a passion for learning and growth. With a
                    strong background in problem-solving and teamwork, I thrive in dynamic environments. I value clear
                    communication and consistently aim to exceed expectations in every project. My goal is to contribute
                    meaningfully while continuing to evolve personally and professionally.
                </p><br>

                <b style="font-size: 15px;">ENTER JOB POSITION | 2014-2016</b><br>
                <p style="color: rgb(98, 98, 98); font-size: 15px;">Barde as Software | New York City</p>
                <p style="color: rgb(49, 49, 49);"><br>
                    I am a motivated and detail-oriented professional with a passion for learning and growth. With a
                    strong background in problem-solving and teamwork, I thrive in dynamic environments. I value clear
                    communication and consistently aim to exceed expectations in every project. My goal is to contribute
                    meaningfully while continuing to evolve personally and professionally.
                </p><br>


                <hr>

            </td>
        </tr>
    </table>
</body>

</html>
