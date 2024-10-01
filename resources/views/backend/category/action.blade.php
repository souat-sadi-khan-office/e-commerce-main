{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('category.update')) --}}
<a href="{{ route('admin.category.edit', ['id' => $model->id, 'sub' => isset($model->parent_id) ? true : null]) }}"
    title="Edit" class="btn btn-outline-primary">
    <i class="bi bi-pen"></i>
</a>

{{-- @endif --}}

{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('category.delete')) --}}
<a href="javascript:;" id="delete_item" data-id ="{{ $model->id }}"
    data-url="{{ route('admin.category.delete', $model->id) }}" class="btn btn-soft-danger" data-bs-toggle="tooltip"
    data-bs-placement="top" title="Delete">
    <i class="bi bi-trash"></i>
</a>
{{-- @endif --}}
