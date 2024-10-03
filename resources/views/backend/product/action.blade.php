{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.update')) --}}
<a href="{{ URL::to($model->slug) }}" class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="Top" title="View">
    <i class="bi bi-eye"></i>
</a>
{{-- @endif --}}

{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.update')) --}}
<a href="{{ route('admin.product.edit', $model->id) }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="Top" title="Edit">
    <i class="bi bi-pen"></i>
</a>
{{-- @endif --}}

{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.update')) --}}
<a href="javascript:;" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-placement="Top" title="Duplicate">
    <i class="bi bi-copy"></i>
</a>
{{-- @endif --}}

{{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.delete')) --}}
<a href="javascript:;" id="delete_item" data-id ="{{ $model->id }}" data-url="{{ route('admin.product.destroy',$model->id) }}" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
    <i class="bi bi-trash"></i>
</a>
{{-- @endif --}}