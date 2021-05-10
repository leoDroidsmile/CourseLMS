<div class="card-body">
    <h3><b></b></h3>
    <form action="{{route('messages.send')}}" method="post" >
        @csrf
        @if($receiver != null)
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        @else
            <input type="hidden" name="receiver_id" value="0">
        @endif
        <div class="form-group">
            <label> Receiver </label>
            @if($receiver)
                <input class="form-control" type="text" disabled value="{{ $receiver->name }}" required>
            @else
                <input class="form-control" type="text" disabled value="To All Students" required>
            @endif
        </div>
       
        <div class="form-group">
            <label>@translate(Message)</label>
            <textarea name="message" class="form-control" style="height:200px;"></textarea>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Send)</button>
        </div>
    </form>
</div>




