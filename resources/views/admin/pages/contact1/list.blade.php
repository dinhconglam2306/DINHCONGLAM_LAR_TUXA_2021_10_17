@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Thông tin người dùng</th>
                    <th class="column-title">Nội dung liên hệ</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Địa chỉ IP</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $username        = Hightlight::show($val['username'], $params['search'], 'username');
                            $email           = Hightlight::show($val['email'], $params['search'], 'email');
                            $phone           = $val['phone'];
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); ;
                            $createdHistory  = $val['created'];
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="40%">
                                <p><strong>Tên:</strong> {!! $username !!}</p>
                                <p><strong>Email:</strong> {!! $email!!}</p>
                                <p><strong>Số điện thoại:</strong> {!! $phone !!}</p>
                            </td>
                            <td width="10%">{!! $status!!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           