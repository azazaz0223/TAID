@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">LOGO設定</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">
        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">LOGO設定</h2>

            <form id="updateForm">
                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">更改LOGO(只接受png,尺寸建議310*51)</label>
                        <input type="file" name="logo" id="logo" onchange="reviewImage(this)"
                            class="form-control search_input product-hover easein">
                        <img id="logoImg" class="mt-3" src="{{ asset('images/backend/defaultImage.png') }}">
                    </div>

                    <div class="col-8 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">LOGO</label>
                        <div class="card-body bg-white rounded-3">
                            <img src="{{ asset('images/logo.png') }}" style="height: 100px;">
                        </div>
                    </div>
                </div>
            </form>

            <div class="card-body">
                <button type="button" onclick="updateBtn()"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">確認送出</button>
            </div>
        </div>
    </div>

    <script>
        function updateBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#updateForm')[0]);

            $.ajax({
                url: "{{ route('backend.logo.update') }}",
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
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        }

        function reviewImage(element) {
            if (element.files && element.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#" + element.id + "Img").attr('src', e.target.result);
                }
                reader.readAsDataURL(element.files[0]);
            }
        }
    </script>
@endsection
