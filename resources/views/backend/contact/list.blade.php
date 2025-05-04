@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">聯絡我們</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">聯絡我們</h2>

            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">查詢期間</div>
                    </div>
                    <div class="col">
                        <input type="date" name="started_date" class="form-control datepicker"
                            value="{{ request('started_date') }}">
                    </div>
                    <div class="col">
                        <input type="date" name="ended_date" class="form-control datepicker"
                            value="{{ request('ended_date') }}">
                    </div>
                    <div class="w-auto">
                        <div class="dive_sub">狀態</div>
                    </div>
                    <div class="col-2">
                        <select name="isHandle" class="select form-control">
                            <option value="">全部</option>
                            <option value="1" @if (request('isHandle') === '1') selected @endif>已回覆</option>
                            <option value="0" @if (request('isHandle') === '0') selected @endif>未回覆</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">客戶姓名</div>
                    </div>
                    <div class="col-2">
                        <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                    </div>
                    <div class="w-auto col-1">
                        <div class="dive_sub">聯絡電話</div>
                    </div>
                    <div class="col">
                        <input type="text" name="phone" class="form-control" value="{{ request('phone') }}">
                    </div>
                </div>
                <button type="button" onclick="selectBtn()"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">查詢 </button>
            </div>

            <div class="toScroll text-nowrap p-3">
                <table id="" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>留言日期</th>
                            <th>姓名</th>
                            <th>聯絡電話</th>
                            <th>狀態</th>
                            <th>備註</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($list as $key => $contact)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    <a href="#" onclick="showBtn({{ $contact->id }})" data-bs-toggle="modal"
                                        data-bs-target="#checkDetail">{{ $contact->name }}</a>
                                </td>
                                <td>{{ $contact->phone }}</td>
                                <td>
                                    @if ($contact->isHandle == 0)
                                        <span
                                            class="badge rounded-pill bg-danger text-dark bg-opacity-25 fs-6 fw-normal">未回覆</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-info text-dark bg-opacity-25 fs-6 fw-normal">已回覆</span>
                                    @endif
                                </td>
                                <td>{{ $contact->note }}</td>
                                <input type="hidden" id="content_{{ $contact->id }}" value="{{ $contact->content }}">
                                <input type="hidden" id="isHandle_{{ $contact->id }}" value="{{ $contact->isHandle }}">
                                <input type="hidden" id="note_{{ $contact->id }}" value="{{ $contact->note }}">
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

    <div class="modal fade" id="checkDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="wd100 bg-light p-3 gx-1 rounded-3 dialog-box-content">
                        <div class="row col-12 gx-0">

                            <article class="itemside border-bottom info lh-base fs-6 my-2">
                                <div class="row g-0 mb-3">
                                    {{-- <div class="col-12">
                                    留言內容或是未來可當分類標題
                                </div> --}}
                                    <div class="col-12 mt-2 font15" id="modal_content"></div>
                                </div>
                            </article>
                            <article class="itemside my-2">
                                <div class="d-flex justify-content-start gap-3">
                                    <div class="w-auto col-1">
                                        <div class="dive_sub">備註</div>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="modal_note" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 pt-3 ps-5">
                                    <div class="box box-check">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" id="modal_isHandle">
                                            <b class="border-oncheck"></b>
                                            <span class="form-check-label">已回覆</span>
                                        </label>
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>
                </div>
                <div class="dialogue">
                    <button type="button" onclick="updateBtn()"
                        class="dialogue-btn shadow-sm btn btn-primary">送出</button>
                    <button type="button" class="dialogue-btn shadow-sm btn btn-primary"
                        data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var patch_id;

        function selectBtn() {
            const data = {
                started_date: $("input[name='started_date']").val(),
                ended_date: $("input[name='ended_date']").val(),
                isHandle: $("select[name='isHandle']").val(),
                name: $("input[name='name']").val(),
                phone: $("input[name='phone']").val(),
            }

            if (data.started_date != '' && data.ended_date != '' && data.ended_date < data.started_date) {
                Swal.fire({
                    icon: "error",
                    title: "查詢期間開始日期不得大於結束日期",
                    timer: 3000
                });
                return
            }

            let urlParams = Object.entries(data)
                .filter(([key, value]) => value !== '')
                .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`).join('&');
            let url = "{{ route('backend.contact.index') }}?" + urlParams;
            window.location.href = url;
        }

        function showBtn(id) {
            patch_id = id;
            $("#modal_content").text($("#content_" + id).val());
            if ($("#isHandle_" + id).val() == 1) {
                $("#modal_isHandle").prop("checked", true);
            } else {
                $("#modal_isHandle").prop("checked", false);
            }
            $("#modal_note").val($("#note_" + id).val());
            $("#checkDetail").modal("show");
        }

        function updateBtn() {
            let url = "{{ route('backend.contact.update', ':id') }}";
            url = url.replace(':id', patch_id);

            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const data = {
                note: $("#modal_note").val(),
                isHandle: $("#modal_isHandle").is(":checked") ? 1 : 0,
            };

            $.ajax({
                url: url,
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
    </script>
@endsection
