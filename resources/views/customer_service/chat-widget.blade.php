<style>
    .tombol-chat {
        position: fixed;
        right: 20px;
        bottom: 20px;
        padding: 10px 15px;
        border: 1px solid black;
        background-color: white;
        cursor: pointer;
        z-index: 999;
    }

    .kotak-chat {
        position: fixed;
        right: 20px;
        bottom: 70px;
        width: 320px;
        border: 1px solid black;
        background-color: white;
        display: none;
        z-index: 999;
        font-family: Arial, sans-serif;
    }

    .judul-chat {
        padding: 10px;
        border-bottom: 1px solid black;
        background-color: #eeeeee;
        font-weight: bold;
    }

    .tutup-chat {
        float: right;
        cursor: pointer;
    }

    .isi-chat {
        padding: 10px;
        max-height: 400px;
        overflow-y: auto;
    }

    .pesan-chat {
        border: 1px solid #cccccc;
        padding: 8px;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .pesan-admin {
        background-color: #f5f5f5;
    }

    .pesan-pengguna {
        background-color: #ffffff;
        text-align: right;
    }

    .tombol-pertanyaan {
        display: block;
        width: 100%;
        margin-bottom: 7px;
        padding: 7px;
        border: 1px solid #999999;
        background-color: white;
        text-align: left;
        cursor: pointer;
    }
</style>

<button class="tombol-chat" onclick="bukaTutupChat()">Chat</button>

<div class="kotak-chat" id="kotakChat">
    <div class="judul-chat">
        Customer Service
        <span class="tutup-chat" onclick="bukaTutupChat()">X</span>
    </div>

    <div class="isi-chat" id="isiChat">
        <div class="pesan-chat pesan-admin">
            Halo kak, silakan pilih pertanyaan.
        </div>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('cara_pembayaran')">
            Cara pembayarannya bisa apa saja?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('tiket_habis')">
            Kalau tiket sudah habis, apakah ada stok lagi?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('jadwal_konser')">
            Bagaimana cara melihat jadwal konser?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('tiket_digital')">
            Apakah tiket berbentuk digital?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('refund')">
            Apakah tiket bisa refund?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('ubah_data')">
            Apakah data pembeli bisa diubah?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('jam_open_gate')">
            Open gate biasanya jam berapa?
        </button>

        <button class="tombol-pertanyaan" onclick="kirimPertanyaan('bukti_pembayaran')">
            Apakah bukti pembayaran harus disimpan?
        </button>
    </div>
</div>

<script>
    function bukaTutupChat() {
        const kotakChat = document.getElementById('kotakChat');

        if (kotakChat.style.display === 'block') {
            kotakChat.style.display = 'none';
        } else {
            kotakChat.style.display = 'block';
        }
    }

    function kirimPertanyaan(jenisPertanyaan) {
        const isiChat = document.getElementById('isiChat');

        const daftarJawaban = {
            cara_pembayaran: {
                pertanyaan: 'Cara pembayarannya bisa apa saja?',
                jawaban: 'Pembayaran bisa dilakukan melalui transfer bank, e-wallet, atau metode pembayaran yang tersedia pada halaman booking.'
            },
            tiket_habis: {
                pertanyaan: 'Kalau tiket sudah habis, apakah ada stok lagi?',
                jawaban: 'Maaf kak, jika tiket sudah habis maka statusnya sudah sold out.'
            },
            jadwal_konser: {
                pertanyaan: 'Bagaimana cara melihat jadwal konser?',
                jawaban: 'Jadwal konser bisa dilihat pada halaman schedule.'
            },
            tiket_digital: {
                pertanyaan: 'Apakah tiket berbentuk digital?',
                jawaban: 'Iya kak, tiket tersedia dalam bentuk digital setelah proses booking berhasil.'
            },
            refund: {
                pertanyaan: 'Apakah tiket bisa refund?',
                jawaban: 'Tiket yang sudah dibeli tidak bisa refund, kecuali konser dibatalkan oleh pihak penyelenggara.'
            },
            ubah_data: {
                pertanyaan: 'Apakah data pembeli bisa diubah?',
                jawaban: 'Data pembeli hanya bisa diubah sebelum booking dikonfirmasi.'
            },
            jam_open_gate: {
                pertanyaan: 'Open gate biasanya jam berapa?',
                jawaban: 'Open gate biasanya dimulai 1 sampai 2 jam sebelum konser.'
            },
            bukti_pembayaran: {
                pertanyaan: 'Apakah bukti pembayaran harus disimpan?',
                jawaban: 'Iya kak, bukti pembayaran sebaiknya disimpan untuk verifikasi.'
            }
        };

        const pesanPengguna = document.createElement('div');
        pesanPengguna.className = 'pesan-chat pesan-pengguna';
        pesanPengguna.innerText = daftarJawaban[jenisPertanyaan].pertanyaan;

        const pesanAdmin = document.createElement('div');
        pesanAdmin.className = 'pesan-chat pesan-admin';
        pesanAdmin.innerText = daftarJawaban[jenisPertanyaan].jawaban;

        isiChat.appendChild(pesanPengguna);
        isiChat.appendChild(pesanAdmin);

        isiChat.scrollTop = isiChat.scrollHeight;
    }
</script>