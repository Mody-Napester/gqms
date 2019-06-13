<label>Show Desks</label>
<select name="desks[]" id="desks" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
    @foreach($desks as $key => $desk)
        <option value="{{ $desk->uuid }}">{{ (($desk->area)? $desk->area->name_en : '-') . ' - ' . $desk->name_en }}</option>
    @endforeach
</select>
