
<p>Halo {{ $participant->name }},</p>

<p>Anda diundang untuk mengonfirmasi kehadiran pada pelatihan: <strong>{{ $participant->training->judul ?? 'Pelatihan' }}</strong></p>

<p>Silakan klik link berikut untuk melengkapi data diri dan mengonfirmasi:</p>

<p><a href="{{ $url }}">{{ $url }}</a></p>

<p>Terima kasih.</p>
