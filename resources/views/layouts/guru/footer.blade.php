<footer class="guru-footer">
    <div class="container-fluid">
        <div class="footer-grid">
            <div class="footer-left">
                <span class="text-white-50 small">
                    Copyright &copy; 2026 <strong class="text-white">SAPAI GURU</strong> | Panel Pengajar Terintegrasi
                </span>
            </div>

            <div class="footer-right d-flex gap-3 align-items-center">
                <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white-50 text-decoration-none small">Bantuan</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .guru-footer {
        /* Warna Hijau Guru */
        background: linear-gradient(135deg, #0d9488 0%, #10b981 100%);
        margin: auto 25px 25px 25px;
        /* Margin-top 'auto' sangat penting agar terdorong ke bawah */
        border-radius: 20px;
        padding: 18px 30px;
        box-shadow: 0 10px 30px rgba(13, 148, 136, 0.2);
        font-family: 'Fredoka', sans-serif;
    }

    .footer-grid {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .social-icon {
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-icon:hover {
        background: white;
        color: #0d9488;
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        .footer-grid {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
    }
</style>