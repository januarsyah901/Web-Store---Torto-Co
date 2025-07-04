@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">About US</h2>
            </div>

            <div class="about-us__content pb-5 mb-5">
                <p class="mb-5">
                    <img loading="lazy" class="w-100 h-auto d-block" src="{{asset("assets/images/about/about-header.png") }}" width="1410"
                         height="550" alt="" />
                </p>
                <div class="mw-930">
                    <h3 class="mb-4">OUR STORY</h3>
                       <p class="fs-6 fw-medium mb-4">
                           Torto adalah brand fashion lokal yang ingin membawa pesan kuat: “Pelan bukan berarti tertinggal”. Bukan sekedar menjual kaos. Torto hadir sebagai simbol perjuangan anak muda, mahasiswa, dan siapa pun yang sedang berjalan pelan tapi pasti menuju impian.
                       </p>
                       <p class="mb-4">
                           Setelah melalui proses panjang, 180 kaos batch pertama telah selesai di produksi, ini bukan sekedar produk, ini adalah cerita. Oleh karena itu, peluncuran tidak bisa dilakukan biasa-biasa saja. Harus emosional, terencana, dan meninggalkan kesan.
                       </p>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="mb-3">Our Mission</h5>
                            <ul class="mb-3">
                                <li>Menghadirkan pakaian yang nyaman, tahan lama, dan bermakna, seperti filosofi kura-kura: tenang, tangguh, dan setia dalam perjalanan panjang.</li>
                                <li>Mendorong semangat konsistensi dan ketekunan bagi mahasiswa dan anak muda melalui desain yang inspiratif dan tidak ikut-ikutan tren cepat (anti fast fashion).</li>
                                <li>Menjadi simbol kepercayaan diri dan perlindungan diri, dengan produk yang bukan hanya enak dipakai, tapi juga bikin pemakainya merasa aman dan punya karakter.</li>
                                <li>Membangun komunitas anak muda yang sadar arah dan tujuan, lewat konten, kolaborasi, dan kampanye yang sejalan dengan nilai-nilai Torto.</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Our Vision</h5>
                            <p class="mb-3">Menjadi brand pakaian lokal yang konsisten mendampingi perjalanan generasi muda Indonesia, dengan semangat ketekunan, kenyamanan, dan ketahanan — karena lambat bukan berarti tertinggal.</p>
                        </div>
                    </div>
                </div>
                <div class="mw-930 d-lg-flex align-items-lg-center">
                    <div class="image-wrapper col-lg-6">
                        <img class="h-auto" loading="lazy" src="{{asset("assets/images/about/about-header.png") }}" width="450" height="500" alt="">
                    </div>
                    <div class="content-wrapper col-lg-6 px-lg-4">
                        <h5 class="mb-3">The Company</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet sapien dignissim a elementum. Sociis metus,
                            hendrerit mauris id in. Quis sit sit ultrices tincidunt euismod luctus diam. Turpis sodales orci etiam
                            phasellus lacus id leo. Amet turpis nunc, nulla massa est viverra interdum. Praesent auctor nulla morbi
                            non posuere mattis. Arcu eu id maecenas cras.</p>
                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection
