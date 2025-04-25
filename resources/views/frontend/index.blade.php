<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('FRONTEND_NAME') }}</title>

    {{-- Bootstrap Core CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/bootstrap3.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/custom.css')}} ">

    {{-- Custom Fonts & Icons --}}
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/icomoon-social.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css') }}">

    <script src="{{ asset('js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>

    {{-- owl carousel css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('owl-carousel/assets/owl.carousel.min.css') }}">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/bootstrap.min.css') }}">

    {{-- Stylesheet --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/style-multipurpose.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/style-photogenic.css') }}">

    {{-- Responsive Stylesheet multipurpose --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/responsive-multipurpose.css') }}">
</head>

<body>
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="container nav-wrapper">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand d-flex align-items-center mt-lg-2" href="#">
                    <img src="{{ asset('images/logo.png')}}"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-easing="linear" href="#About">關於我們</a></li>
                    <li><a data-easing="linear" href="#News">最新消息</a></li>
                    <li><a data-easing="linear" href="#Product">服務項目</a></li>
                    <li><a data-easing="linear" href="#Contact">聯絡我們</a></li>
                    <li class="active"><a class="circle" data-easing="linear" href="#"><i class="icon-home"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- main-slider Start --}}
    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                @foreach ($data['carousels'] as $key => $carousel)
                <li data-target="#main-slider" data-slide-to="{{ $key }}" @if ($key==0) class="active" @endif></li>
                @endforeach
            </ol>

            <div class="carousel-inner">
                @foreach ($data['carousels'] as $key => $carousel)
                <div class="item @if ($key==0) active @endif"
                    style="background-image: url({{ asset($carousel->image) }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content centered">
                                    <h2 class="animation animated-item-1">{{ $carousel->title }}</h2>
                                    <p class="animation animated-item-2">{{ $carousel->subtitle }}</p>
                                    <label class="btn btn-md animation animated-item-3"
                                        onclick="carouselBtn({{ $carousel->id }})">More</label>
                                    <input type="hidden" id="carousel_title{{ $carousel->id }}"
                                        value="{{ $carousel->title }}">
                                    <input type="hidden" id="carousel_content{{ $carousel->id }}"
                                        value="{!! nl2br(e($carousel->content_text)) !!}">
                                    <input type="hidden" id="carousel_image{{ $carousel->id }}"
                                        value="{{ asset($carousel->content_image) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <a class="prev" href="#main-slider" data-slide="prev">
            <i class="icon-angle-left"></i>
        </a>

        <a class="next" href="#main-slider" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
    </section>
    {{-- main-slider End --}}

    <div id="About"></div>
    {{-- About Start --}}
    @foreach ($data['about'] as $about)
    <section class="trust">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-6">
                    <div class="title">
                        <h6 class="title-primary">about {{$about->en_title}}</h6>
                        <h1>{{$about->zh_title}}</h1>
                    </div>
                    <p>{{$about->content}}</p>
                </div>
                <div class="col-xl-5 gallery">
                    <div class="row no-gutters h-100">
                        <label class="w-50 h-100 gal-img" onclick="aboutBtn(1)">
                            <img class="img-fluid" src="{{ asset($about->image1) }}">
                            <i class="fas fa-ellipsis-h"></i>
                        </label>
                        <label class="w-50 h-50 gal-img" onclick="aboutBtn(2)" data-aos="fade-up" data-aos-delay="400"
                            data-aos-duration="600" for="modal-about">
                            <img class="img-fluid" src="{{ asset($about->image2) }}">
                            <i class="fas fa-ellipsis-h"></i>
                        </label>
                        <label class="w-50 h-50 gal-img gal-img3" onclick="aboutBtn(3)" data-aos="fade-up"
                            data-aos-delay="0" data-aos-duration="600" for="modal-about">
                            <img class="img-fluid" src="{{ asset($about->image3) }}">
                            <i class="fas fa-ellipsis-h"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="about_image1_image" value="{{ asset($about->image1_content_image) }}">
    <input type="hidden" id="about_image1_title" value="{{ $about->image1_title }}">
    <input type="hidden" id="about_image1_content" value="{!! nl2br(e($about->image1_content)) !!}">
    <input type="hidden" id="about_image2_image" value="{{ asset($about->image2_content_image) }}">
    <input type="hidden" id="about_image2_title" value="{{ $about->image2_title }}">
    <input type="hidden" id="about_image2_content" value="{!! nl2br(e($about->image2_content)) !!}">
    <input type="hidden" id="about_image3_image" value="{{ asset($about->image3_content_image) }}">
    <input type="hidden" id="about_image3_title" value="{{ $about->image3_title }}">
    <input type="hidden" id="about_image3_content" value="{!! nl2br(e($about->image3_content)) !!}">
    @endforeach
    {{-- About End --}}

    <div id="News"></div>
    {{-- News Start --}}
    <div class="container-fluid fh5co-news" id="news">
        <div class="container">
            <h2>最新消息 NEWS</h2>
            <div class="row">
                <div class="owl-carousel owl-carousel2 owl-theme">
                    @foreach ($data['news'] as $news)
                    <div>
                        <div class="card text-center"><img class="card-img-top" src="{{ $news->image }}">
                            <div class="card-body text-left pr-0 pl-0" onclick="newsBtn({{ $news->id }})">
                                <label class=" finger" for="modal-news">
                                    <h5 class="ellipsis1">{{ $news->title }}</h5>
                                </label>
                                <p class="card-text ellipsis3">{{ $news->content }}</p>
                                <label class="post-btn mgt5 finger"><i class=" fa fa-arrow-right"></i></label>
                                <input type="hidden" id="news_title{{ $news->id }}" value="{{ $news->title }}">
                                <input type="hidden" id="news_content{{ $news->id }}"
                                    value="{!! nl2br(e($news->content_text)) !!}">
                                <input type="hidden" id="news_image{{ $news->id }}"
                                    value="{{ asset($news->content_image) }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- News End --}}

    <div id="Product"></div>
    {{-- Porduct Start --}}
    <div class="section section-white container-fluid fh5co-news" style="background-color: #e9e0d7;">
        <div class="container">
            <h2>服務項目 SERVICE</h2>
            <div class="row">
                <ul class="grid cs-style-3">
                    @foreach ($data['products'] as $product)
                    <div class="col-xl-4 col-md-6 col-xs-6">
                        <figure>
                            <img src="{{ asset($product->image) }}">
                            <figcaption>
                                <h3 class="ellipsis1 col-10">{{ $product->title }}</h3>
                                <span>{{ $product->subtitle }}</span>
                                <label class="finger" onclick="productBtn({{ $product->id }})">MORE</label>
                            </figcaption>
                        </figure>
                    </div>
                    <input type="hidden" id="product_title{{ $product->id }}" value="{{ $product->title }}">
                    <input type="hidden" id="product_content{{ $product->id }}"
                        value="{!! nl2br(e($product->content)) !!}">
                    <input type="hidden" id="product_image{{ $product->id }}"
                        value="{{ asset($product->content_image) }}">
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    {{-- Porduct End --}}

    <div id="Contact"></div>
    {{-- Contact Start --}}
    <footer class="container-fluid fh5co-footer">
        <div class="container" id="contact">
            <div class="row">
                <div class="col-lg-5">
                    <h2>CONTACT US</h2>
                    <p class="light">歡迎您透過本信件表單詢問服務需求問題</p>
                    <p>
                        <span class="email">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <b><a href="mailto:r5201004@icloud.com">r5201004@icloud.com</a></b>
                    </p>
                    <p>
                        <span class="phone">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <b><a href="https://maps.app.goo.gl/KviWLTSnwgsnhsoB7" target="_blank">高雄市楠梓區青埔街208號2樓</a></b>
                    </p>

                    <ul class="navbar-nav float-left social-links footer-social">
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://www.facebook.com/lovevanessaya"><i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://line.me/R/ti/p/@zcf5783w"><i
                                    class="fab fa-line"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://www.instagram.com/huani.nail/"><i
                                    class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-7">
                    <div class="form-box">
                        <h4>歡迎您留言詢問服務需求與建議</h4>
                        <p>我們會盡快回覆您的問題，您的鼓勵是我們成長的動力！</p>
                        <hr />
                        <table class="table table-white table-borderless">
                            <div class="col-md-6 col-xs-12 p-2">
                                <input type="text" class="form-control" id="contactName" placeholder="姓名">
                            </div>
                            <div class="col-md-6 col-xs-12 p-2">
                                <input type="text" class="form-control" id="contactEmail" placeholder="Email">
                            </div>

                            <tr>
                                <td colspan="2" class="p-2">
                                    <textarea class="form-control" placeholder="服務需求" id="contactContent"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="p-2">
                                    <button type="button" class="read-more" onclick="createContactBtn()">送出</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    {{-- Contact End --}}

    {{-- Footer Start --}}
    <div class="container-fluid copy">
        <div class="col-lg-12">
            <p>花妮工作室版權所有 ©2024.</p>
        </div>
    </div>
    <div class="footer"></div>
    {{-- Footer End --}}

    <!--Start of Modal - slider -->
    <input class="modal-state" id="modal" type="checkbox">
    <div class="modal_1">
        <label class="modal__bg" for="modal"></label>
        <div class="modal__inner">
            <label class="modal__close" for="modal"></label>
            <h2 class="text-center" id="title"></h2>
            <img class="img-fluid img-roundedd" id="image"><br>
            <p id="content"></p>
        </div>
    </div>
    <!--End of Modal -->

    <script type="text/javascript" src="{{ asset ('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    {{-- photogenic - style js --}}
    <script type="text/javascript" src="{{ asset('owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/isotope-docs.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>


    {{-- smooth-scroll js --}}
    <script type="text/javascript" src="{{ asset('js/smooth-scroll.polyfills.min.js') }}"></script>
    <script>
        var scroll = new SmoothScroll('a[href*=""]:not([data-easing])');
        var linear = new SmoothScroll('[data-easing="linear"]', {easing: 'linear'});
    </script>

    {{-- Back To Top --}}
    <a href="javascript:void(0);" class="js-back-to-top back-to-top">Top</a>

    <script>
        function carouselBtn(id) {
            $("#title").text($("#carousel_title" + id).val());
            $("#image").prop("src", $("#carousel_image" + id).val());

            text = $("#carousel_content" + id).val();
            formattedText = text.replace(/\n/g, '<br />');
            $("#content").html(formattedText);

            $("#modal").prop("checked", true);
        }

        function aboutBtn(id) {
            $("#title").text($("#about_image" + id + "_title").val());
            $("#image").prop("src", $("#about_image" + id + "_image").val());

            text = $("#about_image" + id + "_content").val();
            formattedText = text.replace(/\n/g, '<br />');
            $("#content").html(formattedText);

            $("#modal").prop("checked", true);
        }

        function newsBtn(id) {
            $("#title").text($("#news_title" + id).val());
            $("#image").prop("src", $("#news_image" + id).val());

            text = $("#news_content" + id).val();
            formattedText = text.replace(/\n/g, '<br />');
            $("#content").html(formattedText);

            $("#modal").prop("checked", true);
        }

        function productBtn(id) {
            $("#title").text($("#product_title" + id).val());
            $("#image").prop("src", $("#product_image" + id).val());

            text = $("#product_content" + id).val();
            formattedText = text.replace(/\n/g, '<br />');
            $("#content").html(formattedText);

            $("#modal").prop("checked", true);
        }

        function createContactBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const data = {
                name: $("#contactName").val(),
                email: $("#contactEmail").val(),
                content: $("#contactContent").val()
            }

            $.ajax({
                url: "{{ route('frontend.createContact') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                success: function(response) {
                    if (response.code == '00') {
                        alert("成功!!");
                        location.reload();
                    };
                },
                error: function(xhr, status, error) {
                    let alert_text = "發生不可預期的錯誤";
                    alert(alert_text);
                }
            });
        }
    </script>
</body>

</html>