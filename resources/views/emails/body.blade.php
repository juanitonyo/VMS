@include('emails.header')
<div>
    <p>Screenshot this message or save this QR code and present it to the front-desk or guard-on-duty upon check-in and
        checkout.</p>
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
                <td>
                    <p style="margin: 0">Purpose of Visit: {{ $mailData['visit_type'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0">Time of Visit: {{ $mailData['checked_in'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@include('emails.footer')