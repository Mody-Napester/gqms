<div class="modal fade" id="deskQueueHistoryModal" tabindex="-1" role="dialog" aria-labelledby="deskQueueHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deskQueueHistoryModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <select name="user" id="doctor_user" class="form-control">
                    @foreach($users as $user)
                        <option @if($user->id == $doctor->user_id) selected @endif value="{{ $user->uuid }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->