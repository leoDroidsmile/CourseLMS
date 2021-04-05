<form action="{{route('message.sent')}}" method="post">
    @csrf
    <input type="hidden" name="enroll_id" value="{{$enroll->id}}">
    <input type="hidden" name="user_id" value="{{$enroll->user_id}}">
    <div class="form-group">
        <textarea class="form-control" name="message" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">@translate(Send)</button>
</form>
