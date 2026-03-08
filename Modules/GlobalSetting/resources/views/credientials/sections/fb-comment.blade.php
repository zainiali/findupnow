<div class="tab-pane fade" id="blogCommentTab" role="tabpanel">
    <div class="card m-0">
        <div class="card-body">
            <form action="{{ route('admin.update-facebook-comment') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">{{ __('Blog Comment Type') }}</label>
                    <select class="form-control" id="comment_type" name="comment_type">
                        <option value="1" {{ $facebookComment->comment_type == 1 ? 'selected' : '' }}>
                            {{ __('Manual Comment') }}</option>
                        <option value="0" {{ $facebookComment->comment_type == 0 ? 'selected' : '' }}>
                            {{ __('Facebook Comment') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">{{ __('Facebook App Id') }}</label>
                    <input class="form-control" name="app_id" type="text" value="{{ $facebookComment->app_id }}">
                </div>

                <button class="btn btn-primary">{{ __('Update') }}</button>
            </form>
        </div>
    </div>
</div>
