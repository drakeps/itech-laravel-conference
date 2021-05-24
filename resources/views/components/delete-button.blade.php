<div class="d-inline-block">
    <form action="{{ $actionUrl }}" method="POST">
        @csrf
        @method('delete')

        <button type="submit" class="btn btn-danger">
            {{ $slot }} <i class="fa fa-trash-alt"></i>
        </button>
    </form>
</div>