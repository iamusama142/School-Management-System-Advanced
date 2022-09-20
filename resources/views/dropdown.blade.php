<select class="custom-select custom-select-sm" name="class" id="program">
    <option value="">Select Program</option>
    @foreach ($program as $item)
    <option value="{{$item->id}}">{{$item->program}}</option>
@endforeach
  </select>
</div>
<div class="col-6">
    <select class="custom-select custom-select-sm"  name="class" id="section">
      <option value="">Select Section</option>
     
    </select>