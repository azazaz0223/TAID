@extends('backend.layout.layout')

@section('container')
<!-- 麵包屑 Breadcrumb -->
<nav class="" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
        <li class="breadcrumb-item">前台設定</li>
        <li class="breadcrumb-item col">最新消息</li>
    </ol>
</nav>
<div class="container-fluid p-3 m-1">

    <div class="card col-12 rounded-3 bg-white mb-4">
        <h2 class="fs-5 p-3 fw-bold border-bottom">最新消息編輯</h2>

        <form id="update">
            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto">
                        <div class="dive_sub">消息標題</div>
                    </div>
                    <div class="col">
                        <input type="text" name="title" id="title" class="form-control" placeholder="請輸入標題"
                            value="{{ $news->title }}">
                    </div>
                </div>
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">內文描述</div>
                    </div>
                    <div class="col">
                        <textarea name="content" id="content1" class="form-control search_input easein mb-0" rows="2"
                            placeholder="請輸入內文描述">{{ $news->content }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom d-flex justify-content-between gap-3">
                <div class="col-4 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">上傳最新消息圖</label>
                    <div class="c-mainCard__item">
                        <div class="l-upload l-upload--notSpace">
                            <div class="card-body fs-6 gray_l rounded-3">
                                <input type="file" name="image" id="news" onchange="reviewImage(this)"
                                    class="form-control search_input product-hover easein">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">預覽最新消息圖</label>
                    <div class="p-0">
                        <img id="newsImg" class="mt-3" src="{{ asset($news->image) }}">
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">內文文字</div>
                    </div>
                    <div class="col">
                        <textarea name="content_text" class="form-control search_input easein mb-0" rows="2"
                            placeholder="請輸入內文文字">{{ $news->content_text }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom d-flex justify-content-between gap-3">
                <div class="col-4 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">上傳項目內容圖</label>
                    <div class="c-mainCard__item">
                        <div class="l-upload l-upload--notSpace">
                            <div class="card-body fs-6 gray_l rounded-3">
                                <input type="file" name="content_image" id="newsContent" onchange="reviewImage(this)"
                                    class="form-control search_input product-hover easein">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">預覽項目內容圖</label>
                    <div class="p-0">
                        <img id="newsContentImg" class="mt-3" src="{{ asset($news->content_image) }}">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">
            <button type="button" onclick="updateBtn({{ $news->id }})"
                class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2">確認修改</button>
            <a href="{{ route('backend.news.index') }}"
                class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2">返回列表</a>
        </div>
    </div>
</div>

<script>
    function reviewImage(element) {
        if(element.files && element.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + element.id + "Img").attr('src', e.target.result);
            }
            reader.readAsDataURL(element.files[0]);
        }
    }

    function updateBtn(id) {
        url = "{{ route('backend.news.update', ':id') }}";
        url = url.replace(':id', id);

        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let data = new FormData($('#update')[0]);
        data.append('_method','PATCH');

        for (var pair of data.entries()) {
            switch (pair[0]) {
                case 'title':
                    if (pair[1] == '') {
                        $("#alert_text").text('請輸入標題!');
                        $("#alert").modal("show");                 
                        return
                    }
                case 'content':
                    if (pair[1] == '') {
                        $("#alert_text").text('請輸入內容!');
                        $("#alert").modal("show");                 
                        return
                    }
                case 'content_text':
                    if (pair[1] == '') {
                        $("#alert_text").text('請輸入內文內容!');
                        $("#alert").modal("show");                 
                        return
                    }
            }
        }; 

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == '00') {
                    $("#alert_text").text("修改成功");
                    $("#alert").modal("show");
                };
            },
            error: function(xhr, status, error) {
                let alert_text = "發生不可預期的錯誤";

                if (xhr.status == '403') {
                    alert_text = "無此權限";
                }
                $("#alert_text").text(alert_text);
                $("#alert").modal("show");
            }
        });
    }
</script>
@endsection