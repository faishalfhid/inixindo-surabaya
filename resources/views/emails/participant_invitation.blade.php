
<p>Halo {{ $participant->name }},</p>

<p>Anda diundang untuk mengonfirmasi kehadiran pada pelatihan: <strong>{{ $participant->training->materials ?? 'Pelatihan' }}</strong>

<p>Silakan klik link berikut untuk melengkapi data diri dan mengonfirmasi:</p>

<p><a href="{{ $url }}">{{ $url }}</a></p>

<p>Terima kasih.</p>
