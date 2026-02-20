<!DOCTYPE html>
<html>
<body style="font-family: Arial; background:#f4f6f8; padding:25px;">

<table width="600" align="center" style="background:#ffffff; padding:20px; border-radius:8px;">
<tr><td>

<h3 style="margin-top:0;">Pemberitahuan Finalisasi Karya</h3>
<hr>

<p>Assalamu’alaikum warahmatullahi warahmatullahi wabarakatuh,</p>

<p>
Dengan hormat, melalui email ini kami menyampaikan status finalisasi karya yang telah Anda ajukan.
</p>

<p><strong>Judul Karya:</strong></p>

<div style="background:#f8f9fa; padding:10px; border-radius:6px; border:1px solid #ddd;">
    {{ $judul }}
</div>

<p style="margin-top:15px;"><strong>Status:</strong></p>

<div style="padding:10px; border-radius:6px; border:1px solid #999;">
    {{ strtoupper($status) }}
</div>

@if($catatan)
<p style="margin-top:15px;"><strong>Catatan:</strong></p>

<div style="background:#fff6e6; padding:10px; border-radius:6px; border:1px solid #f0c36d;">
    {{ $catatan }}
</div>
@endif

<p style="margin-top:20px;">
Demikian kami sampaikan. Terima kasih atas kerja sama Saudara.
</p>

<p>Wassalamu’alaikum warahmatullahi wabarakatuh.</p>

<hr>
<p style="font-size:12px; color:#777;">
Email ini dikirim otomatis oleh sistem, mohon tidak membalas email ini.
</p>

</td></tr></table>

</body>
</html>
