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
            <td style="width: 65%; vertical-align: top; padding: 10px; text-align: left"><div style="font-family: dmsans; font-size: 45px; margin:0px; padding:0px; line-height: 40px;">{{ $dataDetail->lastname }}</div><div style="font-family: dmsansblack; font-size: 50px; margin:0px; padding:0px; line-height: 45px;">{{ $dataDetail->firstname }}</div><div style="font-size: 18px; color: #787878;">{{ $dataDetail->designation }}</div>
            </td>
            <td style="width: 35%;">
                <br>
                <br>
                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 40px; padding:40px">
                    @if($dataDetail->address)
                        <tr>
                            <td style="vertical-align: top; width: 15%; text-align: center;">
                                <span style="font-family: fab; font-size: 12px;">&#xf3c5;</span>
                            </td>
                            <td style="width: 85%; text-align: left; padding-bottom: 3px;">{{ $dataDetail->address }}</td>
                        </tr>                        
                    @endif
                    @if($dataDetail->mobile)
                        <tr>
                            <td style="vertical-align: top; width: 15%; text-align: center;">
                                <span style="font-family: fab; font-size: 12px;">&#xf095;</span>
                            </td>
                            <td style="width: 85%; text-align: left; padding-bottom: 3px;">{{ $dataDetail->mobile }}</td>
                        </tr>                        
                    @endif
                    @if($dataDetail->email)
                        <tr>
                            <td style="vertical-align: top; width: 15%; text-align: center;">
                                <span style="font-family: fab; font-size: 12px;">&#xf0e0;</span>
                            </td>
                            <td style="width: 85%; text-align: left; padding-bottom: 3px;"><a href="mailto:{{ $dataDetail->email }}" style="color: inherit; text-decoration: none;">{{ $dataDetail->email }}</a></td>
                        </tr>                        
                    @endif
                    @if($dataDetail->website)
                        <tr>
                            <td style="vertical-align: top; width: 15%; text-align: center;">
                                <span style="font-family: fab; font-size: 12px;">&#xf0ac;</span>
                            </td>
                            <td style="width: 85%; text-align: left; padding-bottom: 3px;"><a href="{{ $dataDetail->website }}" style="color: inherit; text-decoration: none;">{{ $dataDetail->website }}</a></td>
                        </tr>                        
                    @endif
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
                        <td><img src="{{ public_path('images/resume/'.$dataDetail->image) }}" alt="Profile Image" style="width: 180px; border-radius: 12px; object-fit: cover;"></td>
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
                            @foreach ($dataDetail->skills as $item)
                                <table nobr="true">
                                    <tr>
                                        <td style="width: 10px"><span style="line-height:5px; vertical-align: middle; font-family: fab; font-size: 6px;">&#x2192;</span></td>
                                        <td style="width: 90px"><span style="font-size: 10px; line-height: 12px; margin:0px; padding:0px;">{{ $item->name }}</span></td>
                                    </tr>
                                </table>
                            @endforeach
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
                            @foreach ($dataDetail->educations as $item)
                                <table nobr="true">
                                    <tr>
                                        <td><b style="font-size: 12px; line-height: 14px; margin:0px; padding:0px;">{{ $item->title }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><p style="color: rgb(98, 98, 98); font-size: 12px; line-height: 14px; margin:0px; padding:0px;">{{ $item->place }}</p></td>
                                    </tr>
                                    <tr>
                                        <td><p style="color: rgb(138, 138, 138); font-size: 10px; line-height: 12px; margin:0px; padding:0px;">{{ $item->start_month }} {{ $item->start_year }} - {{ $item->end_month }} {{ $item->end_year }}</p></td>
                                    </tr>
                                    <tr><td colspan="X" height="10" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                                </table>
                            @endforeach
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
                        <td><p style="color: rgb(49, 49, 49);">{{ $dataDetail->about }}</p></td>
                    </tr>
                    <tr><td colspan="X" height="25" style="line-height:25px; font-size:1px;">&nbsp;</td></tr>
                </table>                
                <div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td><b style="font-size: 18px; font-family: dmsansblack;">EXPERIENCES</b></td>
                        </tr>
                        <tr><td colspan="X" height="20" style="line-height:20px; font-size:1px;">&nbsp;</td></tr>
                        @foreach ($dataDetail->experiences as $item)
                            <table nobr="true" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><b style="font-size: 15px; line-height: 17px;">{{ $item->title }} | {{ $item->start_year }}-{{ $item->end_year }}</b></td>
                                </tr>
                                <tr>
                                    <td><span style="color: rgb(98, 98, 98); font-size: 15px; line-height: 25px;">{{ $item->place }} | {{ $item->city }}</span></td>
                                </tr>
                                <tr>
                                    <td><p style="color: rgb(49, 49, 49);">{{ $item->experience }}</p></td>
                                </tr>
                                <tr><td colspan="X" height="10" style="line-height:15px; font-size:1px;">&nbsp;</td></tr>
                            </table>
                        @endforeach
                    </table>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
