<div class="modal fade" id="confirm{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-dark">Confirm delete</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="d-inline" method="post" action="{{route('categories.destroy', $id)}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <p class="text-dark">
                        Are you sure to delete this?
                    </p>
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>