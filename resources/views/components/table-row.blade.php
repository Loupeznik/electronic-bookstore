@props(['row', 'actions', 'id', 'path'])

<tr class="border-b border-gray-200 hover:bg-gray-100">
    @foreach ($row as $var)
        <td class="py-3 px-6 whitespace-nowrap text-center">{{ __($var) }}</td>
    @endforeach
    @if (!empty($actions))
        <td class="py-3 px-6 whitespace-nowrap text-center">
        @foreach($actions as $action)
            @if ($action == 'delete')
                <a href="{{'/' . request()->path() . '/' . $id}}" onclick="event.preventDefault(); document.getElementById('form-{{$id}}').submit();"><i class="ri-delete-bin-2-line text-red-500"></i></a>
                <form method="POST" action="{{'/' . request()->path() . '/' . $id}}" style="display: none" id="form-{{$id}}">
                    @csrf
                    @method('delete')
                </form>
            @elseif ($action == 'edit')
                <a href="@empty($path) {{'/' . request()->path() . '/' . $id . '/edit'}} @else {{'/' . $path . '/' . $id . '/edit'}} @endempty"><i class="ri-edit-2-line text-blue-500"></i></a>
            @elseif ($action == 'show')
                <a href="@empty($path) {{'/' . request()->path() . '/' . $id}} @else {{'/' . $path . '/' . $id}} @endempty"><i class="ri-file-list-line text-blue-500"></i></a>
            @endif
        @endforeach
        </td>
    @endif
    {{$slot}}
</tr>
