@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">Join us</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">Join us</h2>

            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto">
                        <div class="dive_sub">英文小標</div>
                    </div>
                    <div class="w-auto input-group me-2">
                        <span class="input-group-text bg-white">Join</span>
                        <input type="text" class="form-control" id="en_title"
                            value="{{ $data ? $data->en_title : '' }}">
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto">
                        <div class="dive_sub">中文大標</div>
                    </div>

                    <div class="col">
                        <textarea class="form-control search_input easein mb-0" id="zh_title">{{ $data ? $data->zh_title : '' }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">內文描述</div>
                    </div>
                    <div class="col">
                        <textarea id="content1" class="form-control search_input easein mb-0" rows="2" placeholder="內文描述">{{ $data ? $data->content : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a href="#" onclick="updateBtn()"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">確認送出</a>
            </div>

            <div class="card col-12 rounded-3 bg-white mb-4">
                <h2 class="fs-5 p-3 fw-bold border-bottom">Join us 圖片設定</h2>
                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="row col-12 card-body fs-6 gray_l rounded-3 g-0 gap-2">
                        <label class="mb-2">二張圖片設定
                            <span class="font12 ps-5 text-black-50 text-danger">點圖可設定詳細內文</span>
                        </label>
                        <div class="col">
                            <a onclick="showBtn(1)">
                                <img src="{{ $data ? asset($data->image1) : '' }}">
                            </a>
                        </div>
                        <div class="col">
                            <a onclick="showBtn(2)">
                                <img src="{{ $data ? asset($data->image2) : '' }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="about3pic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">二張圖片設定</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bg-light p-3 rounded-3 dialog-box-content">
                        <form id="update">
                            <div class="row col-12 mb-2 gx-0">
                                <div class="col-12">
                                    <div class="dive_sub">上傳圖片 / 更改圖片</div>
                                </div>
                                <div class="col">
                                    <input type="file" class="form-control" name="image"
                                        aria-describedby="inputFileAdd" aria-label="Upload">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dialogue">
                    <button type="button" class="dialogue-btn shadow-sm btn btn-primary"
                        onclick="updateImageInfoBtn()">確認送出</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var image_id;

        function updateBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const data = {
                en_title: $("#en_title").val(),
                zh_title: $("#zh_title").val(),
                content: $("#content1").val(),
            };

            if (data.en_title == '') {
                Swal.fire({
                    icon: "error",
                    title: "英文小標不得空白!",
                    timer: 3000
                });
                return
            } else if (data.zh_title == '') {
                Swal.fire({
                    icon: "error",
                    title: "中文大標不得空白!",
                    timer: 3000
                });
                return
            } else if (data.content == '') {
                Swal.fire({
                    icon: "error",
                    title: "內文描述不得空白!",
                    timer: 3000
                });
                return
            }

            $.ajax({
                url: "{{ route('backend.join.update', '1') }}",
                type: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                success: function(response) {
                    if (response.code == '00') {
                        Swal.fire({
                            title: '修改成功！',
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
                        timer: 3000
                    });
                }
            });
        }

        function showBtn(id) {
            image_id = id;
            $("#about3pic").modal("show");
        }

        function updateImageInfoBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#update')[0]);
            data.append('op', image_id);
            if ($("#image").val() == "") data.delete('image');

            $.ajax({
                url: "{{ route('backend.join.UpdateImageInfo', '1') }}",
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
    </script>
@endsection
