<ul>
    @foreach($childs as $child)
    <li>
        <input type="radio" id="{{ $child->id }}" name="parent_id" value="{{ $child->id }}">
        <label for="vehicle1"> {{ $child->name }}</label><br>
        @if(count($child->childs))
        @include('admin.documentTree.manage_checkbox',['childs' => $child->childs])
        @endif
    </li>
    @endforeach
</ul>