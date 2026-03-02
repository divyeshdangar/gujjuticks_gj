<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label class="label">Name</label>
            <input type="text" name="name" class="form-control text-dark h-58" required value="{{ old('name', $dataDetail?->name) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label class="label">Slug</label>
            <input type="text" name="slug" class="form-control text-dark h-58" required value="{{ old('slug', $dataDetail?->slug) }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-4">
            <label class="label">Description</label>
            <textarea name="description" class="form-control text-dark" rows="4">{{ old('description', $dataDetail?->description) }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-4">
            <label class="label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control text-dark h-58" value="{{ old('sort_order', $dataDetail?->sort_order ?? 0) }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-4">
            <label class="label">Important</label>
            <select name="is_important" class="form-select h-58">
                <option value="0" @if((string)old('is_important', $dataDetail?->is_important ? '1' : '0') === '0') selected @endif>No</option>
                <option value="1" @if((string)old('is_important', $dataDetail?->is_important ? '1' : '0') === '1') selected @endif>Yes</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-4">
            <label class="label">Active</label>
            <select name="is_active" class="form-select h-58">
                <option value="1" @if((string)old('is_active', $dataDetail?->is_active ?? true ? '1' : '0') === '1') selected @endif>Yes</option>
                <option value="0" @if((string)old('is_active', $dataDetail?->is_active ?? true ? '1' : '0') === '0') selected @endif>No</option>
            </select>
        </div>
    </div>
</div>

