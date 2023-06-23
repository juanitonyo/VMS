@include('emails.header')
<table border="0" cellspacing="0" cellpadding="0"
    style="padding-bottom:20px;max-width:516px;min-width:220px">
    <tbody>
        <tr>
            <td style="width:8px">
                <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px"
                    align="center">
                    <h2 align="left">Hi there, <span style="font-size: 18px">{{ $mailData['name'] }}!</span></h2>
                </div>
                <div>
                    <p>Screenshot this message or save this QR code and present it to the front-desk or guard-on-duty upon check-in and checkout.</p>
                </div>
                <div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $mailData['ref_code'] }}&size=200x200" width="240px"
                            height="240px">
                    <p style="font-size: 14px; font-style: bold;">{{ $mailData['ref_code'] }}</p>
                </div>
                <div>
                    <table>
                        <tr>
                            <p style="margin: 0">Guest Name: {{ $mailData['name'] }}</p>
                        </tr>
                        <tr>
                            <p style="margin: 0">Mobile Number: {{ $mailData['contact'] }}</p>
                        </tr>
                        <tr>
                            <p style="margin: 0">Purpose of Visit: {{ $mailData['visit_type'] }}</p>
                        </tr>
                        <tr>
                            <p style="margin: 0">Time of Visit: {{ $mailData['checked_in'] }}</p>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>

@include('emails.footer')