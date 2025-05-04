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
            <h2 class="fs-5 p-3 fw-bold border-bottom">最新消息列表</h2>

            <div class="card-body toScroll text-nowrap">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>消息大標</th>
                            <th>狀態</th>
                            <th>消息副標</th>
                            <th>排序</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($list as $news)
                            <tr>
                                <td>{{ $news->id }}</td>
                                <td>{{ $news->title }}</td>
                                <td>
                                    @if ($news->status)
                                        上架
                                    @else
                                        下架
                                    @endif
                                </td>
                                <td>{{ $news->subtitle }}</td>
                                <td>{{ $news->sort }}</td>
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

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">最新消息</h2>

            <form id="create">
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto">
                            <div class="dive_sub">消息大標</div>
                        </div>
                        <div class="col">
                            <input type="text" name="title" class="form-control" placeholder="請輸入消息大標">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">消息副標</div>
                        </div>
                        <div class="col">
                            <textarea name="subtitle" class="form-control search_input easein mb-0" rows="2" placeholder="請輸入消息副標"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">排序</div>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="sort" min="0">
                        </div>
                        <div class="w-auto col-1">
                            <div class="dive_sub">上架設定</div>
                        </div>
                        <div class="col">
                            <select class="select form-control" name="status">
                                <option value="">請選擇上下架</option>
                                <option value="1">上架</option>
                                <option value="0" selected>下架</option>
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
                            <textarea name="content_text" class="form-control search_input easein mb-0" rows="2" placeholder="請輸入內文文字"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">上傳最新消息內容圖(只接受jpg、png,尺寸建議1200*800)</label>
                        <div class="c-mainCard__item">
                            <div class="l-upload l-upload--notSpace">
                                <div class="card-body fs-6 gray_l rounded-3">
                                    <input type="file" name="content_image" accept="image/jpeg, image/png"
                                        id="newsContent" onchange="reviewImage(this)"
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
                <button type="button" class="btn btn-danger border-0 rounded-3 float-end shadow-sm px-3 me-2"
                    onclick="clearBtn()">清除</button>
                <button type="button" class="btn btn-primary border-0 rounded-3 float-end shadow-sm px-3 me-2"
                    onclick="createBtn()">新增</button>
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

        function createBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#create')[0]);

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
                        if (response.code == '00') {
                            Swal.fire({
                                title: '新增成功！',
                                icon: 'success',
                                timer: 3000
                            }).then((result) => {
                                location.reload();
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

        function deleteConfirmBtn(id) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: '確認要刪除嗎？',
                text: '刪除後無法撤銷！',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '是的，刪除！',
                cancelButtonText: '取消',
            }).then((result) => {
                if (result.isConfirmed) {
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
                                Swal.fire({
                                    title: '刪除成功！',
                                    icon: 'success',
                                    timer: 3000
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            alert_text = JSON.parse(xhr.responseText).message;

                            if (xhr.status == '403') {
                                alert_text = "無此權限";
                            }

                            Swal.fire({
                                icon: "error",
                                title: alert_text,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
