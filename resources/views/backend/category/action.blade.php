{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('category.update')) --}}
<a href="{{ URL::to($model->slug) }}" target="_blank"
    title="Edit" class="btn btn-outline-warning btn-sm">
    <i class="bi bi-eye"></i> {{ $model->slug }}
</a>

<a href="{{ route('admin.category.edit', ['id' => $model->id, 'sub' => isset($model->parent_id) ? true : null]) }}"
    title="Edit" class="btn btn-outline-primary btn-sm">
    <i class="bi bi-pen"></i>
</a>

{{-- @endif --}}

{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('category.delete')) --}}
<a href="javascript:;" id="delete_item" data-id ="{{ $model->id }}"
    data-url="{{ route('admin.category.delete', $model->id) }}" class="btn btn-soft-danger btn-sm" data-bs-toggle="tooltip"
    data-bs-placement="top" title="Delete">
    <i class="bi bi-trash"></i>
</a>
{{-- @endif --}}
