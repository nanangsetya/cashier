<div>
    <form wire:submit="store" class="row" enctype="multipart/form-data">
        <div class="col-12 form-group">
            <Label>Type</Label>
            <select wire:model.lazy="type" class="form-control">
                @foreach($types as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
            @error('type')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="col-12 form-group mt-3">
            <Label>Name</Label>
            <input type="text" wire:model="name" class="form-control">
            @error('name')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="col-12 form-group mt-3">
            <Label>Price</Label>
            <input type="number" wire:model="price" class="form-control">
            @error('price')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="col-md-6 form-group mt-3">
            <Label>Image</Label>
            <input type="file" wire:model="image" class="form-control" accept="image/png, image/jpg, image/jpeg" id="image">
            <span class="badge bg-primary">upload new image to change the previous</span>
            @error('image')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="col-md-6 form-group mt-3">
            @if(isset($product))
                @if($prev_image && empty($image))
                    <img src="{{ $prev_image }}" style="max-width: 500px;">
                @endif
            @endif
            <img src="{{ isset($image) ? $image->temporaryUrl() : '' }}" style="max-width: 500px;">
        </div>
        <div class="col-12 form-group mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
