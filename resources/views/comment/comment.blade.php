@foreach ($comments as $comment)
<div class="display-comment ml-4">
    <div>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>

    </div>
    <a href="#" onclick="hideFunction()">Sembunyikan</a>
    @if (auth()->user())
        <form action="{{ route('storeReply') }}" method="POST" id="reply">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" placeholder="Reply comment to {{ $comment->user->name }}"/>
                <input type="hidden" name="item_id" value="{{ $item_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 1.2em;" value="Reply" />

            </div>
        </form>
    @endif

    @include('comment.comment', ['comments' => $comment->replies])
</div>
    <script>
        function hideFunction(){
            var x = document.getElementById("reply");
            if (x.style.display === "none"){
                x.style.display = "block";
            }else{
                x.style.display = "none";
            }
        }
    </script>
@endforeach
