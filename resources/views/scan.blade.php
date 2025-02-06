

<h2 class="text-2xl font-medium text-center">Generated QR Codes</h2>
@foreach ($qrcodes as $qr)
    <div class="p-4 border rounded">
        <p><strong>Project:</strong> {{ $qr->project_name }}</p>
        <a href="{{ route('qrcode.show', $qr->id) }}">
            <img src="{{ asset('storage/qrcodes/1738760595.svg') }}" alt="QR Code">

        </a>
    </div>
@endforeach

