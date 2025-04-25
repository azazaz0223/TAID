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
        <h2 class="fs-5 p-3 fw-bold border-bottom">最新消息</h2>

        <form id="create">
            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto">
                        <div class="dive_sub">消息標題</div>
                    </div>
                    <div class="col">
                        <input type="text" name="title" class="form-control" placeholder="請輸入標題">
                    </div>
                </div>
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">內文描述</div>
                    </div>
                    <div class="col">
                        <textarea name="content" class="form-control search_input easein mb-0" rows="2"
                            placeholder="請輸入內文描述"></textarea>
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
                        <img id="newsImg" class="mt-3" src="{{ asset('images/backend/defaultImage.png') }}">
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
                            placeholder="請輸入內文文字"></textarea>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom d-flex justify-content-between gap-3">
                <div class="col-4 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">上傳最新消息內容圖</label>
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
                    <label class="mb-2">預覽最新消息內容圖</label>
                    <div class="p-0">
                        <img id="newsContentImg" class="mt-3" src="{{ asset('images/backend/defaultImage.png') }}">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">
            <button type="button" class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3"
                onclick="createBtn()">新增</button>
        </div>
    </div>


    <div class="card col-12 rounded-3 bg-white mb-4">
        <h2 class="fs-5 p-3 fw-bold border-bottom">最新消息列表</h2>

        <div class="card-body toScroll text-nowrap">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class=""></th>
                        <th>消息標題</th>
                        <th>消息內文描述</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($list as $news)
                    <tr>
                        <td>{{ $news->id }}</td>
                        <td>{{ $news->title }}</td>
                        <td class="ellipsis">{{ $news->content }}</td>
                        <td>
                            <button type="button" class="btn btn-light rounded-3 shadow-sm"
                                onclick="javascript:location.href='{{ route('backend.news.detail', $news->id) }}'"><i
                                    class="far fa-edit"></i></button>
                            <button type="button" onclick="deleteConfirmBtn({{ $news->id }})"
                                class="btn btn-light rounded-3 shadow-sm"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @empty(!$list)
            {{ $list->links('backend.pagination.pagination') }}
            @endempty
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

    function createBtn() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let data = new FormData($('#create')[0]);

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
                case 'image':
                    if (pair[1].size == "0") {
                        $("#alert_text").text('請選擇圖片!');
                        $("#alert").modal("show");                 
                        return
                    }
                case 'content_text':
                    if (pair[1] == '') {
                        $("#alert_text").text('請輸入內文內容!');
                        $("#alert").modal("show");                 
                        return
                    }
                case 'content_image':
                    if (pair[1].size == "0") {
                        $("#alert_text").text('請選擇內文圖片!');
                        $("#alert").modal("show");                 
                        return
                    }
            }
        }; 

        $.ajax({
            url: "{{ route('backend.news.create') }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.code == '00') {
                    $("#alert_text").text("新增成功");
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

    function deleteConfirmBtn(id) {
        html = "<button class='dialogue-btn shadow-sm btn btn-primary' onclick='deleteSubmit(" + id + ")'>確認</button>";
        html += "<button class='dialogue-btn shadow-sm btn btn-primary' data-bs-dismiss='modal'>關閉</button>";
        $("#alert-body").hide();
        $("#alertBtn").html(html);
        $("#alert").modal("show");
    }

    function deleteSubmit(id) {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        url = "{{ route('backend.news.delete', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            success: function(response) {
                if (response.code == '00') {
                    html = "<button type='button' class='dialogue-btn shadow-sm btn btn-primary' data-bs-dismiss='modal' onclick='location.reload()'>確認重整</button>";
                    html += "<button type='button' class='dialogue-btn shadow-sm btn btn-primary' data-bs-dismiss='modal'>關閉</button>";
                    $("#alertBtn").html(html);
                    $("#alert-body").show();
                    $("#alert_text").text("刪除成功!");
                    $("#alert").modal("show");
                }
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