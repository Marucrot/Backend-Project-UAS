<h1>Homepage Sistem Konser</h1>

<p>Tiket Konser</p>
<hr>
<h3>Akun Pengguna</h3>
<ul>
    <li><a href="{{ route('pengguna.login') }}">Login</a></li>
    <li><a href="{{ route('pengguna.register') }}">Register</a></li>
</ul>
<hr>
<h3>Menu Utama</h3>
<ul>
    <li><a href="{{ route('schedule.index') }}">Lihat Schedule Konser</a></li>
    <li><a href="{{ route('tickets.index') }}">Lihat Tiket</a></li>
    <li><a href="{{ route('booking.index') }}">Booking Tiket</a></li>
    <li><a href="{{ route('riwayat.index') }}">Riwayat Pemesanan</a></li>
</ul>

@include('customer_service.chat-widget')