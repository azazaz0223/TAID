{{-- fix_menu --}}
<div class="fix_menu shadow-sm" id="showpc">
    <div class="fix_menu_in">
        <div id="logo"><img src="{{ asset('images/logo.png') }}"></div>
    </div>
    <div class="list py-3">
        <ul id="accordion" class="accordion">
            <li>
                <a href="#" class="link"><span class="txt_color1 font15"><i class="fas fa-desktop"></i></span>
                    前台設定<div class="font10 txt_color6 float-end pe-1 me-2">▼</div></a>
                <ul class="submenu" style="display: block;">
                    <li><a href="{{ route('backend.logo.index') }}">LOGO設定</a></li>
                    <li><a href="{{ route('backend.carousel.index') }}">Banner設定</a></li>
                    <li><a href="{{ route('backend.about.index') }}">About TAID</a></li>
                    <li><a href="{{ route('backend.news.index') }}">最新消息</a></li>
                    <li><a href="{{ route('backend.product.index') }}">服務項目</a></li>
                    <li><a href="{{ route('backend.contact.index') }}">聯絡我們</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <i class="fas fa-file-invoice-dollar"></i>
</div>

<div class="clear"></div>
