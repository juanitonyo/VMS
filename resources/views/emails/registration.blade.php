@include('emails.header')
<div>
    <p>Screenshot this message or save this QR code and present it to the front-desk or guard-on-duty upon check-in and
        checkout.</p>
</div>
<div>
    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $mailData['refCode'] }}&size=200x200" width="240px"
        height="240px">
    <p style="font-size: 14px; font-style: bold;">{{ $mailData['refCode'] }}</p>
</div>
<div>
    <table>
        <tbody>
            <tr>
                <td>
                    <p style="margin: 0">Visitor Name: {{ $mailData['name'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0">Contact Number: {{ $mailData['contact'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0">Purpose of Visit: ???</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0">Time of Visit: {{ $mailData['checkedIn'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@include('emails.footer')
