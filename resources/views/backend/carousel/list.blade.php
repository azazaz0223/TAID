@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">輪播banner</li>
        </ol>
    </nav>

    <div class="container-fluid p-3 m-1">
        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">
                banner列表
                @if ($carousels['total'] < 10)
                    <button type="button" class="w-auto btn btn-danger btn-sm rounded-pill float-end shadow-sm lh-sm"
                        onclick="createBtn()">
                        <i class="fas fa-plus"></i>
                    </button>
                @endif
            </h2>

            <div class="card-body toScroll text-nowrap">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>Banner名稱</th>
                            <th>狀態</th>
                            <th>連結</th>
                            <th>排序</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($carousels as $key => $carousel)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $carousel->name }}</td>
                                <td>
                                    @if ($carousel->status)
                                        上架
                                    @else
                                        下架
                                    @endif
                                </td>
                                <td class="ellipsis">{{ $carousel->link }}</td>
                                <td>{{ $carousel->sort }}</td>
                                <td>
                                    <button type="button" class="btn btn-light rounded-3 shadow-sm"
                                        onclick="editBtn({{ $carousel->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button type="button" onclick="deleteConfirmBtn({{ $carousel->id }})"
                                        class="btn btn-light rounded-3 shadow-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @empty(!$carousels)
                    {{ $carousels->links('backend.pagination.pagination') }}
                @endempty
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">編輯 banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">名稱</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">連結</label>
                            <textarea class="form-control" id="link" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">上架設定</label>
                            <select class="select form-control" id="status">
                                <option value="">請選擇上下架</option>
                                <option value="1">上架</option>
                                <option value="0">下架</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sort" class="form-label">排序</label>
                            <input type="number" class="form-control" id="sort" min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">上傳圖片(只接受jpg、png,尺寸建議1920*1080)</label>
                            <input type="file" id="image" class="form-control easein" accept="image/jpeg, image/png"
                                onchange="reviewImage(this)">
                            <img id="preview_image"class="mt-3" src="{{ asset('images/backend/defaultImage.png') }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="clearBtn()">清除</button>
                        <button type="button" class="btn btn-primary" id="saveBtn">保存</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedFile = null;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        function reviewImage(element) {
            if (element.files && element.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $("#preview_image");
                    img.attr('src', e.target.result);
                    img.css({
                        "height": "800px", // 固定高度
                        "width": "auto", // 寬度自動
                        "object-fit": "contain", // 縮放但不變形
                        "display": "block" // 避免下方有空白
                    });
                }
                reader.readAsDataURL(element.files[0]);
                selectedFile = element.files[0];
            } else {
                selectedFile = null;
            }
        }

        function clearBtn() {
            $("#modal input, #modal select, #modal textarea").val('');
            $("#preview_image").attr("src", "{{ asset('images/backend/defaultImage.png') }}");
        }

        function handleData() {
            const formData = new FormData();
            formData.append("name", $("#name").val());
            formData.append("link", $("#link").val());
            formData.append("status", $("#status").val());
            formData.append("sort", $("#sort").val() != "" ? $("#sort").val() : 1);
            if (selectedFile != null) {
                formData.append("image", selectedFile);
            }

            return formData;
        }

        function createBtn() {
            clearBtn();
            $("#modalLabel").text('新增 banner');
            $("#saveBtn").attr("onclick", `storeBtn()`);
            $("#modal").modal("show");
        }

        function storeBtn() {
            data = handleData();

            $.ajax({
                url: "{{ route('backend.carousel.store') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == '00') {
                        Swal.fire({
                            title: '新增成功！',
                            icon: 'success',
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        });
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

        function editBtn(id) {
            url = "{{ route('backend.carousel.show', ':id') }}";
            url = url.replace(':id', id);

            clearBtn();

            $.ajax({
                url: url,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                success: function(response) {
                    if (response.code == '00') {
                        $("#modalLabel").text('編輯 banner');
                        $("#name").val(response.data.name);
                        $("#link").val(response.data.link);
                        $("#status").val(response.data.status);
                        $("#sort").val(response.data.sort);
                        let basePath = "{{ asset('') }}";
                        let image = response.data.image;
                        $("#preview_image").attr("src", `${basePath}${image}`);
                        $("#saveBtn").attr("onclick", `updateBtn(${id})`);
                        $("#modal").modal("show");
                    };
                },
                error: function(xhr, status, error) {
                    let alert_text = "發生不可預期的錯誤";

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

        function updateBtn(id) {
            url = "{{ route('backend.carousel.update', ':id') }}";
            url = url.replace(':id', id);

            data = handleData();
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
                        Swal.fire({
                            title: '修改成功！',
                            icon: 'success',
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        });
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
                    url = "{{ route('backend.carousel.delete', ':id') }}";
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
