<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" wire:model="name" class="form-control" required>
            </div>
            <div class="mb-3 col-6">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" wire:model="slug" class="form-control" readonly>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="icon" class="form-label">Icon</label>
                <input type="text" wire:model="icon" class="form-control iconpicker" required>
            </div>
            <div class="mb-3 col-6">
                <label for="header" class="form-label">Header</label>
                <input type="text" wire:model="header" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea wire:model="short_description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3 col-6">
                <label for="site_title" class="form-label">Site Title</label>
                <input type="text" wire:model="site_title" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea wire:model="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" wire:model="meta_title" class="form-control" required>
            </div>
            <div class="mb-3 col-6">
                <label for="meta_keyword" class="form-label">Meta Keyword <span class="text-danger"> Use Comma ","</span></label>
                <input type="text" wire:model="meta_keyword" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea wire:model="meta_description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="meta_article_tag" class="form-label">Meta Article Tag <span class="text-danger"> Use Comma ","</span></label>
                <input type="text" wire:model="meta_article_tag" class="form-control">
            </div>
            <div class="mb-3 col-6">
                <label for="meta_script_tag" class="form-label">Meta Script Tag <span class="text-danger"> Use Comma ","</span></label>
                <input type="text" wire:model="meta_script_tag" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="status" class="form-label">Status</label>
                <select wire:model="status" class="form-select" required>
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="is_featured" class="form-label">Is Featured?</label>
                <select wire:model="is_featured" class="form-select" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="uploadOuter mb-3">
            <label for="uploadFile" class="btn btn-primary form-label">Upload Image</label>
            <strong>OR</strong>
            <span class="dragBox">
                Drag and Drop image here
                <input type="file" wire:model="photo" ondragover="drag()" ondrop="drop()" id="uploadFile" />
            </span>
        </div>
        <div id="preview">
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" alt="Image Preview" style="max-width: 50%;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
