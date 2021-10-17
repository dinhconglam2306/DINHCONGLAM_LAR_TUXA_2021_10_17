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
                    <th class="column-title">Name</th>
                    <th class="column-title">Link</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Ordering</th>
                    <th class="column-title">Type Menu</th>
                    <th class="column-title">Type Open</th>
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
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $link            = Hightlight::show($val['link'], $params['search'], 'link');
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); 
                            $ordering        = Template::showItemOrdering($controllerName, $val['ordering'],$id);
                            $typeMenu        = Template::showItemSelect($controllerName, $id, $val['type_menu'], 'type_menu');
                            $typeOpen        = Template::showItemSelect($controllerName, $id, $val['type_open'], 'type_open');
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td >{{ $name }}</td>
                            <td >{{ $link }}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $ordering !!}</td>
                            <td>{!! $typeMenu !!}</td>
                            <td>{!! $typeOpen !!}</td>
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
           