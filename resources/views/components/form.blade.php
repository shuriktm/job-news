<form method="POST" action="{{ $action }}">
    @csrf
    @method($method)

    {{ $slot }}

    <div class="row mb-0">
        <div class="col-md-5 offset-md-3">
            <button type="submit" class="btn btn-primary">
                {{ $button }}
            </button>
        </div>
    </div>
</form>
