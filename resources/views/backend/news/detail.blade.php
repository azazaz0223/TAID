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
                            <div class="dive_sub">消息大標</div>
                        </div>
                        <div class="col">
                            <input type="text" name="title" class="form-control" placeholder="請輸入消息大標"
                                value="{{ $news->title }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">消息小標</div>
                        </div>
                        <div class="col">
                            <textarea name="subtitle" class="form-control search_input easein mb-0" rows="2" placeholder="請輸入消息副標">{{ $news->subtitle }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">排序</div>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="sort" min="0"
                                value="{{ $news->sort }}">
                        </div>
                        <div class="w-auto col-1">
                            <div class="dive_sub">上架設定</div>
                        </div>
                        <div class="col">
                            <select class="select form-control" name="status">
                                <option value="">請選擇上下架</option>
                                <option value="1" @selected($news->status == 1)>上架</option>
                                <option value="0" @selected($news->status == 0)>下架</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">上傳最新消息圖(只接受jpg、png,尺寸建議1200*800)</label>
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
                            <textarea name="content_text" class="form-control search_input easein mb-0" rows="2" placeholder="請輸入內文文字">{{ $news->content_text }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">上傳最新消息內容圖(只接受jpg、png,尺寸建議1200*800)</label>
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
                            <img id="newsContentImg" class="mt-3" src="{{ asset($news->content_image) }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <button type="button" onclick="clearBtn()"
                    class="btn btn-danger border-0 rounded-3 float-end shadow-sm px-3 me-2">清除</button>
                <button type="button" onclick="location.href = '{{ route('backend.news.index') }}';"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2">返回列表</button>
                <button type="button" onclick="updateBtn({{ $news->id }})"
                    class="btn btn-primary border-0 rounded-3 float-end shadow-sm px-3 me-2">確認修改</button>
            </div>
        </div>
    </div>

    <script>
        function reviewImage(element) {
            if (element.files && element.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $("#" + element.id + "Img");
                    img.attr('src', e.target.result);
                    img.css({
                        "height": "250px", // 固定高度
                        "width": "auto", // 寬度自動
                        "object-fit": "contain", // 縮放但不變形
                        "display": "block" // 避免下方有空白
                    });
                }
                reader.readAsDataURL(element.files[0]);
            }
        }

        function clearBtn() {
            $("input, select, textarea").val('');
            $("#newsImg").attr("src", "{{ asset('images/backend/defaultImage.png') }}");
            $("#newsContentImg").attr("src", "{{ asset('images/backend/defaultImage.png') }}");
        }

        function updateBtn(id) {
            url = "{{ route('backend.news.update', ':id') }}";
            url = url.replace(':id', id);

            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#update')[0]);
            data.append('_method', 'PATCH');

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
                        if (response.code == '00') {
                            Swal.fire({
                                title: '修改成功！',
                                icon: 'success',
                                timer: 3000
                            }).then((result) => {
                                location.href = "{{ route('backend.news.index') }}";
                            });
                        };
                    };
                },
                error: function(xhr, status, error) {
                    alert_text = JSON.parse(xhr.responseText).message;

                    if (xhr.status == '403') {
                        alert_text = "無此權限";
                    }

                    Swal.fire({
                        icon: "error",
                        title: alert_text,
                        timer: 3000
                    });
                }
            });
        }
    </script>
@endsection
