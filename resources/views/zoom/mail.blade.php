<p>Date: {{ $details['date'] ?? '' }}</p>
<p>Hello, 
    <br>
We will begin the Live class program about {{ $details['subject'] ?? '' }}. You are invited on {{ $details['start_time'] ?? '' }} in Zoom room. The purpose of my note today is to share some detail about what you can expect during our session.</p>
<p>Start Time : {{ $details['start_time'] ?? '' }}</p>
<p>Meeting Topic : {{ $details['meeting_title'] ?? '' }}</p>
<p>Meeting ID : {{ $details['meeting_id'] ?? '' }}</p>
<p>Meeting Contact Name : {{ $details['owner_id'] ?? '' }}</p>
<p>Invite URL : {{ $details['zoom_url'] ?? '' }}</p>
<br>
<br>
Thank you
