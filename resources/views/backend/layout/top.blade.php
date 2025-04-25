<div class="top_title">
    <div class="d-flex justify-content-end align-items-center">
        <a href="" class="btn link-light text-dark shadow-none" data-bs-toggle="modal"
            data-bs-target="#myAccountPassword"><i class="fas fa-user"></i> 管理者 {{ auth('backend')->user()->name }}</a>
        <a href="{{ route('backend.logout') }}" class="btn link-light text-dark shadow-none">
            <i class="fas fa-cog"></i>登出
        </a>
    </div>
</div>
<div class="clear"></div>

{{-- popup 修改自己密碼 --}}
<div class="modal fade" id="myAccountPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">修改密碼</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wd100 bg-light p-3 gx-1 rounded-3 dialog-box-content">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control border-light" name="selfPassword" id="selfPassword"
                            placeholder="Password">
                        <label for="selfPassword">請輸入密碼</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control border-light" name="selfPasswordConfirm"
                            id="selfPasswordConfirm" placeholder="Password">
                        <label for="selfPasswordConfirm">再次輸入密碼</label>
                    </div>
                </div>
            </div>
            <div class="dialogue">
                <button type="button" class="dialogue-btn shadow-sm btn btn-primary" data-bs-dismiss="modal"
                    onclick="updateSelfBtn()">確認修改</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSelfBtn() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const data = {            
            name: "{{ auth('backend')->user()->name }}",
            email: "{{ auth('backend')->user()->email }}",
            password: $("input[name='selfPassword']").val(),
            password_confirmation: $("input[name='selfPasswordConfirm']").val(),
        };

        if (data.password == '') {
            $("#alert_text").text("請輸入密碼!");
            $("#alert").modal("show");
            return
        } else if (data.password_confirmation == '') {
            $("#alert_text").text("請再次輸入密碼!");
            $("#alert").modal("show");
            return
        } else if (data.password != data.password_confirmation) {
            $("#alert_text").text("密碼不相符!");
            $("#alert").modal("show");
        }

        $.ajax({
            url: "{{ route('backend.updatePassword', auth('backend')->user()->id) }}",
            type: "PATCH",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            data: data,
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