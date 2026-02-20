<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color:#f4f6f8; padding: 30px;">

    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,.05); padding:25px;">
        <tr>
            <td align="center" style="padding-bottom: 10px;">
                <h2 style="margin:0; color:#2c3e50;">Pemberitahuan Status Verifikasi Judul Inovasi</h2>
                <p style="margin-top:6px; color:#7f8c8d;">Sistem Manajemen Terpadu & Inovasi</p>
                <hr style="border:none; border-top:1px solid #ecf0f1; margin-top:15px;">
            </td>
        </tr>

        <tr>
            <td>

                <p style="color:#2c3e50; margin-top:5px;">
                    Assalamu’alaikum warahmatullahi wabarakatuh,
                </p>

                <p style="color:#2c3e50;">
                    Dengan hormat,
                    melalui email ini kami menyampaikan informasi terkait hasil verifikasi judul karya tulis yang telah Anda ajukan.
                </p>

                <p style="margin-top:15px; color:#2c3e50;">Judul yang diajukan:</p>

                <div style="background:#f8f9fa; padding:12px 15px; border-radius:6px; border:1px solid #e1e4e8; font-weight:bold; color:#2c3e50;">
                    {{ $judul }}
                </div>

                <p style="margin-top:20px; color:#2c3e50;">Status verifikasi:</p>

                @if($status == 'disetujui')
                    <div style="padding:12px 15px; background:#e8f8f1; border:1px solid #27ae60; border-radius:6px; color:#166534; font-weight:bold;">
                        DITERIMA
                    </div>

                    <p style="margin-top:15px; color:#2c3e50;">
                        Judul yang Anda ajukan dinyatakan <strong>diterima</strong>.
                        Silakan melanjutkan ke tahap berikutnya sesuai prosedur yang berlaku.
                    </p>

                @elseif($status == 'ditolak')
                    <div style="padding:12px 15px; background:#fdecea; border:1px solid #c0392b; border-radius:6px; color:#7c1d1d; font-weight:bold;">
                        DITOLAK
                    </div>

                    <p style="margin-top:15px; color:#2c3e50;">
                        Dengan ini kami sampaikan bahwa judul yang Anda ajukan <strong>belum dapat diterima</strong>.
                        Mohon untuk melakukan perbaikan dan mengajukan kembali sesuai ketentuan.
                    </p>

                    @if(!empty($catatan))
                        <div style="margin-top:10px; background:#fff6e6; border:1px solid #f1c40f; padding:12px 15px; border-radius:6px; color:#8e6b00;">
                            <strong>Catatan:</strong><br>
                            {{ $catatan }}
                        </div>
                    @endif

                @else
                    <div style="padding:12px 15px; background:#eef2ff; border:1px solid #6366f1; border-radius:6px; color:#3730a3; font-weight:bold;">
                        MENUNGGU VERIFIKASI
                    </div>
                @endif

                <p style="margin-top:20px; color:#2c3e50;">
                    Demikian informasi ini kami sampaikan. Atas perhatian Anda kami ucapkan terima kasih.
                </p>

                <p style="color:#2c3e50;">
                    Wassalamu’alaikum warahmatullahi wabarakatuh.
                </p>

                <hr style="border:none; border-top:1px solid #ecf0f1; margin-top:15px;">

                <p style="margin-top:5px; color:#7f8c8d; font-size:12px;">
                    Email ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas email ini.
                </p>

                <p style="margin-top:2px; color:#95a5a6; font-size:12px;">
                    {{ config('app.name') }}
                </p>

            </td>
        </tr>
    </table>

</body>
</html>
