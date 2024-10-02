<div class="modal-header">
    <h5 class="modal-title">Create new Specification Key Type Attribute</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        &times;
    </button>
</div>
<div class="modal-body">
    <form action="{{ route("admin.category.specification.type.attribute.store") }}" method="POST" class="ajax-form">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control mt-3 py-2" required>
            </div>

            <div class="col-md-6 form-group">
                <label for="name">Extra Words</label>
                <input type="text" name="extra" id="extra" class="form-control mt-3 py-2">
            </div>

            <div class="col-md-7 form-group">
                <label for="key_type_id" class="form-label">Select Specification Key Type <span
                    class="text-danger">*</span></label>
            <select name="key_type_id" id="key_type_id" class="form-control select" required>
                <option value="" disabled selected>-- Select Specification Key Type --</option>
                @foreach ($keys as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-md-5 mt-3 form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_active" checked >
                </div>
            </div>

            <div class="col-md-12 mt-3 text-end">
                <button class="btn btn-soft-success" type="submit" id="submit">
                    <i class="bi bi-send"></i>
                    Create
                </button>
                <button class="btn btn-soft-warning" type="button" id="submitting" style="display: none;">
                    <i class="bi bi-spinner bi-spin"></i>
                    Processing  
                </button>
            </div>
        </div>
    </form>
</div>

