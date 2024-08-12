<div>
    @include('alert')
    <form wire:submit="login">
        <div class="form-group mb-2">
            <input type="text" class="form-control" wire:model="username" placeholder="Username" style="background-color: white" required>
            @error('username')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control" wire:model="password" placeholder="Password" style="background-color: white" required>
            @error('password')
                <code>{{ $message }}</code>
            @enderror
        </div>
        <div class="d-grid bottom-0"><button type="submit" class="btn btn-lg btn-primary mt-2" href="#!">Login<i class="fas fa-chevron-right ms-2"></i></button></div>
    </form>
</div>
