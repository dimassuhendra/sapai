<footer class="floating-footer themed-footer">
    <div class="container-fluid">
        <div class="footer-content">
            <div class="footer-left">
                <span class="copyright-text text-white-50">
                    Copyright &copy; 2026 <strong class="text-white">SAPAI.ID</strong> | Les Privat Lampung
                </span>
            </div>

            <div class="footer-center d-none d-md-flex">
                <a href="#" class="contact-link-light wa" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="contact-link-light ig" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="contact-link-light mail" title="Email"><i class="far fa-envelope"></i></a>
            </div>

            <div class="footer-right small">
                <a href="#" class="footer-link-light">Privacy Policy</a>
                <span class="mx-1 text-white-50">&middot;</span>
                <a href="#" class="footer-link-light">Terms</a>
            </div>
        </div>

        <div class="footer-center-mobile d-md-none mt-3">
            <a href="#" class="contact-link-light wa"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="contact-link-light ig"><i class="fab fa-instagram"></i></a>
            <a href="#" class="contact-link-light mail"><i class="far fa-envelope"></i></a>
        </div>
    </div>
</footer>

<style>
    .floating-footer.themed-footer {
        margin: 20px 25px 25px 25px;
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 15px 25px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 -10px 30px rgba(33, 147, 176, 0.1);
        font-family: 'Fredoka', sans-serif;
        margin-top: auto;
        /* Memastikan footer terdorong ke bawah */
    }

    .footer-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .copyright-text {
        font-size: 0.85rem;
    }

    /* KONTAK LIGHT STYLE */
    .footer-center,
    .footer-center-mobile {
        display: flex;
        gap: 12px;
        justify-content: center;
        /* Memastikan ikon rata tengah di HP */
        width: 100%;
    }

    .contact-link-light {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact-link-light:hover {
        background: white;
        color: #2193b0;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .footer-link-light {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: 0.2s;
    }

    .footer-link-light:hover {
        color: white;
    }

    @media (max-width: 768px) {
        .floating-footer.themed-footer {
            margin: 15px;
            text-align: center;
        }

        .footer-content {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    }
</style>