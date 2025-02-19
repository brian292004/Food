<div class="modal fade" id="lockAccountModal" tabindex="-1" role="dialog" aria-labelledby="lockAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lockAccountModalLabel">Khóa tài khoản</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="lock-account-form">
                    @csrf
                    <input type="hidden" name="user_id" value="">
                    <div class="form-group">
                        <label for="locked_by">Người khóa</label>
                        <input type="text" class="form-control" id="locked_by" name="locked_by" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="reason">Lý do khóa</label>
                        <textarea class="form-control" id="reason" name="reason" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lock_start_time">Thời gian bắt đầu khóa</label>
                        <input type="datetime-local" class="form-control" id="lock_start_time" name="lock_start_time" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Khóa tài khoản</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unlockAccountModal" tabindex="-1" role="dialog" aria-labelledby="unlockAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlockAccountModalLabel">Xác nhận Unlock tài khoản</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn Unlock người này không?</p>
                <form action="" method="POST" id="unlock-account-form">
                    @csrf
                    <input type="hidden" name="user_id" value="">
                    <input type="hidden" name="status" value="Unlock">
                    <button type="submit" class="btn btn-primary">Unlock tài khoản</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>