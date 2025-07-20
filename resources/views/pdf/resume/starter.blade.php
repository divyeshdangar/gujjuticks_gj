<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-size: 10px;
        }
    </style>
</head>

<body>

    <table style="font-family: dmsans;" width="100%" cellpadding="4" cellspacing="4">
        <tr>
            <td style="width: 65%; vertical-align: top; padding: 10px; text-align: left"><div style="font-family: dmsans; font-size: 45px; margin:0px; padding:0px; line-height: 40px;">DANGAR</div><div style="font-family: dmsansblack; font-size: 50px; margin:0px; padding:0px; line-height: 45px;">DIVYESH</div><div style="font-size: 18px; color: #787878;">Senior Software Engineer</div>
            </td>
            <td style="width: 35%;">
                <br>
                <br>
                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 40px; padding:40px">
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fab; font-size: 12px;">&#xf3c5;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">Market street 1, New York, 12341 United States</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fab; font-size: 12px;">&#xf095;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;">+(000) 123-45678</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fab; font-size: 12px;">&#xf0e0;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;"><a href="mailto:yourinfo@example.com" style="color: inherit; text-decoration: none;">YourInfo@example.com</a></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 15%; text-align: center;">
                            <span style="font-family: fab; font-size: 12px;">&#xf0ac;</span>
                        </td>
                        <td style="width: 85%; text-align: left; padding-bottom: 3px;"><a href="https://www.youtube.com" style="color: inherit; text-decoration: none;">www.yourweb.com</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br><br>

    <table style="font-family: dmsans;" width="100%" cellpadding="4" cellspacing="4">
        <tr>
            <td style="width: 30%; vertical-align: top; padding: 20px;">
                <table nobr="true" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><img src="{{ public_path('images/pdf/resume/starter/profile.jpeg') }}" alt="Profile Image" style="width: 180px; border-radius: 12px; object-fit: cover;"></td>
                    </tr>
                    <tr><td colspan="X" height="10" style="line-height:20px; font-size:1px;">&nbsp;</td></tr>
                </table>

                <table nobr="true">
                    <tr>
                        <td>
                            <div>
                                <b style="font-size: 18px; font-family: dmsansblack;">SKILLS</b>
                            </div>
                        </td>
                    </tr>
                    <tr><td colspan="X" height="10" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                    <tr>
                        <td>
                            @for ($i = 0; $i < 5; $i++)
                                <table nobr="true">
                                    <tr>
                                        <td style="width: 10px"><span style="line-height:5px; vertical-align: middle; font-family: fab; font-size: 6px;">&#x2192;</span></td>
                                        <td style="width: 90px"><span style="font-size: 10px; line-height: 12px; margin:0px; padding:0px;">Adobe Photoshop CC</span></td>
                                    </tr>
                                </table>
                            @endfor
                        </td>
                    </tr>
                    <tr><td colspan="X" height="15" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                </table>

                <table nobr="true">
                    <tr>
                        <td>
                            <div>
                                <b style="font-size: 18px; font-family: dmsansblack;">EDUCATION</b>
                            </div>
                        </td>
                    </tr>
                    <tr><td colspan="X" height="10" style="line-height:20px; font-size:1px;">&nbsp;</td></tr>
                    <tr>
                        <td>
                            @for ($i = 0; $i < 5; $i++)
                            <table nobr="true">
                                <tr>
                                    <td><b style="font-size: 12px; line-height: 14px; margin:0px; padding:0px;">Master Computer Application (MCA)</b></td>
                                </tr>
                                <tr>
                                    <td><p style="color: rgb(98, 98, 98); font-size: 12px; line-height: 14px; margin:0px; padding:0px;">Your University Name Here Like GU</p></td>
                                </tr>
                                <tr>
                                    <td><p style="color: rgb(138, 138, 138); font-size: 10px; line-height: 12px; margin:0px; padding:0px;">JAN 18 - MAR 22</p></td>
                                </tr>
                                <tr><td colspan="X" height="10" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                            </table>
                            @endfor
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 70%;">
                <table nobr="true" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><b style="font-size: 18px; font-family: dmsansblack;">ABOUT ME</b></td>
                    </tr>
                    <tr><td colspan="X" height="10" style="line-height:20px; font-size:1px;">&nbsp;</td></tr>
                    <tr>
                        <td><p style="color: rgb(49, 49, 49);">I am a motivated and detail-oriented professional with a passion for learning and growth. With a strong background in problem-solving and teamwork, I thrive in dynamic environments. I value clear communication and consistently aim to exceed expectations in every project. My goal is to contribute meaningfully while continuing to evolve personally and professionally.</p></td>
                    </tr>
                    <tr><td colspan="X" height="25" style="line-height:25px; font-size:1px;">&nbsp;</td></tr>
                </table>                
                <div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td><b style="font-size: 18px; font-family: dmsansblack;">EXPERIENCES</b></td>
                        </tr>
                        <tr><td colspan="X" height="20" style="line-height:20px; font-size:1px;">&nbsp;</td></tr>
                        @for($i = 0; $i < 10; $i++)
                        <table nobr="true" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><b style="font-size: 15px; line-height: 17px;">ENTER JOB POSITION | 2014-2016</b></td>
                            </tr>
                            <tr>
                                <td><span style="color: rgb(98, 98, 98); font-size: 15px; line-height: 25px;">Barde as Software | New York City</span></td>
                            </tr>
                            <tr>
                                <td><p style="color: rgb(49, 49, 49);">I am a motivated and detail-oriented professional with a passion for learning and growth. With a strong background in problem-solving and teamwork, I thrive in dynamic environments. I value clear communication and consistently aim to exceed expectations in every project. My goal is to contribute meaningfully while continuing to evolve personally and professionally.</p></td>
                            </tr>
                            <tr><td colspan="X" height="10" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                        </table>
                        @endfor
                    </table>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
